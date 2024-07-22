<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Models\Task;

class TasksPolicy
{
    /**
     * Create a new policy instance.
     */
    public function edit(User $user, Task $task): bool
    {
        return $task->user->is($user);
    }

    
}
