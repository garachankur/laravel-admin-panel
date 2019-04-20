<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class AdminUser extends Authenticatable
{
    use Notifiable;

    protected $guarded = ['id'];
    protected $table = 'admin_users';
    protected $fillable = [
        'name', 'email', 'image',
    ];

    public function getImageFullpathAttribute($value)
    {
        return Storage::url(config('laraveladminpanel.admin_image_path') . $this->attributes['id'] . '/' . $value);
    }

    public function getImageThumbFullpathAttribute($value)
    {

        return Storage::url(config('laraveladminpanel.admin_image_path') . $this->attributes['id'] . '/' . config('laraveladminpanel.thumb_image_path') . $value);
    }
}
