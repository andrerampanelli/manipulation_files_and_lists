<?php
declare(strict_types=1);

namespace App\Utils;

use App\Models\Task;

class TreeOrganizer
{
    // Just to contemplate non-static methods
    public function __construct()
    {
    }

    public function organizeTasksOrder(?Task $task, array &$list, array &$tasksKeyByName): void
    {
        if (is_null($task)) {
            return;
        }
        if (!isset($tasksKeyByName[$task->name])) {
            return;
        }

        if (!empty($task->dependencies)) {
            foreach ($task->dependencies as $dependency) {
                $dependencyTask = $tasksKeyByName[$dependency] ?? null;
                if (is_null($dependencyTask)) {
                    continue;
                }
                $this->organizeTasksOrder($dependencyTask, $list, $tasksKeyByName);
            }
        }

        unset($tasksKeyByName[$task->name]);
        $list[] = $task;
    }
}
