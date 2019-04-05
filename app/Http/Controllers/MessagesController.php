<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;

class MessagesController extends Controller
{
    //
    public function getMessages()
    {
        try
        {
            if($user = Auth::user())
            {
                $my_id = auth()->user()->id;
                
            }
            else
            {
                return Redirect::to('/login');
            }

        }
        catch(Exception $ex)
        {
            return Redirect::to('/serverError');
        }
    }
}
