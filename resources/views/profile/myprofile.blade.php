@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                
                    <img src="https://scontent.ftia1-1.fna.fbcdn.net/v/t1.0-9/1012767_10200756562730413_1216408222_n.jpg?_nc_cat=110&_nc_ht=scontent.ftia1-1.fna&oh=8503feb23adda9dc963172061842484c&oe=5CC2F20B" style="width:830px;height:300px;"/>
                
            </div>
            

        </div>

    </div>
    <div class="row">
        <div class="col-lg-9">
                <div class="card">
                        <div class="row" style="color:cornflowerblue">
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-9">
                                <ul id="navigation">
                                    <li id="koheshtrirjaLink"><a href="#"><b>Koheshtrirja</b></a></li>
                                    <li id="rrethMejeLink"><a href="#"><b>Rreth meje</b></a></li>
                                    <li id="miqteLink"><a href="#"><b>Miqte</b></a></li>
                                    <li id="fototLink"><a href="#"><b>Fotot</b></a></li>
                                </ul>
                            </div>
                        </div>
                </div>
        </div>
    </div>

    <div id="photosDiv" style="display:none;">
            <div class="row">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-header" >
                                <div class="row" >
                                        <div class="col-md-9"> <i class="fa fa-picture-o" aria-hidden="true"></i><b><h4>Fotot</h4></b></div>
                                        <div class="col-md-3">
                                            <button class="btn btn-default btnAddPhotos" >+ Shto foto</button>
                                            <button id="btnModal" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" style="display:none;">Open Modal</button>
                                        </div>
                                        <form id="formImages" enctype="multipart/form-data">
                                            <input type="file" id="files" multiple="multiple" name="files" style="display:none;" />
                                        </form>
                                </div>
                                
                                
                            </div>
                            <div id="images" class="card-body">
                                
                            </div>
                        </div>
                    </div>
                </div>
    </div>

    <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
      
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Do you want to upload this images?</h4>
            </div>
            <div class="modal-body">
                    <ul id="imgToUpload" class="list-group">
                            
                    </ul>
            </div>
            <div class="modal-footer">
               <button id="btnUploadImg" type="button" class="btn btn-default" >Upload</button>
              <button type="button" id="btnDismiss" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
      
        </div>
      </div>
    
    <br>
    <div id="miqteDiv" style="display:none;">
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header" >
                        <div class="row" >
                                <div class="col-md-9"> <i class="fa fa-users" aria-hidden="true"></i> <b><h4>Miqt e mi</h4></b></div>
                                <div class="col-md-3">
                                    {!!Form::open(['action'=>'FriendRequestController@frienRequestsPage','method'=>'GET'])!!}
                                    {{Form::submit('Friend Requests',['class'=>'btn btn-default'])}}
                                    {!!Form::close()!!}
                                </div>
                        </div>
                        
                    </div>
                    <div class="card-body">
                        @foreach($data['friends'] as $friend)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-3">  <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" class="img img-thumbnail" /></div>
                                                <div class="col-sm-6">{{$friend->username}}</div>
                                                <div class="col-sm-3"><button class="btn btn-default">Mik</button></div>
                                            </div>                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="rrethMejeDiv" style="display:none;">
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">
                                <i class="fa fa-users" aria-hidden="true"></i> <b><h4>Rreth meje</h4></b>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                    <div class="col-md-3" style="border-right:1px solid gainsboro">
                                            <ul id="rrethMejeNav">
                                                <li><a href="#">Te pergjithshme</a></li>      
                                            </ul>
                                    </div>
                                    <div class="col-md-6">
                                        {!!Form::open(['action'=>'AboutMeController@updateAboutMe','method'=>'POST'])!!}
                                        <div class="form-group">
                                            <div class="form-group">{{Form::text('puna','',['class'=>'form-control','placeholder'=>'Vendosni vendin e punes'])}}</div>
                                            <div class="form-group"> {{Form::text('shkolla','',['class'=>'form-control','placeholder'=>'Shkolla qe keni mbaruar'])}}</div>
                                            <div class="form-group">{{Form::text('aftesite','',['class'=>'form-control','placeholder'=>'Shkruani aftesite tuaja'])}}</div>
                                            <div class="form-group">{{Form::text('vendlindja','',['class'=>'form-control','placeholder'=>'Shkruani vendlindjen tuaj'])}}</div>
                                            <div class="form-group">{{Form::text('celular','',['class'=>'form-control','placeholder'=>'Shkruani numrin aktual te celularit'])}}</div>        
                                            {{Form::submit('Perditeso',['class'=>'btn btn-primary'])}}
                                        {!!Form::close()!!}
                                    </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <br>

    </div>
        <div id="koheshtrirjaDiv">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    Intro
                </div>
                <div class="card-body">
                    <div id="infoRrethMeje"> Informacion rreth meje ..</div>
                   
                </div>

            </div>

        </div>

        <div class="col-md-9">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header"><b>Create Post</b>&nbsp;&nbsp;<b id="addPhotos">Photos</b></div>
                        <div class="card-body" id="formPostCard">
                                {!! Form::open(['action'=>'PostsController@createPost','method'=>'POST','enctype'=>'multipart/form-data','name'=>'postForm'])!!}
                                <div class="form-group">
                                    {{Form::label('title','Title')}}
                                    {{Form::text('title','',['class'=>'form-control','placeholder'=>'Enter tile'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('body','Body')}}
                                    {{Form::textarea('body','',['class'=>'form-control','placeholder'=>'Enter body'])}}
                                </div>
                                <div class="form-group">
                                   {{Form::file('photos[]',['class'=>'form-control','multiple'=>'multiple'])}}
                                  
                                </div>
                                {{Form::submit('Post',['class'=>'btn btn-primary'])}}
                                {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <br>
           
           <div id="posts">
           </div>



                 
                   


        </div>

    </div>

    
</div>

</div>

<script>
        $(document).ready(function(){
            var listLength = null;

            getAboutMe();

            $('#miqteLink').click(function(){
                $('#koheshtrirjaDiv').hide();
                $('#rrethMejeDiv').hide();
                $('#photosDiv').hide();
                $('#miqteDiv').show();
            });
            $('#rrethMejeLink').click(function(){
                $('#koheshtrirjaDiv').hide();
                $('#miqteDiv').hide();
                $('#photosDiv').hide();
                $('#rrethMejeDiv').show();
            })

            $('#koheshtrirjaLink').click(function(){
                $('#rrethMejeDiv').hide();
                $('#miqteDiv').hide();
                $('#photosDiv').hide();
                $('#koheshtrirjaDiv').show();
               
            });

            $('#fototLink').click(function(){
                $('#rrethMejeDiv').hide();
                $('#miqteDiv').hide();
                $('#koheshtrirjaDiv').hide();
                $('#photosDiv').show();
               
                
            })

            $('#addPhotos').click(function(){
                $('#formPostCard').find("input[type=file]").trigger('click');
            })

            $('#photos[]').change(function(){
                var vals = $(this).prop('files');
                listLength = vals.length;
                
            });

            function getAboutMe(){
                $.ajax({
                    url: '/merrRrethMeje',
                    headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                    type:'GET',
                    cache:false,
                    processData:false,
                    success: function(response){
                        var html = '<li>'+response.rreth_meje.job+'</li>'
                        +'<li>'+response.rreth_meje.school+'</li>'
                        +'<li>'+response.rreth_meje.skills+'</li>'
                        +'<li>'+response.rreth_meje.birthplace+'</li>';
                        $('#infoRrethMeje').append(html);
                    },
                    error: function(xhr){
                        alert(xhr.statusText);
                    }

                });
            }
            
            function getPosts()
            {
                $.ajax({
                    url: '/getUserPosts',
                    headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                    type:'GET',
                    cache:false,
                    processData:false,
                    success: function(response){
                        $('#posts').html(response);
                    },
                    error: function(xhr){
                        alert(xhr.statusText);
                    }

                });

            }

            getPosts();
            
            $('#postForm').submit(function(){
                getPosts();
            })
            
            
        });
        </script>
@endsection

