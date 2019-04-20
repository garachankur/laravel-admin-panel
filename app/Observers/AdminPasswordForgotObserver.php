<?php

namespace App\Observers;

use App\Models\PasswordReset;
use App\Mail\ForgotPassword;
use Mail;

class AdminPasswordForgotObserver
{
    public function creating(PasswordReset $PasswordReset)
    {
	}

	public function created(PasswordReset $PasswordReset)
    {

        Mail::to($PasswordReset['email'])->send(new ForgotPassword($PasswordReset));
    }


    public function updating(PasswordReset $PasswordReset)
    {
    }

    public function updated(PasswordReset $PasswordReset)
    {
    }

    public function saved(PasswordReset $PasswordReset)
    {
    }

    public function saving(PasswordReset $PasswordReset)
    {
    }

    public function deleting(PasswordReset $PasswordReset)
    {

    }

    public function deleted(PasswordReset $PasswordReset)
    {
    }

    public function restoring(PasswordReset $PasswordReset)
    {
    }

    public function restored(PasswordReset $PasswordReset)
    {
    }
}
?>
