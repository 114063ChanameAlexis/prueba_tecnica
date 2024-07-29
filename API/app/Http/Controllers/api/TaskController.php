<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Interfaces\ITaskService;
use Illuminate\Http\Request;
use App\Response\ApiResponse;

class TaskController extends Controller
{
    private ITaskService $taskService;

    public function __construct (ITaskService $taskService){
        $this->taskService = $taskService;
    }

    public function index()
    {
        $days = 100;

        try {

            $update = $this->taskService->updateOldTasksStatus($days);
            if ($update) {
                return ApiResponse::sendResponse($update, 'Tareas actualizadas');
            } else {
                return ApiResponse::sendResponse(null, 'Sin tareas a actualizar', 404 );
            }
            
        } catch (\Exception $e) {
            return ApiResponse::throw($e, 'Error al eliminar la tarea',500);
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
            
            $deleted = $this->taskService->deleteTask($id);
            if ($deleted) {
                return ApiResponse::sendResponse($deleted, 'Tarea eliminada con éxito', 200);
            } else {
                return ApiResponse::sendResponse(null, 'Tarea no encontrada', 404 );
            }
        } catch (\Exception $e) {
            return ApiResponse::throw($e, 'Error al eliminar la tarea',500);
        }
    }
}
