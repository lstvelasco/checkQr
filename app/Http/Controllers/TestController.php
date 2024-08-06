<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testStatusUpdates()
    {
        return response()->json(['message' => 'Status updates triggered']);
    }
}
