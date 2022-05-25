<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;
use Faker\Generator as Faker;
use App\Models\User;
use Illuminate\Support\Facades\Notification;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }

    public function testUserIndex()
    {
        $this->get('/api/users');

        $this->assertEquals(
            ResponseStatus::HTTP_OK, $this->response->getStatusCode()
        );
    }

    public function testUserStore()
    {
        Notification::fake();

        $user = User::factory()->create();
    
        $this->post('/api/users', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password,
        ]);

        dd($this->response->getStatusCode());
        // $this->assertEquals(
        //     ResponseStatus::HTTP_CREATED, $this->response->getStatusCode()
        // );
    }
}
