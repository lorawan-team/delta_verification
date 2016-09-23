<?php namespace Delta\DeltaVerification\Users;

use App\User as BaseUserModel;

class User extends BaseUserModel implements UserInterface
{
    //...

    public function getEmail(){
        return $this->getAttribute('email');
    }

    public function getName(){
        return $this->getAttribute('name');
    }

    public function getRememberToken(){
        return $this->getAttribute('remember_token');
    }
}
