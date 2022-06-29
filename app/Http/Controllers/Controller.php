<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    private $incrementor;

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function __construct()
    {
    }

    public function getHello()
    {
        $result = $this->incrimentor(1);
        Redis::set('get_num_visits', $result);
        return response()->json(['status' => 'ok', 'greeting' => 'Hello GET', 'get_num_visits' => $result]);
    }

    public function postHello()
    {
        $result = $this->incrimentor(2);
        Redis::set('post_num_visits', $result);
        return response()->json(['status' => 'ok', 'greeting' => 'Hello POST', 'post_num_visits' => $result]);
    }


    private function incrimentor($requestType): int
    {
        // GET
        if ($requestType == 1) {
            $this->incrementor = Redis::get('get_num_visits');
        } else {
            $this->incrementor = Redis::get('post_num_visits');
        }
        if ($this->incrementor == null) $this->incrementor = 0;

        ($this->incrementor++);
        return ($this->incrementor);
    }
}
