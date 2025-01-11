<?php

namespace Nozom\LandingPagePackage\Core;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Languages extends Model
{
    use HasFactory;
    protected $fillable = [
        'lang_code',
        'lang_fullname',
    ];
}
