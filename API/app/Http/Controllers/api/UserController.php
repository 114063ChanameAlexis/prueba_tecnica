<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Interfaces\IUserService;
use App\Response\ApiResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private IUserService $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = $this->userService->getAllUsersActives();
            return ApiResponse::sendResponse($data, 'Usuarios recuperadas exitosamente');
        } catch (\Exception $e) {
            return ApiResponse::throw($e, 'Fallo al recuperar usuarios',500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $usuario = $this->userService->setInactive($id);
            if ($usuario) {
                return ApiResponse::sendResponse($usuario, 'Usuario eliminado/desactivado correctamente');
            }
            return ApiResponse::sendResponse(null, 'Usuario no encontrado', 404);
        } catch (\Exception $e) {
            return ApiResponse::rollback($e, 'Error actualizando usuario', 500);
        }
    }
}
