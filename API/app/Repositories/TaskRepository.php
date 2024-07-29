<?php

namespace App\Repositories;

use App\Interfaces\ITaskRepository;
use App\Models\Tarea;
use Carbon\Carbon;

class TaskRepository implements ITaskRepository
{
    public function deleteTask($id){
        $tarea = Tarea::find($id);
        if($tarea){
            $tarea -> delete();
            return $tarea;
        }
        return null;
    }


    public function getOldTasks($days)
    {
        $dateAux = Carbon::now()->subDays($days);

        return Tarea::where('FechaModificacion', '<', $dateAux)
                    ->where('TareaFinalizada', 0)
                    ->get();
    }

    public function markTasksAsFinished($tasks)
    {
        foreach ($tasks as $task) {
            $task->TareaFinalizada = 1;
            $task->save();
        }
        return $tasks;
    }
}
