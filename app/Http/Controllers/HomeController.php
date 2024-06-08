<?php

namespace App\Http\Controllers;

use App\Models\Karya;
use App\Models\Team;
use App\Models\User;

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
        $widget = [
            'students' => User::where('role_id', User::ROLE_MAHASISWA)->count(),
            'approvedWork' => Karya::whereNotNull('approved_by')->count(),
            'notApprovedWork' => karya::whereNull('approved_by')->count(),
            'teams' => Team::count(),
            // 'users' => $users,
            // 'laptops' => $laptops,
            //...
        ];

        return view('pages.admin.home', compact('widget'));
    }
}
