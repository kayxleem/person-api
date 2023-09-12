<?php

namespace Tests\Feature;

use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PersonApiTest extends TestCase
{
        /**
     * A basic feature test example.
     *
     * @return void
     */

     use RefreshDatabase;

     private $person;

     public function setUp(): void
     {
         parent::setUp();
         $this->person = $this->createPerson([
             "name" => "My First Person",
         ]);
     }
    public function test_person_api_returns_response(): void
    {
        $response = $this->get('api');

        $response->assertStatus(200);
    }

    public function test_add_people()
    {
        $this->withoutExceptionHandling();
        $person = Person::factory()->make();
        $response = $this->postJson('api',[
            'name'=>$person->name,

        ]);
        $responseJson=$response;
        $this->assertEquals($person->name,$responseJson['name']);
        $this->assertDatabaseHas('people',['name'=> $person->name]);
        $this->assertDatabaseHas('people',['name'=> 'My First Person']);
    }

    public function test_get_person()
    {
        $response = $this->getJson('api/'.$this->person->id);
        $response
            ->assertStatus(200);
        $responsejson = $response;
        $this->assertEquals("My First Person", $responsejson['name']);
    }

    public function test_update_person()
    {
        $oldname =$this->person->name;
        $this->withoutExceptionHandling();
        $response = $this->patchJson('api/'.$this->person->id, ['name' => 'updated name']);

        $this->assertEquals($oldname, $response['oldname']);
        $response
            ->assertStatus(201);
    }

    public function test_delete_person()
    {
        $this->withoutExceptionHandling();
        $this->deleteJson('api/'. $this->person->id);

        $this->assertDatabaseMissing('people', ['id' => $this->person->id]);
    }

    public function createPerson($args = [])
    {
        return Person::factory()->create($args);
    }
}


