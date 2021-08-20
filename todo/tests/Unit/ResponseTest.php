<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResponseTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_all_tasks()
    {
        $response = $this->get('/task');

        $response->assertStatus(200);
    }
    public function test_create_task()
    {
        $response = $this->postJson('/task',['description'=>'new task']);

        $response
            ->assertStatus(200)
            ->assertJson(['Result'=>'Task Created Successfully']);
    }
    public function test_update_status()
    {
        $response = $this->patch('/task/1');

        $response
            ->assertStatus(200)
            ->assertJson(['message'=>'Task not found']);
    }
    public function test_delete_task()
    {
        $response = $this->delete('/task/1');

        $response
            ->assertStatus(200)
            ->assertJson(['message'=>'Task not found']);
    }

}
