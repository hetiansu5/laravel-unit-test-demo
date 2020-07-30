<?php

namespace App\Http\Response;

use Illuminate\Http\JsonResponse;

class OKResponse extends JsonResponse
{
    public function __construct()
    {
        parent::__construct(['status' => 'ok'], 200);
    }
}
