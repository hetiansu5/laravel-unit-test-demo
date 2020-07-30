<?php

use App\Models\User;
use App\Facades\Kafka;
use App\Events\UserCreated;
use Illuminate\Support\Facades\Queue;

class UserControllerTest extends TestCase
{

    /**
     * @var User
     */
    private $user;

    public function setUpTraits()
    {
        parent::setUpTraits();
        $this->user = factory(User::class)->create([
            'name' => 'hts'
        ]);
    }

    public function testRetrieveOne_Pass()
    {
        $headers = [];
        $this->get('/users/' . $this->user->getId(), $headers);
        $this->seeStatusCode(200)
            ->seeJson([
                'id' => $this->user->getId(),
                'name' => 'hts',
            ]);
    }

    public function testRetrieveOne_Fail_NotFound()
    {
        $this->get('/users/' . ($this->user->getId() + 1));
        $this->seeStatusCode(404)
            ->seeJson([
                'code' => 'user.not.found',
            ]);
    }

    public function testCreate_Pass()
    {
        //mock Facade
        Kafka::shouldReceive('push')->with(Mockery::on(function (UserCreated $event) {
            $this->assertEquals(true, $event->id > 0);
            $this->assertEquals('me', $event->name);
            return true;
        }))->once();

        $params = [
            'name' => 'me'
        ];
        $this->post('/users', $params);
        $this->seeStatusCode(201)
            ->seeJson([
                'status' => 'created',
            ])
            ->seeInDatabase('users', [
                'name' => 'me'
            ]);
    }


    public function testUpdate_Pass()
    {
        $params = [
            'name' => 'me1'
        ];
        $this->put('/users/' . $this->user->getId(), $params);
        $this->seeStatusCode(200)
            ->seeInDatabase('users', [
                'id' => $this->user->getId(),
                'name' => 'me1'
            ]);
    }

    public function testDelete_Pass()
    {
        Queue::fake();

        $this->delete('/users/' . $this->user->getId());
        $this->seeStatusCode(200)
            ->notSeeInDatabase('users', [
                'id' => $this->user->getId(),
                'deleted_at' => null
            ]);

        Queue::assertPushed(\App\Jobs\UserDeletedJob::class);
    }

}
