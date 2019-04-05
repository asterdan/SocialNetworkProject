<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Auth;
use Redirect;

class MyHomeController extends Controller
{
    //

    public function index()
    {
        try
        {
            if ($user= Auth::user())
            {
                $myself = auth()->user()->id;
            $posts = Post::all();
            foreach($posts as $post)
            {
                if ($post->post_type == "With Photos")
                {
                     $post_images = $post->postimages;
                }
            }
            $users = User::all();
            $friends = User::find($myself)->friends;

             $data = [
                  'posts' => $posts,
                 'users' => $users,
                 'friends' => $friends
             ];
        
             return view('myhome.index')->with('data',$data);
            }
            else 
            {
                return Redirect::to('/login');
            }
            

        }
        catch(Exception $ex)
        {
            return view('auth.login');
        }
        
    }
}
