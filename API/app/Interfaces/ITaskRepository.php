<?php

namespace App\Interfaces;

interface ITaskRepository
{
    // public function findByTask($id);
    public function deleteTask($id);

    public function getOldTasks($days);

    public function markTasksAsFinished($tasks);
}