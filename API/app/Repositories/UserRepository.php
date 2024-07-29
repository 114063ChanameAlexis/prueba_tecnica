<?php

namespace App\Repositories;

use App\Interfaces\IUserRepository;
use App\Models\Usuario;

class UserRepository implements IUserRepository
{
    public function getAll()
    {
        return Usuario::where('Activo', 1)->get();
    }

    public function findByUserId($id){
        return Usuario::find($id);
    }

    public function updateActivo($id, $value){
        $usuario = $this->findByUserId($id);
        if ($usuario -> Activo == 1) {
            $usuario->Activo = $value;
            $usuario->save();
            return $usuario;
        }
        return null;
    }
}
