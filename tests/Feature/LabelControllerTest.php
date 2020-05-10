<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Label;
use App\Color;
use App\User;
use LabelSeeder;
use Illuminate\Database\Eloquent\SoftDeletes;

class LabelControllerTest extends TestCase
{
    use RefreshDatabase;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->seed(LabelSeeder::class);
        
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/');
    }

    public function testIndex()
    {
        $response = $this->get(route('labels.index'));
        $response->assertOk();
        $this->assertDatabaseHas('labels', ['name' => 'bug']);
    }

    public function testCreate()
    {
        $response = $this->get(route('labels.create'));
        $response->assertOk();
    }

    public function testEdit()
    {
        $label = factory(Label::class)->create();
        $response = $this->get(route('labels.edit', $label->id));
        $response->assertOk();
    }

    public function testStore()
    {
        $factoryData = factory(Label::class)->make()->toArray();
        $data = \Arr::only($factoryData, ['name', 'color_id']);
        $response = $this->post(route('labels.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('labels', $data);
    }

    public function testUpdate()
    {
        $label = factory(Label::class)->create();
        $factoryData = factory(Label::class)->make()->toArray();
        $name = \Arr::only($factoryData, ['name']);
        $response = $this->patch(route('labels.update', $label), $name);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('labels', $name);
    }

    public function testDestroy()
    {
        $label = factory(Label::class)->create();
        $response = $this->delete(route('labels.destroy', $label->id));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertSoftDeleted('labels', [
            'id' => $label->id,
            'name' => $label->name,
        ]);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
