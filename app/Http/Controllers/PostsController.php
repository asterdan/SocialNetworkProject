<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostImage;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Redirect;

class PostsController extends Controller
{

    public function createPost(Request $request)
    {
        try
        {

            if ($user = Auth::user()) {
                $this->validate($request, [
                    'title' => 'required',
                    'body' => 'required',
                ]);

                $input = $request->all();               
                $user_id = auth()->user()->id;
                if (!empty($input['photos']))
                {
                    $photos = $input['photos'];
                    if (count($photos) != 0) {
                        
                        $post = new Post;
                        $post->title = $request->input('title');
                        $post->body = $request->input('body');
                        $post->user_id = $user_id;
                        $post->post_type = "With photos";
                        $post->save();
    
                        foreach ($photos as $photo) {
                            //Get filename with the extension
                            $filenameWithExt = $photo->getClientOriginalName();
                            //Get just filename
                            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                            //Get just extension
                            $extension = $photo->getClientOriginalExtension();
                            //Filename to store
                            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                            //Upload image
                            $path = $photo->storeAs('public/postImages', $fileNameToStore);
    
                            $postImage = new PostImage;
                            $postImage->name = $fileNameToStore;
                            $postImage->post_id = $post->id;
                            $postImage->save();
    
                        }
                
                    }
                }
                
               else {

                    $user_id = auth()->user()->id;
                    $post = new Post;
                    $post->title = $request->input('title');
                    $post->body = $request->input('body');
                    $post->user_id = $user_id;
                    $post->post_type = "No photos";
                    $post->save();

                }
            

                $id = auth()->user()->id;
                $user = User::find($id);
                $posts = $user->posts;
                $postPhotos;
                foreach ($posts as $post) {
                    if ($post->post_type == 'With photos') {
                        $postPhotos = $post->postimages;
                    }
                }

                
                $users = User::all();

                $data = [
                    'users' => $users,
                    'user' => $user,
                    'posts' => $posts,
                    'friends' => $user->friends,
                ];
                return view('profile.myprofile')->with('data', $data)->with('success','Postimi u krye me sukses!');
               

            } else {
                return Redirect::to('/login');
            }

        } catch (Exception $ex) {
            return Redirect::to('/serverError');
        }

    }

    public function getUserPosts()
    {
        try
        {
            if ($user = Auth::user()) 
            {

                $id = auth()->user()->id;
                $user = User::find($id);
                $posts = $user->posts;
                $postPhotos;
                foreach ($posts as $post) {
                    if ($post->post_type == 'With photos') {
                        $postPhotos = $post->postimages;
                    }
                }

                $users = User::all();

                $data = [
                    'users' => $users,
                    'user' => $user,
                    'posts' => $posts,
                    'friends' => $user->friends,
                ];

                return view('posts.userposts')->with('data',$data);
            }
            else
            {
                return Redirect::to('/login');
            }

        } catch (Exception $ex) {
            return Redirect::to('/serverError');

        }

    }

    public function getAllPosts()
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
        
             return view('posts.allposts')->with('data',$data);
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
