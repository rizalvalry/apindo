<?php
/**
 * Created by PhpStorm.
 * User: Shaon
 * Date: 2/1/2021
 * Time: 2:00 PM
 */

namespace App\Http\Traits;
use App\Http\Traits\Upload;


trait ContentDelete
{
    use upload;
    public static function booted()
    {
        static::deleting(function ($model) {
            if (isset($model->contentMedia->description->image)) {
                $self = new self();
                $self->fileDelete($model->contentMedia->driver, $model->contentMedia->description->image);
            };
            $model->contentMedia()->delete();
            $model->contentDetails()->delete();
        });
    }
}
