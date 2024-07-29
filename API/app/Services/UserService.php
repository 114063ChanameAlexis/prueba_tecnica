<?php

namespace App\Services;

use App\Interfaces\IUserService;
use App\Interfaces\IUserRepository;
use App\Response\ApiResponse;
use App\Http\Resources\UserResource;

class UserService implements IUserService
{
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsersActives()
    {
        try {
            $data = $this->userRepository->getAll();
            return UserResource::collection($data);
        } catch (\Exception $e) {
            ApiResponse::throw($e);
        }
    }

    public function setInactive($id)
    {
        return $this->userRepository->updateActivo($id, 0);
    }
}
