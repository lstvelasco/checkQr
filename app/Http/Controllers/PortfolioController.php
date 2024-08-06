<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function show(User $user)
    {
        $notifications = Activity::where('notify', true)->get();

        return view('portfolio.show', compact('user', 'notifications'));
    }
}
