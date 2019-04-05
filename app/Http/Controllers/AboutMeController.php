<?php

namespace App\Http\Controllers;

use App\AboutMe;
use Auth;
use Illuminate\Http\Request;
use Redirect;

class AboutMeController extends Controller
{
    //
    public function updateAboutMe(Request $request)
    {
        try
        {
            if ($user = Auth::user()) {
                $user_id = auth()->user()->id;
                $rrethMeje = new AboutMe;
                $rrethMeje->job = $request->input('puna');
                $rrethMeje->school = $request->input('shkolla');
                $rrethMeje->skills = $request->input('aftesite');
                $rrethMeje->phoneNumber = $request->input('celular');
                $rrethMeje->birthplace = $request->input('vendlindja');
                $rrethMeje->user_id = $user_id;
                $rrethMeje->save();

                return response()->json(['message' => 'U perditesua me sukses!']);
            } else {
                return Redirect::to('/login');
            }
        } catch (Exception $ex) {
            return Redirect::to('/serverError');
        }

    }

    public function getAboutMe()
    {
        try
        {
            if ($user = Auth::user()) {
                $user_id = auth()->user()->id;
                $about_me = AboutMe::where('user_id', $user_id)->orderBy('id', 'DESC')->first();

                return response()->json(['rreth_meje' => $about_me]);
            } else {
                return Redirect::to('/login');
            }
        } catch (Exception $ex) {
            return Redirect::to('/serverError');
        }

    }
}
