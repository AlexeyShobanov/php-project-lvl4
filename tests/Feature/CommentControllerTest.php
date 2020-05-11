<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Comment;
use App\Task;
use App\User;
use TaskStatusSeeder;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $task;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->seed(TaskStatusSeeder::class);

        $this->user = factory(User::class)->create();
        $this->task = factory(Task::class)->create([
            'created_by_id' => $this->user->id
        ]);
        $response = $this->actingAs($this->user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/');
    }

    public function testStore()
    {
        $factoryData = factory(Comment::class)->make([
            'task_id' => $this->task->id,
            'created_by_id' => $this->user->id
        ])->toArray();
        $content = \Arr::only($factoryData, ['content']);
        $response = $this->post(route('tasks.comments.store', $this->task->id), $content);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('comments', $content);
    }

    public function testEdit()
    {
        $comment = factory(Comment::class)->create([
            'task_id' => $this->task->id,
            'created_by_id' => $this->user->id
        ]);
        $response = $this->get(route('tasks.comments.edit', [$this->task, $comment->id]));
        $response->assertOk();
    }

    public function testUpdate()
    {
        $comment = factory(Comment::class)->create([
            'task_id' => $this->task->id,
            'created_by_id' => $this->user->id
        ]);
        $user2 = factory(User::class)->create();
        $task2 = factory(Task::class)->create([
            'created_by_id' => $user2->id
        ]);
        $factoryData = factory(Comment::class)->make([
            'task_id' => $task2->id,
            'created_by_id' => $user2->id
        ])->toArray();
        $content = \Arr::only($factoryData, ['content']);
        $response = $this->patch(route('tasks.comments.update', [$this->task, $comment->id]), $content);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('comments', $content);
    }

    public function testDestroy()
    {
        $comment = factory(Comment::class)->create([
            'task_id' => $this->task->id,
            'created_by_id' => $this->user->id
        ]);
        $response = $this->delete(route('tasks.comments.destroy', [$this->task, $comment->id]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
