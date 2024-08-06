<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OverviewController extends Controller
{
    public function index()
    {
        $notifications = Activity::where('notify', true)->get();
        $applications = Application::all();

        return view('overview.index', compact('notifications', 'applications'));
    }
}
