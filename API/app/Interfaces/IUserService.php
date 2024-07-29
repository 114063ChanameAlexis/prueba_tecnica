<?php

namespace App\Interfaces;

interface IUserService
{
    public function getAllUsersActives();
    public function setInactive($id);
}
