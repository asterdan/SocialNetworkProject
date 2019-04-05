@extends('layouts.app')
@section('content')

<div class="container" style="margin-top:50px;">
    <div id="rightsidebar" style="width:200px; position: fixed; right:290px;" >
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                            <b>Sponsored</b>
                    </div>
                </div>
                <div class="row">
                        <div class="col-md-12">
                                <img src="https://passionatepennypincher.com/wp-content/uploads/2017/11/Screen-Shot-2017-11-09-at-4.56.26-AM.png" style="width:100%;" />
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-12">
                                 <a href="#"><p> Come shop in wallmart ... </p></a>
                            </div>
                        </div>
              
                
            </div>
        </div>
    </div>
    <div id="leftsidebar" style="position:fixed;">
            <ul id="sidebarcard">
                    <li><b>Explore</b></li>
                    <li><a class="leftSideA" href="#"><i class="fa fa-users" aria-hidden="true"></i> Groups</a></li>
                    <li><a class="leftSideA" href="#"><i class="fa fa-file" aria-hidden="true"></i> Pages</a></li>
                    <li><a class="leftSideA" href="#"><i class="fa fa-calendar" aria-hidden="true"></i> Events</a></li>
                    <li><a class="leftSideA" href="#"><i class="fa fa-money" aria-hidden="true"></i> Fundraisers</a></li>
                    <li><a href="#"><i class="fa fa-caret-down" aria-hidden="true"></i> See More...</a></li>
                         
                 </ul>
    </div>
    <div class="row">
        <div class="col-md-2">
                
        </div>
        <div id="posts" class="col-md-6">
        

        </div>
        <div class="col-md-3">
                
        </div>
    </div>

    
<script>
    $('#leftSideA').hover(function(){
        $(this).parent().addClass('card');
        $(this).css({'background-color':'white;'});
    });

    function getAllPosts()
    {
        $.ajax({
                    url: '/getAllPosts',
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

    getAllPosts();

    setInterval(getAllPosts(),10000);
</script>
 


@endsection('content')