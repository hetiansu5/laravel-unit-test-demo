<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use App\Exceptions\UserNotFoundException;
use App\Facades\Kafka;
use App\Http\Response\CreatedResponse;
use App\Http\Response\OKResponse;
use App\Jobs\UserDeletedJob;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Queue;

class UserController extends Controller
{

    /**
     * @param Request $request
     * @return CreatedResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'string|required'
        ]);

        $user = new User();
        $user->setName($request->input('name'));
        $user->save();

        $event = new UserCreated();
        $event->id = $user->getId();
        $event->name = $user->getName();
        Kafka::push($event);

        return new CreatedResponse();
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function retrieveOne(Request $request, $id)
    {
        $id = intval($id);

        /**
         * @var User $user
         */
        $user = User::query()->find($id);
        if (!$user) {
            throw new UserNotFoundException();
        }

        $result = $user->toDisplay();
        return new JsonResponse($result);
    }

    /**
     * @param Request $request
     * @param $id
     * @return OKResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $request->merge([
            'id' => $id,
        ]);

        $this->validate($request, [
            'id' => 'integer|required',
            'name' => 'string|required'
        ]);

        /**
         * @var User $user
         */
        $user = User::query()->find($id);
        if (!$user) {
            throw new UserNotFoundException();
        }

        $user->setName($request->input('name'));
        $user->save();

        return new OKResponse();
    }

    /**
     * @param Request $request
     * @param $id
     * @return OKResponse
     * @throws \Exception
     */
    public function delete(Request $request, $id)
    {
        $id = intval($id);

        /**
         * @var User $user
         */
        $user = User::query()->find($id);
        if (!$user) {
            throw new UserNotFoundException();
        }
        $user->delete();

        $job = new UserDeletedJob($id);
        Queue::push($job);

        return new OKResponse();
    }

}
