<?php

namespace App\Interfaces;

interface IUserRepository
{
    public function getAll();
    public function findByUserId($id);
    public function updateActivo($id, $value);
}
