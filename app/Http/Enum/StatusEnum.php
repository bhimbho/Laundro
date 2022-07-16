<?php
namespace App\Http\Enum;

enum StatusEnum:string {
    case TAGGING = 'tagging';
    case INPROGRESS = 'inprogress';
    case DELAYED = 'delayed';
    case COMPLETED = 'completed';
}