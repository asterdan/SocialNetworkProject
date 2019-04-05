<?php

namespace App\Http\Controllers;

use App\Message;
use Auth;
use DB;
use Illuminate\Http\Request;
use Redirect;

class ChatController extends Controller
{
    public function test()
    {
        return view('tests.test');
    }

    public function sendMessage(Request $request)
    {
        try
        {
            if ($user = Auth::user()) {
                $sent_from = auth()->user()->id;
                $sent_to = $request->input('sent_to');
                $body = $request->input('body');
                $message = new Message;
                $message->body = $body;
                $message->sent_from = $sent_from;
                $message->sent_to = $sent_to;
                $message->save();

                return response()->json(['sent_from' => $sent_from, 'sent_to' => $sent_to, 'body' => $body]);

            } else {
                return Redirect::to('/login');
            }

        } catch (Exception $ex) {
            return response()->json(['message'=>$ex->getMessages()]);
        }

    }

    public function getMessages(Request $request)
    {
        try
        {
            if ($user = Auth::user()) {
                $sent_from = auth()->user()->id;
                $sent_to = $request->input('sent_to');
                $msg = DB::table('messages')
                    ->select('sent_to.name as sent_to', 'sent_from.name as sent_from', 'messages.body as body', 'messages.created_at as created_at')->join('users as sent_from', 'sent_from.id', '=', 'messages.sent_from')
                    ->join('users as sent_to', 'sent_to.id', '=', 'messages.sent_to')
                    ->where(function ($query) use ($sent_from, $sent_to) {
                        $query->where('sent_from', '=', $sent_from)
                            ->orWhere('sent_from', '=', $sent_to);
                    })->join('users as u', 'u.id', '=', 'messages.sent_from')
                    ->where(function ($query) use ($sent_from, $sent_to) {
                        $query->where('sent_to', '=', $sent_to)
                            ->orWhere('sent_to', '=', $sent_from);
                    })->orderBy('created_at','asc')->get();

                $mesages = Message::where(function ($query) use ($sent_from, $sent_to) {
                    $query->where('sent_from', '=', $sent_from)
                        ->orWhere('sent_from', '=', $sent_to);
                })->join('users as u', 'u.id', '=', 'messages.sent_from')
                    ->where(function ($query) use ($sent_from, $sent_to) {
                        $query->where('sent_to', '=', $sent_to)
                            ->orWhere('sent_to', '=', $sent_from);
                    })->get();
                $json = json_encode($mesages);
                return response()->json([
                    'messages' => $msg,
                ]);
            } else {
                return Redirect::to('/login');
            }
        } catch (Exception $ex) {
            return Redirect::to('/serverError');
        }

    }

    public function getMessages2(Request $request)
    {
        try
        {
            if ($user = Auth::user()) {
                $sent_from = auth()->user()->id;
                $sent_to = $request->input('sent_to');
                $msg = DB::table('messages')
                    ->select('sent_to.name as sent_to', 'sent_from.name as sent_from', 'messages.body as body', 'messages.created_at as created_at','messages.sent_from as sent_from_id')->join('users as sent_from', 'sent_from.id', '=', 'messages.sent_from')
                    ->join('users as sent_to', 'sent_to.id', '=', 'messages.sent_to')
                    ->where(function ($query) use ($sent_from, $sent_to) {
                        $query->where('sent_from', '=', $sent_from)
                            ->orWhere('sent_from', '=', $sent_to);
                    })->join('users as u', 'u.id', '=', 'messages.sent_from')
                    ->where(function ($query) use ($sent_from, $sent_to) {
                        $query->where('sent_to', '=', $sent_to)
                            ->orWhere('sent_to', '=', $sent_from);
                    })->orderBy('created_at','asc')->get();
                var_dump($msg);
                $mesages = Message::where(function ($query) use ($sent_from, $sent_to) {
                    $query->where('sent_from', '=', $sent_from)
                        ->orWhere('sent_from', '=', $sent_to);
                })->join('users as u', 'u.id', '=', 'messages.sent_from')
                    ->where(function ($query) use ($sent_from, $sent_to) {
                        $query->where('sent_to', '=', $sent_to)
                            ->orWhere('sent_to', '=', $sent_from);
                    })->get();
                $json = json_encode($mesages);

                $data = ([
                    'myId' => $sent_from,
                    'messages' =>  $msg,
                ]);

                return view('chatmessages.messages')->with('data',$data);
                

            } else {
                return Redirect::to('/login');
            }
        } catch (Exception $ex) {
            return Redirect::to('/serverError');
        }

    }
}
