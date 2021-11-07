<?php
declare(strict_types=1);

namespace App\Models;

use App\Models\Task;
use App\Utils\TreeOrganizer;

class File
{
    public string $filename;
    public array $tasks;

    public function __construct(string $filename, array $tasks = [])
    {
        $this->filename = $filename;
        $this->tasks = $tasks;
    }

    public function pushTask(Task $task): void
    {
        $this->tasks[] = $task;
    }

    public function organizeTasks(): void
    {
        $tasksKeyByName = (collect($this->tasks))->keyBy("name")->toArray();
        $organizedTasks = [];
        
        /**
         * This for is used 'cause a bug could occurs in case the first task comes without dependencies
         *
         * TreeOrganizer@organizeTasksOrder removes already registered tasks making it performatic and fixing
         * doubling tasks in list
         */
        foreach ($this->tasks as $task) {
            (new TreeOrganizer())->organizeTasksOrder($task, $organizedTasks, $tasksKeyByName);
        }
        $this->tasks = $organizedTasks;
    }
}
