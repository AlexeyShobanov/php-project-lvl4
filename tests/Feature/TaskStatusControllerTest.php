<?php

namespace Tests\Feature;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\TaskStatus;
use App\User;
use TaskStatusSeeder;

class TaskStatusControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->seed(TaskStatusSeeder::class);
        
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/');
    }

    public function testIndex()
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertOk();
        $this->assertDatabaseHas('task_statuses', ['name' => 'New']);
    }

    public function testCreate()
    {
        $response = $this->get(route('task_statuses.create'));
        $response->assertOk();
    }

    public function testEdit()
    {
        $status = factory(TaskStatus::class)->create();
        $response = $this->get(route('task_statuses.edit', $status->id));
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
        $response = $this->delete(route('task_statuses.destroy', $status->id));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('task_statuses', ['id' => $status->id]);
    }
}
