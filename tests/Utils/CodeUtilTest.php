<?php

use App\Utils\CodeUtil;
use Illuminate\Support\Facades\DB;

class CodeUtilTest extends TestCase
{

    public function testIsTaoCode()
    {
//        DB::enableQueryLog();
//        $user = factory(\App\Models\User::class)->create([
//                'name' => 'hts'
//            ]
//        );
//        $user = \App\Models\User::query()->where('id', $user->getId())
//            ->lockForUpdate()
//            ->first();
//        $logs = DB::getQueryLog();
//        var_dump($logs);

        $text = "fu致这段话₤hRYD1K4O21V₤打開👉🍑宝👈";
        $res = CodeUtil::isTaoCode($text);
        $this->assertTrue($res);
    }

    public function testThrowException()
    {
        $this->expectException(\App\Exceptions\InvalidRequestException::class);
        CodeUtil::throwException();
    }

}