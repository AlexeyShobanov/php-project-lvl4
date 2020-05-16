<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Label;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class LabelControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        
        $user = factory(User::class)->create();
        $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/');
    }

    public function testIndex()
    {
        $response = $this->get(route('labels.index'));
        $response->assertOk();
    }

    public function testCreate()
    {
        $response = $this->get(route('labels.create'));
        $response->assertOk();
    }

    public function testEdit()
    {
        $label = factory(Label::class)->create();
        $response = $this->get(route('labels.edit', $label));
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
        $response = $this->delete(route('labels.destroy', $label));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertSoftDeleted('labels', [
            'id' => $label->id,
            'name' => $label->name,
        ]);
    }
}
