<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke()
    {
        $activities = Activity::where('notify', true)->get();
        $query = request('q');

        if ($query == null) {
            return view('results', ['users' => null, 'activities' => $activities]);
        }

        $terms = explode(' ', $query);

        $users = User::query()
            ->where(function ($query) use ($terms) {
                foreach ($terms as $term) {
                    $query->orWhere('first_name', 'LIKE', '%' . $term . '%')
                        ->orWhere('middle_name', 'LIKE', '%' . $term . '%')
                        ->orWhere('last_name', 'LIKE', '%' . $term . '%')
                        ->orWhere('email', 'LIKE', '%' . $term . '%')
                        ->orWhere('contact_num', 'LIKE', '%' . $term . '%')
                        ->orWhere('id', 'LIKE', '%' . $term . '%')
                        ->orWhere('account_type', 'LIKE', '%' . $term . '%');
                }
            })
            ->get();

        return view('results', ['users' => $users, 'activities' => $activities]);
    }
}
