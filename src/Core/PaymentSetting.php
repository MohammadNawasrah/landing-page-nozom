<?php

namespace Nozom\LandingPagePackage\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
        'created_by',

    ];
}
