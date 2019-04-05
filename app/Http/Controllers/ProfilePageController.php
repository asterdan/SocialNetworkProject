<?php

namespace App\Http\Controllers;

use App\Image;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Redirect;

class ProfilePageController extends Controller
{
    public function index()
    {
        $page_limit = 8;
        $id = auth()->user()->id;
        $user = User::find($id);
        $posts = $user->posts;
        $images = Image::where('user_id', $id)->paginate(8);
        $allImages = Image::where('user_id', $id)->get();
        $num = count($allImages);

        $total_pages = ceil($num / $page_limit);

        $data = [
            'posts' => $posts,
            'images' => $images,
            'total_pages' => $total_pages,
        ];
        return view('profile.index')->with('data', $data);
    }

    public function createPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        $user_id = auth()->user()->id;

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = $user_id;
        $post->save();

        return view('home')->with('success', 'Post created!');
    }

    public function uploadImage(Request $request)
    {
        $this->validate($request, [
            'name' => 'image|nullable|max:5000',
        ]);

        if ($request->hasFile('name')) {
            //Get filename with the extension
            $filenameWithExt = $request->file('name')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('name')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload image
            $path = $request->file('name')->storeAs('public/images', $fileNameToStore);

        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $user_id = auth()->user()->id;
        $image = new Image;
        $image->name = $fileNameToStore;
        $image->user_id = $user_id;
        $image->save();

        return view('home')->with('success', 'Post created!');
    }

    public function myProfile()
    {
        try
        {
            if ($user = Auth::user()) 
            {
                $page_limit = 8;

                $id = auth()->user()->id;
                $user = User::find($id);
                $posts = $user->posts;
                $postPhotos;
                foreach ($posts as $post) {
                    if ($post->post_type == 'With photos') {
                        $postPhotos = $post->postimages;
                    }
                }

                $images = Image::where('user_id', $id)->paginate(8);
                $allImages = Image::where('user_id', $id)->get();
                $num = count($allImages);
                $users = User::all();

                $total_pages = ceil($num / $page_limit);
                $data = [
                    'users' => $users,
                    'user' => $user,
                    'posts' => $posts,
                    'images' => $images,
                    'total_pages' => $total_pages,
                    'friends' => $user->friends,
                ];
                return view('profile.myprofile')->with('data', $data);
            }
            else 
            {
                return Redirect::to('/login');
            }
        } catch (Exception $ex) {
            return Redirect::to('/serverError');
        }

    }
}
