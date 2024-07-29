<?php

namespace App\Interfaces;

interface ITaskService
{
    public function deleteTask($id);

    public function updateOldTasksStatus($days);
}
