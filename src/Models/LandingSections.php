<?php

namespace Nozom\LandingPagePackage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class LandingSections extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        "ar_name",
        'slug',
        'order',
        'is_publish'
    ];
    public static function getLastOrderPlusOne(){
        $order = self::max("order") ?? 0;

        return $order + 1;
    }

    public function elements(){
        return $this->hasMany(SectionElement::class,"fk_section_id","id");
    }
    // It is a tool developed by Nozom Company that assists government entities, authorities, and centers in managing and monitoring the measurement of digital transformation in the Kingdom of Saudi Arabia.
    public function getElements($slug){

        if (app()->getLocale() == "ar") {
            $elements =json_decode($this->hasMany(SectionElement::class,"fk_section_id","id")->pluck("value_ar" , "slug")->toJson());
        } else{
            $elements =json_decode($this->hasMany(SectionElement::class,"fk_section_id","id")->pluck("value" , "slug")->toJson());
        }
        $slug = $this->id."-".$slug;
    
        if(!isset($elements->$slug) || empty($elements->$slug)){
            $elements = json_decode($this->hasMany(SectionElement::class,"fk_section_id","id")->pluck("value" , "slug")->toJson());
        }
        $element = SectionElement::where('slug', $slug)->first();

        if(!$element) return "";
        
        if ($element->type === HTML) {
            echo __($element->value ?? "");
        } else {
            return __($element->value ?? "");
        }
    }

    public static function getSections(){
        $sections = self::orderBy("order")->get();
        foreach ($sections as $section) {
            $path = getViewPath("landing-page.{$section->slug}");
            if(!$path){
                $section->not_found = true;
            }else{
                $section->not_found = false;
            }
        }
        return $sections;
    }
}
