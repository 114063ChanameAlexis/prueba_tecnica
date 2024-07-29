<?php

namespace App\Services;

use App\Interfaces\ITaskRepository;
use App\Interfaces\ITaskService;
use Illuminate\Support\Facades\DB;
use Exception;

class TaskService implements ITaskService
{
    private ITaskRepository $taskRepository;

    public function __construct(ITaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function deleteTask($id)
    {
        return $this->taskRepository->deleteTask($id);
    }

    public function updateOldTasksStatus($days)
    {
        try {

            DB::beginTransaction();
            $tasks = $this->taskRepository->getOldTasks($days);
            $this->taskRepository->markTasksAsFinished($tasks);
            DB::commit();
            return $tasks;
            
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
