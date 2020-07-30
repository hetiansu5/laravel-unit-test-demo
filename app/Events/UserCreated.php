<?php

namespace App\Events;

class UserCreated extends Event
{
    const TAG = "UserCreated";

    public $id;
    public $name;

    public function getTag()
    {
        return self::TAG;
    }
}
