<?php
declare(strict_types=1);

namespace App\Models;

class Task
{
    public string $name;
    public string $command;
    public array $dependencies;

    public function __construct(string $name, string $command, array $dependencies = [])
    {
        $this->name = $name;
        $this->command = $command;
        $this->dependencies = $dependencies;
    }
}
