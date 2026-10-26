<?php

namespace App;

use App\Notifications\AdminResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins';

    protected $guard_name = 'admin';

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPassword($token));
    }
}