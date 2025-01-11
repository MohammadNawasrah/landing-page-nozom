<?php

namespace Nozom\LandingPagePackage\Controllers;

use Nozom\LandingPagePackage\Core\Utility;
use Illuminate\Http\Request;
use Nozom\LandingPagePackage\Controllers\Core\MasterController;
use Nozom\LandingPagePackage\Models\LandingElement;
use Nozom\LandingPagePackage\Models\LandingSections;
use Nozom\LandingPagePackage\Models\SectionElement;

class LandingSettingController extends MasterController
{

    public function index()
    {
    
        $this->Data["landingSections"] = LandingSections::orderBy("order")->get();
        $this->Data["landingElements"] = LandingElement::all();
        $pagePath = "landing-page-package::landing-settings/index";
        return $this->viewPage($pagePath);
    }
    public function create()
    {
    
        $pagePath = "landing-page-package::landing-settings/popup/create";
        return $this->viewPage($pagePath);
    }

    public function store(Request $request)
    {
    
        $rules = [
            "section_name" => "required",
            "section_name_ar" => "required"
        ];
        $validation = validRequest($request->all(), $rules);

        if ($validation)
            return $validation;

        $name = $request->section_name;
        $nameAr = $request->section_name_ar;
        $slugName = str()->slug($name);

        createView($slugName, "landing-page");

        LandingSections::firstOrCreate(
            ["slug" => $slugName],
            [
                "name" => $name,
                "ar_name" => $nameAr,
                "slug" => $slugName,
                "is_publish" => true,
                "order" => LandingSections::getLastOrderPlusOne(),
            ]
        );
        return redirect()->back()->with("success", __("Create Section Successfully"));
    }
    public function showSection($sectionID)
    {
    
        $section = LandingSections::where("id", $sectionID)->first();

        if (!$section)
            return redirect()->back()->with("error", __("Not Found Page"));


        SectionElement::saveDefaultKeys($section->id);
        $this->Data["section"] = $section;
        $this->Data["sectionElements"] = $section->elements;

        $pagePath = "landing-page-package::landing-settings/show";
        return $this->viewPage($pagePath);
    }
    public function createSectionElement($sectionID)
    {
    
        $section = LandingSections::where("id", $sectionID)->first();

        if (!$section)
            return redirect()->back()->with("error", __("Not Found Page"));

        $this->Data["section"] = $section;
        $pagePath = "landing-page-package::landing-settings/popup/create-section-element";
        return $this->viewPage($pagePath);
    }
    public function storeSectionElement($sectionID, Request $request)
    {
    
        $rules = [
            "key" => "required",
            "type" => "required"
        ];
        $validation = validRequest($request->all(), $rules);

        if ($validation)
            return $validation;

        $section = LandingSections::where("id", $sectionID)->first();

        if (!$section)
            return redirect()->back()->with("error", __("Not Found Page"));

        $key = $request->key;
        $value = $request->value ?? "";
        $valueAr = $request->value_ar ?? "";
        $type = $request->type;
        $keySlug = str()->slug($key);
        SectionElement::firstOrCreate(
            ["slug" => $keySlug, "fk_section_id" => $section->id],
            [
                "name" => $key,
                "value" => $value,
                "value_ar" => $valueAr,
                "slug" => $section->id . "-" . $keySlug,
                "type" => $type,
                "fk_section_id" => $section->id
            ]
        );
        return redirect()->back()->with("success", __("Create Section Successfully"));
    }
    public function createElement()
    {
            $pagePath = "landing-page-package::landing-settings/popup/create-element";
        return $this->viewPage($pagePath);
    }
    public function storeElement(Request $request)
    {
    
        $rules = [
            "key" => "required",
            "type" => "required"
        ];
        $validation = validRequest($request->all(), $rules);

        if ($validation)
            return $validation;

        $key = $request->key;
        $value = $request->value ?? "";
        $valueAr = $request->value_ar ?? "";

        $type = $request->type;

        $keySlug = str()->slug($key);
        LandingElement::firstOrCreate(
            ["slug" => $keySlug],
            [
                "name" => $key,
                "value" => $value,
                "value_ar" => $valueAr,
                "type" => $type,
                "slug" => $keySlug
            ]
        );
        return redirect()->back()->with("success", __("Create Element Successfully"));
    }
    public function updatePublishStatus(Request $request)
    {
        $landingSection = LandingSections::where('id', $request->id)->first();

        if (!$landingSection) {
            return response()->json([
                "success" => false,
                "message" => __("Section not found")
            ]);
        }

        $landingSection->is_publish = $request->is_publish;
        $landingSection->save();

        return response()->json([
            "success" => true,
            "message" => __("Publish status updated successfully")
        ]);
    }
    public function updateOrder(Request $request)
    {
        $oldSection = LandingSections::where('order', $request->section_old_order)->first();
        $newSection = LandingSections::where('order', $request->section_new_order)->first();

        if ($oldSection && $newSection) {
            $tempOrder = $oldSection->order;
            $oldSection->order = $newSection->order;
            $newSection->order = $tempOrder;

            $oldSection->save();
            $newSection->save();

            return response()->json(['success' => true, 'message' => 'Order updated successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Failed to update order.']);
    }
    public function updateName(Request $request)
    {

        $rules = [
            'id' => 'required|exists:landing_sections,id',
            'name' => 'required|string|max:255',
        ];

        $validation = validRequest($request->all(), $rules);

        if ($validation) {
            return $validation;
        }
        $section = LandingSections::where('id', $request->id)->first();
        $section->name = $request->name;
        $section->save();

        return response()->json([
            'success' => true,
            'message' => __('Section name updated successfully.')
        ]);
    }
    public function updateArName(Request $request)
    {
        $rules = [
            'id' => 'required|exists:landing_sections,id',
            'ar_name' => 'required|string|max:255',
        ];

        $validation = validRequest($request->all(), $rules);

        if ($validation) {
            return $validation;
        }
        $landingSection = LandingSections::where('id', $request->id)->first();
        $landingSection->ar_name = $request->ar_name;
        $landingSection->save();

        return response()->json(['success' => true, 'message' => __('Arabic name updated successfully.')]);
    }
    public function editElement($id)
    {
    
        $landingElement = LandingElement::where('id', $id)->first();

        if (!$landingElement) {
            return redirect()->back()->with("error", __("Element Not Found"));
        }

        $this->Data["landingElement"] = $landingElement;

        $pagePath = "landing-page-package::landing-settings/popup/edit-element";
        return $this->viewPage($pagePath);
    }
    public function updateElement(Request $request, $id)
    {

        $rules = [
            "key" => "required|string|max:255",
            "type" => "required",
            "value" => "nullable|string|max:255"
        ];
        $validation = validRequest($request->all(), $rules);

        if ($validation) {
            return $validation;
        }

        $landingElement = LandingElement::where('id', $id)->first();

        if (!$landingElement) {
            return redirect()->back()->with("error", __("Element not found"));
        }

        $landingElement->name = $request->input('key');
        $landingElement->type = $request->input('type');
        $landingElement->value = $request->input('value', '');
        $landingElement->value_ar = $request->input('value_ar', '');
        $landingElement->save();

        return redirect()->route('landing-settings.index')->with("success", __("Element updated successfully"));
    }
    public function storeFileLandingElement(Request $request)
    {
        $dir = 'landing_images_' . time() . '/';

        $path = upload_file($request, 'file', "", $dir, []);
        if ($path['flag'] == 1) {
            return response()->json([
                "is_success" => __("Upload File Successfully"),
                "path" => $path["http_url"],
                "id" => $path["random_name"],
                "download" => route("files-download", ["path" => $path["http_url"]]),
                "delete" => route("files-delete", ["path" => $path["http_url"], "id" => $path["random_name"]])
            ], 200);
        }

        return response()->json([
            "error" => __("File Not Upload")
        ], 400);

    }
    public function editSectionElement($sectionID, $elementID)
    {
    
        $section = LandingSections::where("id", $sectionID)->first();
        $element = SectionElement::where("id", $elementID)->where("fk_section_id", $sectionID)->first();

        if (!$section || !$element)
            return redirect()->back()->with("error", __("Not Found Page"));

        $this->Data["section"] = $section;
        $this->Data["element"] = $element;

        $pagePath = "landing-page-package::landing-settings/popup/edit-section-element";
        return $this->viewPage($pagePath);
    }
    public function updateSectionElement($sectionID, $elementID, Request $request)
    {
        $rules = [
            "key" => "required",
            "type" => "required"
        ];
        $validation = validRequest($request->all(), $rules);

        if ($validation) {
            return $validation;
        }

        $section = LandingSections::where("id", $sectionID)->first();
        $element = SectionElement::where("id", $elementID)->where("fk_section_id", $sectionID)->first();

        if (!$section || !$element) {
            return redirect()->back()->with("error", __("Not Found Page"));
        }

        $key = $request->key;
        $value = $request->value ?? "";
        $valueAr = $request->value_ar ?? "";

        $type = $request->type;
        $keySlug = str()->slug($key);

        $element->update([
            "name" => $key,
            "value" => $value,
            "value_ar" => $valueAr,
            "slug" => $section->id . "-" . $keySlug,
            "type" => $type,
            "fk_section_id" => $section->id
        ]);

        return redirect()->back()->with("success", __("Element updated successfully"));
    }

}