<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_creates_task_and_validates_title()
    {
        $this->post(route('tasks.store'), ['title' => ''])->assertSessionHasErrors('title');
        $this->post(route('tasks.store'), ['title' => 'Ma première tâche'])->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', ['title' => 'Ma première tâche']);
    }

    public function test_mark_task_complete()
    {
        $response = $this->post(route('tasks.store'), ['title' => 'Task à terminer']);
        $task = \App\Models\Task::first();

        $this->patch(route('tasks.complete', $task))->assertRedirect();
        $this->assertTrue($task->fresh()->is_completed);
    }

    public function test_update_and_delete_task()
    {
        $this->post(route('tasks.store'), ['title' => 'A éditer']);
        $task = \App\Models\Task::first();

        $this->put(route('tasks.update', $task), ['title' => 'Titre modifié'])->assertRedirect();
        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'title' => 'Titre modifié']);

        $this->delete(route('tasks.destroy', $task))->assertRedirect();
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
