@extends('layouts.app')
@section('content')
<div class="container bootstrap snippet">
    @include('include.messages')
    <div class="row">
  		<div class="col-sm-10"><h1>User name</h1></div>
    	<div class="col-sm-2"><a href="/users" class="pull-right"><img title="profile image" class="img-circle img-responsive" src="http://www.gravatar.com/avatar/28fd20ccec6865e2d5f0e1f4446eb7bf?s=100"></a></div>
    </div>
    <div class="row">
  		<div class="col-sm-3"><!--left col-->
              

      <div class="text-center">
        <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
        <h6>Upload a different photo...</h6>
        <input type="file" class="text-center center-block file-upload">
      </div></hr><br>

               
          <div class="panel panel-default">
            <div class="panel-heading">Website <i class="fa fa-link fa-1x"></i></div>
            <div class="panel-body"><a href="http://bootnipets.com">bootnipets.com</a></div>
          </div>
          
          
          <ul class="list-group">
            <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Shares</strong></span> 125</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Likes</strong></span> 13</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Posts</strong></span> 37</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Followers</strong></span> 78</li>
          </ul> 
               
          <div class="panel panel-default">
            <div class="panel-heading">Social Media</div>
            <div class="panel-body">
            	<i class="fa fa-facebook fa-2x"></i> <i class="fa fa-github fa-2x"></i> <i class="fa fa-twitter fa-2x"></i> <i class="fa fa-pinterest fa-2x"></i> <i class="fa fa-google-plus fa-2x"></i>
            </div>
          </div>
          
        </div><!--/col-3-->
    	<div class="col-sm-9">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Home</a></li>&nbsp;&nbsp;
                <li><a data-toggle="tab" href="#messages">Upload image</a></li>&nbsp;&nbsp;
                <li><a data-toggle="tab" href="#images">Images</a></li>&nbsp;&nbsp;
                <li><a data-toggle="tab" href="#settings">Menu 2</a></li>
              </ul>

              
          <div class="tab-content">
              <hr>
            <div class="tab-pane active" id="home">
                <div class="container">
                  {!! Form::open(['action'=>'ProfilePageController@createPost','method'=>'POST'])!!}
                  <div class="form-group">
                      {{Form::label('title','Title')}}
                      {{Form::text('title','',['class'=>'form-control','placeholder'=>'Enter tile'])}}
                  </div>
                  <div class="form-group">
                      {{Form::label('body','Body')}}
                      {{Form::textarea('body','',['class'=>'form-control','placeholder'=>'Enter body'])}}
                  </div>
                  {{Form::submit('Post',['class'=>'btn btn-primary'])}}
                  {!! Form::close() !!}
                </div>
              <hr>
              <div class="container">
                  
                  @foreach($data["posts"] as $post)
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <h3>{{$post->title}}</h3>
                      </div>
                      <div class="panel-body">
                          {{$post->body}}
                      </div>
                    </div>
                    @endforeach
                
              </div>
             </div><!--/tab-pane-->
             <div class="tab-pane" id="messages">
                   <div class="panel panel-default">
                       <div class="panel-heading">
                           Upload one picture
                       </div>
                       <div class="panel-body">
                            {!! Form::open(['action'=>'ProfilePageController@uploadImage','method'=>'POST','enctype'=>'multipart/form-data'])!!}
                    
                    <div class="form-group">
                        {{Form::label('Image','Image')}}
                        {{Form::file('name')}}
                    </div>
                    {{Form::submit('Post',['class'=>'btn btn-primary'])}}
                    {!! Form::close() !!}
                       </div>
                    </div>
                   
                     <br>
                     <br>

                     <div class="panel panel-default">
                         <div class="panel-heading">
                             Upload multiple pictures
                             Drop them below
                         </div>
                         <div class="panel-body">
                                <div id="drop-area" style="width:400px; height:200px; border:1px dashed black; text-align: center;
                                vertical-align: middle;
                                line-height: 90px;    ">
                        
                                    </div>
                                    <br>
                                    <br>
                                    <div class="container">
                                        Uploaded images:
                                        <ul id="list1" class="list-group">
                
                                        </ul>
                                        <button class="btn btn-info" type="button" onclick="uploadImages()">Upload</button>
                                    </div>
                
                         </div>
                     </div>
                           
                    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
                    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                    <script>
                        var images;

                          function uploadImages()
                            {
                                for(var i = 0;i < images.length ; i++)
                                {
                                    createFormData(images,i);
                                }
                            }

                            function createFormData(images,i){
                                var formImage = new FormData();
                                formImage.append('name',images[i]);
                                uploadFormData(formImage);
                            }

                            function uploadFormData(formData){
                                $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                              },
                                    url: 'http://socialapp.build:8081/upload',
                                    type: 'POST',
                                    data: formData,
                                    contentType:false,
                                    cache:false,
                                    processData:false,
                                    success: function(data){
                                        alert("Image uploaded succesfully!");
                                    }
                                });
                            }

                        $(function(){
                            $("#drop-area").on('dragenter', function (e){
                                 e.preventDefault();
                                $(this).css('background', '#BBD5B8');
                             });

                             $("#drop-area").on('dragover', function (e){
                                 e.preventDefault();
                             });

                            
                            $('#drop-area').on('drop',function(e){
                                $(this).css('background','#D8F9D3');
                                e.preventDefault();
                                images = e.originalEvent.dataTransfer.files;
                                $(this).text(images.length + ' file(s) selected');
                                for(var i = 0;i < images.length ; i++)
                                {
                                    $('#list1').append('<a href="#" class="list-group-item">'+images[i].name+'</a>');
                                    
                                }
                            });

                          
                            

                            
                        
                        })
                    </script>


               
             </div><!--/tab-pane-->
             <div class="tab-pane" id="images">
                 <div class='panel panel-default'>
                     <div class="panel-heading">
                         <h3>My pictures</h3>
                     </div>
                     <div class="panel-body">
                            <table id="picTable">
                                    <?php $counter = 0; $current =0?>
                                @foreach($data["images"] as $image)
                                
                                @if($counter == $current + 4 || $counter == 0)
                                <?php $current = $counter; $counter++;?>
                                </tr>
                                <tr>
                                   <td><img style="height:100px;" src="/storage/images/{{$image->name}}"><td>
                                @else
                                <td><img style="height:100px;" src="/storage/images/{{$image->name}}"></td>
                                <?php $counter++; ?>
                                @endif
                                @endforeach
                            </table>
                     </div>
                     <br>
                     <div class="panel-footer">
                            <nav aria-label="...">
                                    <ul id="links" class="pagination">
                                           <li class="page-item"><a class="page-link previous">Previous</a><li>
                                        <?php $num = $data['total_pages']; for ($i=1;$i<11;$i++) { ?>
                                           <li class="page-item"><a  id="http://socialapp.build:8081/myprofile?page={{$i}}" class="btnLink page-link">{{$i}}</a><li>
                                       <?php  } ?>
                                       <li class="page-item"><a class="page-link next">Next</a><li>
                                    </ul>
                                   </nav>
                     </div>
                 
                    </div>
                </div>
                 
                
                
                 
                 

                
             <div class="tab-pane" id="settings">
            		
               	
                  <hr>
                  <form class="form" action="##" method="post" id="registrationForm">
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="first_name"><h4>First name</h4></label>
                              <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first name" title="enter your first name if any.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="last_name"><h4>Last name</h4></label>
                              <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name" title="enter your last name if any.">
                          </div>
                      </div>
          
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="phone"><h4>Phone</h4></label>
                              <input type="text" class="form-control" name="phone" id="phone" placeholder="enter phone" title="enter your phone number if any.">
                          </div>
                      </div>
          
                      <div class="form-group">
                          <div class="col-xs-6">
                             <label for="mobile"><h4>Mobile</h4></label>
                              <input type="text" class="form-control" name="mobile" id="mobile" placeholder="enter mobile number" title="enter your mobile number if any.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>Email</h4></label>
                              <input type="email" class="form-control" name="email" id="email" placeholder="you@email.com" title="enter your email.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>Location</h4></label>
                              <input type="email" class="form-control" id="location" placeholder="somewhere" title="enter a location">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="password"><h4>Password</h4></label>
                              <input type="password" class="form-control" name="password" id="password" placeholder="password" title="enter your password.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="password2"><h4>Verify</h4></label>
                              <input type="password" class="form-control" name="password2" id="password2" placeholder="password2" title="enter your password2.">
                          </div>
                      </div>
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                              	<button class="btn btn-lg btn-success pull-right" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                               	<!--<button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>-->
                            </div>
                      </div>
              	</form>
              </div>
               
              </div><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div>

    <script type="text/javascript">
        
        $(document).ready(function(){
            var previous;
            var current = $('#links li:eq(2)');
            var next ;
            current.addClass('active');
            var ul = $('#links');
            
            ul.each(function(){
                $(this).find('li').each(function(){
                    var current = $(this);
                    if(current.children().html()>2){
                        current.hide();
                    }
                });
            });
            $('<li class="page-item"><a class="page-link">...</a></li>').insertBefore('#links > li:eq(22)');
            var threeDots = $('#links li:eq(22)');
            
            $(".btnLink").click(function(){
                var uri = $(this).attr('id');
                current.removeClass('active');
                previous = current;
                current = $(this).parent();
                current.addClass('active');
                next = current.next().next();
                
                $.ajax({
                    type:"GET",
                    url: uri,
                    success: function(html){
                        var content = $(html).find('#picTable').html();
                        $('#picTable').html(content);                        
                    }
                });
            }); 
            $('.previous').click(function(){
                    var curr = current.prev().prev();
                    var nex = curr.prev().prev();
                    var prev = current.next().next();
                if (curr.children().html()==1)
                {
                    threeDots.show();
                }
                if (prev.children().html()!='...')
                {
                    prev.hide();
                    nex.show();      
                }    
                curr.children('a').trigger('click');             
            });      
            $('.next').click(function(){
                var prev = current.prev().prev();
                var curr = current.next().next();
                var nex = curr.next().next();
                
            
                threeDots.hide();
                
                if (prev.children().html()!= 'Previous')
                {
                    
                    prev.hide();
                }

                if(nex.children().html()!='Next')
                {
                    nex.show();
                }
                
                curr.children('a').trigger('click');
            });     
        });
    </script>



@endsection