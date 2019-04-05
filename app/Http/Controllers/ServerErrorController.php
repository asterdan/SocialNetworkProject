<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServerErrorController extends Controller
{
    //

    public function serverError()
    {
        return view('servererror.error');
    }
}
