<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\TaskStatus;
use App\User;
use TaskStatusSeeder;

class TaskStatusControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(TaskStatusSeeder::class);
        
        $user = factory(User::class)->create();
        $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/');
    }

    public function testIndex()
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertOk();
    }

    public function testCreate()
    {
        $response = $this->get(route('task_statuses.create'));
        $response->assertOk();
    }

    public function testEdit()
    {
        $status = factory(TaskStatus::class)->create();
        $response = $this->get(route('task_statuses.edit', $status));
        $response->assertOk();
    }

    public function testStore()
    {
        $factoryData = factory(TaskStatus::class)->make()->toArray();
        $name = \Arr::only($factoryData, ['name']);
        $response = $this->post(route('task_statuses.store'), $name);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', $name);
    }

    public function testUpdate()
    {
        $status = factory(TaskStatus::class)->create();
        $factoryData = factory(TaskStatus::class)->make()->toArray();
        $name = \Arr::only($factoryData, ['name']);
        $response = $this->patch(route('task_statuses.update', $status), $name);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', $name);
    }

    public function testDestroy()
    {
        $status = factory(TaskStatus::class)->create();
        $response = $this->delete(route('task_statuses.destroy', $status));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertSoftDeleted('task_statuses', [
            'id' => $status->id,
            'name' => $status->name,
        ]);
    }
}
