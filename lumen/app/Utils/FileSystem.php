<?php
declare(strict_types=1);

namespace App\Utils;

use Exception;
use DateTime;
use App\Models\File;

class FileSystem
{
    private const DIRECTORY = __DIR__ . "/../../files/";
    public string $filename;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    public function writeFileTasks(File $file): void
    {
        $timestamp = (new DateTime())->getTimestamp();
        $path = static::DIRECTORY . "{$timestamp}/";

        try {
            $this->createFolder($path);
            $commandsList = "";
    
            foreach ($file->tasks as $task) {
                $commandsList .= $task->command . PHP_EOL;
            }
            
            file_put_contents("$path/{$this->filename}", $commandsList);
        } catch (Exception $e) {
            error_log($e->getMessage() . " ||||| " . $path);
            throw new Exception("Unable to create file");
        }
    }

    private function createFolder(string $path): void
    {
        if (!file_exists($path)) {
            mkdir($path, 0775, true);
        }
    }
}
