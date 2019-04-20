<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Observers\AdminPasswordForgotObserver;

class PasswordReset extends Model
{
    protected $table="password_resets";
    protected $fillable=['token','email'];
    public $timestamps = false;

    public static function boot()
	{
		 parent::boot();
		 PasswordReset::observe(new AdminPasswordForgotObserver());
    }

}
