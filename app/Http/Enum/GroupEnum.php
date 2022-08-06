<?php
namespace App\Http\Enum;

enum GroupEnum:string {
    case Kiddies = 'kiddies-wears';
    case normal = 'normal-wear'; 
    case Large = 'large-wears';
    case Xxl = 'xxl-wear';
}