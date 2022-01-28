<?php

namespace App\Http\Controllers;

use App\Models\{Art, User};
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $artwork = Art::select(['user_id'])->get();
        $user = User::count();
        return view('admin.dashboard', compact('artwork', 'user'));
    }
}
