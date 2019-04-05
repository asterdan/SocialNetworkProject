
@foreach($data["posts"] as $post)
<div class="row">
    <div class="col-lg-8">
            <div class="card">
                    <div class="card-heading" style="margin-top:5px;">
                        <div class="container">
                        
                            <div class="row">
                                <div class="col-sm-1">
                                    <img src="..." />
                                </div>
                                <div class="col-sm-3">
                                    <b>{{$data["user"]->name}}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" >
                        <div class="container" style="border-bottom:1px solid gainsboro">
                            <div class="row">
                                <div class="col-sm-12">
                                        <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3>{{$post->title}}</h3>
                                                </div>
                                                <div class="panel-body">
                                                    {{$post->body}}
                                                </div>
                                              </div>
                                </div>
                            </div>
                            @if($post->post_type=="With photos")
                            
                            <div class="row" style="margin-top:5px;">
                                    <div class="col-sm-12">
                                        <table>
                                            <tr>
                                                <?php $counter=0; ?>
                                                @foreach($post->postimages as $image)
                                                <?php if ($counter>7) { ?>
                                                    <td><a href="#">More...</a></td>
                                                <?php } else { ?>
                                                <td> <img src="/storage/postImages/{{$image->name}}" class="img img-responsive img-thumbnail" /></td>
                                                <?php } $counter++; ?>
                                                @endforeach
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                           
                            @else
                           
                            @endif
                        </div>
                        
                        <div class="row" style="margin-top:10px; border-bottom:1px solid gainsboro ">
                            <div class="col-sm-3">
                            </div>
                                <div class="col-sm-3">
                                    <label>12 Likes</label>
                                </div>
                                <div class="col-sm-4">
                                    <label>10 Comments</label>
                                </div>
                            
                            </div>
                            
                        <div class="row" style="margin-top:10px; border-bottom:1px solid gainsboro">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-3">
                                <label id="like"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Like</label>
                            </div>
                        </div>
                        <div class="row" style="margin-top:5px;">
                            <div class="col-sm-12">
                                <div class="comments">
                                    <div class="comment">
                                            <div class="row">
                                                    <div class="col-sm-2">
                                                        <img src="https://getuikit.com/v2/docs/images/placeholder_600x400.svg" class="img img-rounded img-thumbnail" />
            
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <b>User</b>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <label>This is a comment</label>
                                                    </div>
                                                </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
    </div>
</div>
<br>
@endforeach
