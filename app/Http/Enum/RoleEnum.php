<?php
namespace App\Http\Enum;

enum RoleEnum:string {
    case SUPERADMIN = 'super-admin';
    case MANAGER = 'manager';
    case FRONTDESK = 'frontdesk';

    // public static function getRole() {
    //     return match($this) {
    //         RoleEnum::SUPERADMIN => 'super-admin',
    //         RoleEnum::MANAGER => 'manager',
    //         RoleEnum::FRONTDESK => 'frontdesk',
    //     };
    // }
}