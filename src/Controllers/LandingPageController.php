<?php

namespace Nozom\LandingPagePackage\Controllers;

use App\Models\EmailReceived;
use Nozom\LandingPagePackage\Core\Utility;
use Illuminate\Http\Request;
use Nozom\LandingPagePackage\Controllers\Core\MasterController;
use Nozom\LandingPagePackage\Models\LandingElement;
use Nozom\LandingPagePackage\Models\LandingSections;
use Nozom\LandingPagePackage\Models\SectionElement;


class LandingPageController extends MasterController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        // تحديد اللغة بناءً على الطلب
        $lang = "";
        foreach ($request->all() as $key => $value) {
            $lang = $key;
            break;
        }
    
        // التحقق إذا لم يتم تحديد اللغة في الطلب
        if ($lang == '') {
            // الحصول على اللغة الافتراضية من إعدادات الإدارة
            $adminDefaultLang = Utility::getAdminPaymentSettings();
            $lang = $adminDefaultLang['default_lang'];
        }
    
        // التحقق من وجود اللغة في قائمة اللغات المتاحة
        $langList = Utility::langList();
        $lang = array_key_exists($lang, $langList) ? $lang : 'en';
    
        // في حالة كان لا يوجد لغة، تعيين اللغة الافتراضية
        if (empty($lang)) {
            $lang = Utility::getValByName('default_language');
        }
    
        // تعيين اللغة في التطبيق
        \App::setLocale($lang);
    
        // تعيين اللغة في المتغيرات
        $this->Data["local"] = app()->getLocale();
        $this->Data["lang"] = $lang;
        $this->Data["landingSections"] = LandingSections::orderBy("order")->get();
        $this->Data["element"] = new  LandingElement();
    
        // مسار الصفحة
        $pagePath = "landing-page-package::landing-page/index";
        return $this->viewPage($pagePath);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'sender_name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone_number' => 'required|string',
        ]);
    
        $receivedAt = now(); 
    
        EmailReceived::create([
            'sender_name' => $request->input('sender_name'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
            'phone_number' => $request->input('phone_number'),
            'received_at' => $receivedAt, 
        ]);
        return redirect()->back()->with('success', __('Sent successfully!'));
    }
    

}
