<?php

namespace App\Providers;

use App\Interfaces\ITaskRepository;
use App\Interfaces\ITaskService;
use App\Interfaces\IUserRepository;
use App\Repositories\UserRepository;
use App\Interfaces\IUserService;
use App\Repositories\TaskRepository;
use App\Services\TaskService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(ITaskRepository::class, TaskRepository::class);
        $this->app->bind(ITaskService::class, TaskService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
