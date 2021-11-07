<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Task;
use App\Models\File;
use App\Utils\FileSystem;
use App\Utils\FileSystemModeType;

class FilesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function registerFile(Request $request): JsonResponse
    {
        $json = $request->json()->all();
        $tasksColl = collect($json["tasks"]);

        $filename = $json["filename"];
        $file = new File($filename);

        $tasksColl->each(function ($task) use ($file) {
            $name = $task["name"];
            $command = $task["command"];
            $dependencies = $task["dependencies"] ?? [];
            $task = new Task($name, $command, $dependencies);
            $file->pushTask($task);
        });

        $file->organizeTasks();

        try {
            $fileSystem = new FileSystem($file->filename);
            $fileSystem->writeFileTasks($file);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "error" => $e->getMessage()
            ], 500);
        }
        
        return response()->json([
            "status" => true,
            "file" => $file
        ], 201);
    }
}
