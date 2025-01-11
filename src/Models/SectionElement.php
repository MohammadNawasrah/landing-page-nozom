<?php

namespace Nozom\LandingPagePackage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionElement extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        "slug",
        'value',
        'value_ar',
        'fk_section_id',
        'type',
    ];
    public static function saveDefaultKeys($sectionID){
        $data = [
            ["name"=>"Section Color","slug"=>$sectionID."-".str()->slug("Section Color"),"value"=>"default"],
        ];
        foreach ($data as $value) {
            self::firstOrCreate(
                ["slug"=>$value["slug"]]
        ,
        [
                "slug"=> $value["slug"],
                "name"=> $value["name"],
                "value"=> $value["value"],
            ]);
        }

    }
    public function  getElementByType($type = null)
    {
        if ($type == null) $type = $this->type;
        switch ($type) {
            case HTML:
                return '
                        <label class="form-label" for="value">English Name</label>
                        <textarea name="value" id="value" class="form-control summernote" rows="5">' . $this->value . '</textarea>
                        <label class="form-label" for="value_ar">Arabic Name</label>
                        <textarea name="value_ar" id="value_ar" class="form-control summernote" rows="5">' . $this->value_ar . '</textarea>
                       ';

            case COLOR:
                return '<center><input name="value" id="value" type="color" value="' . $this->value . '" style="width: 50%;" class="colorPicker" /></center>';

            case SWITCH_TYPE:
                if (!empty($this->value) ) {
                    return '<center><div class="form-check  form-switch"><input type="checkbox" name="value" class="form-check-input" checked/></div></center>';
                } else {
                    return  '<center><div class="form-check  form-switch"><input type="checkbox" name="value" class="form-check-input" /></div></center>';
                }
            case IMAGE:
                return '<input name="value" id="value" type="hidden"  class="form-control" />';

            case SVG:
                return '<textarea name="value" value="' . $this->value . '" id="value" class="form-control svgShow" rows="5" "></textarea><div class="displaySvg"></div>';

            case IMAGE_URL:
                return '<input name="value" value="' . $this->value . '" id="value" type="text" class="form-control"/>';
            default:
                return '<input  type="text" class="form-control"/>';
        }
    }

    public function  getvalueByElementType($type = null)
    {
        if ($type == null) $type = $this->type;
        switch ($type) {
            case HTML:
                return $this->value;

            case COLOR:
                return '<input type="color" value="' . $this->value . '" style="width: 50%;" class="colorPicker" disabled />';

            case SWITCH_TYPE:
                if (!empty($this->value)) {
                    return '<center><div class="form-check disabled form-switch"><input type="checkbox" class="form-check-input" disabled  checked/></div></center>';
                } else {
                    return '<center><div class="form-check disabled form-switch"><input type="checkbox" class="form-check-input" disabled/></div></center>';
                }

            case IMAGE:
                return  ' <img src="' . $this->value . '" alt="Example Image" class="img-fluid rounded shadow" style="max-width: 100px; height: auto;">';

            case SVG:
                return $this->value;

            case IMAGE_URL:
                return  ' <img src="' . $this->value . '" alt="Example Image" class="img-fluid rounded shadow" style="max-width: 100px; height: auto;">';

            default:
                return  $this->value ;
        }
    }
}
