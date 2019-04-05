@extends('layouts.app')
@section('content')
<div class="container" style="margin-top:50px;">
        <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <h5><b>Search results</b></h5>
                        </div>
                        <div class="card-body">
                            @foreach($data['users'] as $user)
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" class="img img-thumbnail" />
                                </div>
                                <div class="col-md-5">
                                    <b>{{$user->name}}</b>
                                </div>
                                <div class="col-md-5">
                                    <form id="userForm{{$user->id}}">
                                    <input type="hidden" value="{{$user->id}}" name="user_id"/>
                                    </form>
                                    <button type="button" id="{{$user->id}}" class="btn btn-primary btnRequest">Add Friend</button>
                                    
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
</div>
<script>
$(document).ready(function(){
    $('.btnRequest').click(function(){
            
            if($(this).prop('disabled')==false)
            {
            var number =  $(this).attr('id');
            var button = $(this);
            $.ajax({
                    headers: 
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:'/sendFriendRequest',
                    type:'POST',
                    data:$('#userForm'+number).serialize(),
                    cache:false,
                    processData:false,
                    success: function(response){
                        button.html('Friend request sent');
                        button.prop('disabled',true);
                    },
                    error: function(xhr){
                        alert(xhr.statusText);
                    }

            });
            }
            
        });

});
</script>

@endsection