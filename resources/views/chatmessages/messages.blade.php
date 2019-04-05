<div>
@foreach($data['messages'] as $message)
@if($data['myId']==$message->sent_from_id)
<li class="list-group-item" style="border-radius: 50px 50px 5px; 50px; background-color:cornflowerblue;width:200px;">
    <div class="container">
       <div class="row">
           <div class="col-md-12">
               <b>{{$message->sent_from}}</b>
           </div>
        </div>
       <div class="row">
           <div class="col-sm-12">
                {{$message->body}}
           </div>
      </div>
      <div class="row"><div class="col-sm-2"></div><div class="col-sm-10" style="font-size:10px;"><p>Sent at: {{$message->created_at}}
      </p></div></div>
    </li><br>
@else 
<li class="list-group-item" style="border-radius: 5px 50px 50px 50px;  background-color:gainsboro;width:200px;">
    <div class="container" >
       <div class="row">
           <div class="col-sm-12">
               <b>{{$message->sent_from}}</b>
           </div>
        </div>
       <div class="row">
           <div class="col-sm-12">
                {{$message->body}}
           </div>
      </div>
      <div class="row"><div class="col-sm-2"></div><div class="col-sm-10" style="font-size:10px;"><p>Sent at: {{$message->created_at}}
      </p></div></div>
    </li><br>
@endif
@endforeach
</div>