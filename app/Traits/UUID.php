<?php
namespace App\Traits;

use Webpatser\Uuid\Uuid as UuidGenerator;

trait UUID
{
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) UuidGenerator::generate(4);
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}