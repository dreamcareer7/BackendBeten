<?php

namespace App\Http\Controllers;

use App\Models\Crew;
use App\Models\Group;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::where('is_active', 1)->count();
        $stats_user = User::query()
            ->select('id')
            ->addSelect(['last_7' => User::selectRaw('count(*) as total')
                ->whereDate('created_at', '<', now()->subDays(7))])
            ->addSelect(['new_users' => User::selectRaw('count(*) as total')
                ->whereDate('created_at', '>=', now()->subDays(7))])
            ->first();

        $crew = Crew::where('is_active', 1)->count();
        $vehicle = Vehicle::count();
        $groups = Group::count();

        return view('home')->with([
            'users' => $users,
            'crew' => $crew,
            'vehicle' => $vehicle,
            'groups' => $groups,
        ]);
    }
}
