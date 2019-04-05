<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Redirect;
use App\UserImage;
use App\User;

class ImageController extends Controller
{
    //

    public function uploadImages(Request $request)
    {
        $this->validate($request, [
            'name' => 'image|nullable|max:5000',
        ]);

        try
        {
            if ($user = Auth::user()) {
                $my_id = auth()->user()->id;
                $input = $request->all();
                $photos = array();
                for($i=0;$i<count($input);$i++)
                {
                    array_push($photos,$input['files'.$i]);
                }
               

                if(count($photos)>0)
                {
                    foreach($photos as $photo)
                    {
                        //Get filename with the extension
                        $filenameWithExt = $photo->getClientOriginalName();
                        //Get just filename
                        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                        //Get just extension
                        $extension = $photo->getClientOriginalExtension();
                        //Filename to store
                        $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                        //Upload image
                        $path = $photo->storeAs('public/userImages', $fileNameToStore);
                        
                        $image = new UserImage;
                        $image->name = $fileNameToStore;
                        $image->user_id = $my_id;
                        $image->save();
                    }
                    
                }
                    

                    return response()->json(['message' => 'Images saved successfully']);
                
                
                
            } else {
                return Redirect::to('/login');
            }

        } catch (Exception $ex) {
            return Redirect::to('/serverError');
        }

    }

    public function getUserImages()
    {
        try
        {
            if($user = Auth::user())
            {
                $my_id = auth()->user()->id;
                $user = User::find($my_id);
                $images = $user->userimages;

                return view('images.userimages')->with('images',$images);
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
