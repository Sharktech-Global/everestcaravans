<?php

namespace App;

use App\Notifications\AdminResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $table = "admins";

    protected $guard_name = 'admin'; 

    public function canAny(array $permissions)
    {
        foreach($permissions as $e){
            if($this->can($e)) return true;
        }

        return false;
    }

    public function canAll(array $permissions)
    {
        foreach($permissions as $e){
            if(!$this->can($e)) return false;
        }

        return true;
    }
}