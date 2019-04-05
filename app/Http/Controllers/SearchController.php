<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Redirect;

class SearchController extends Controller
{
    //

    public function searchByName(Request $request)
    {
        try
        {

            if ($user = Auth::user()) 
            {
                $id = auth()->user()->id;
                $name = $request->input('search_name');
                $users = User::where('name', $name)
                    ->orWhere('name', 'like', '%' . $name . '%')->get();
                $user = User::find($id);
                $data = ([
                    'users' => $users,
                    'friends' => $user->friends,
                ]);

                return view('search.index')->with('data', $data);
            }
            else
            {
                return Redirect::to('/login');
            }

        } catch (Exception $ex) 
        {
            return Redirect::to('/serverError');
        }

    }
}
