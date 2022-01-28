<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index()
    {
        $artist = User::latest('id')->with('arts')->paginate(10);
        return view('admin.artist', compact('artist'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
