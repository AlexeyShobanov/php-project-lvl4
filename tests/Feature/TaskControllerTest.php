<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\TaskStatus;
use App\User;
use App\Task;
use TaskStatusSeeder;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->seed(TaskStatusSeeder::class);

        $this->user = factory(User::class)->create();
        $response = $this->actingAs($this->user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/');
    }

    public function testIndex()
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();
    }

    public function testCreate()
    {
        $response = $this->get(route('tasks.create'));
        $response->assertOk();
    }

    public function testShow()
    {
        $task = factory(Task::class)->create([
            'created_by_id' => $this->user->id
        ]);
        $response = $this->get(route('tasks.show', $task->id));
        $response->assertOk();
    }

    public function testEdit()
    {
        $task = factory(Task::class)->create([
            'created_by_id' => $this->user->id
        ]);
        $response = $this->get(route('tasks.edit', $task->id));
        $response->assertOk();
    }

    public function testStore()
    {
        $factoryData = factory(Task::class)->make([
            'created_by_id' => $this->user->id
        ])->toArray();
        $data = \Arr::only($factoryData, ['name', 'status_id']);
        $response = $this->post(route('tasks.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', $data);
    }

    public function testUpdate()
    {
        $task = factory(Task::class)->create([
            'created_by_id' => $this->user->id
        ]);
        $user2 = factory(User::class)->create();
        $factoryData = factory(Task::class)->make([
            'created_by_id' => $user2->id
        ])->toArray();
        $data = \Arr::only($factoryData, ['name', 'status_id']);
        $response = $this->patch(route('tasks.update', $task), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', $data);
    }

    public function testDestroy()
    {
        $task = factory(Task::class)->create([
            'created_by_id' => $this->user->id
        ]);
        $response = $this->delete(route('tasks.destroy', $task->id));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
