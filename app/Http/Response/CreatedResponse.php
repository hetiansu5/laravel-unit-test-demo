<?php

namespace App\Http\Response;

use Illuminate\Http\JsonResponse;

class CreatedResponse extends JsonResponse
{
    public function __construct()
    {
        parent::__construct(['status' => 'created'], 201);
    }
}
