{!!Form::open(['action'=>'ChatController@sendMessage','method'=>'post'])!!}
{{Form::text('sent_to')}}
{{Form::text('body')}}
{{Form::submit('Post')}}
{!!Form::close()!!}

{!!Form::open(['action'=>'FriendRequestController@acceptRequest','method'=>'post'])!!}
{{Form::text('request_id')}}
{{Form::text('username')}}
{{Form::text('friend_id')}}
{{Form::submit('Post')}}
{!!Form::close()!!}