<div class="container">
    
        <?php $counter=0; ?>
        @foreach($images as $image)
        <?php if($counter==0) { ?>
            <div class="row">
                <div class="col-md-3"><img src={{asset('storage/userImages/'.$image->name)}} alt="" class="img img-responsive" style="width:150px;" /></div>
            <?php $counter++; } else if($counter<3) { ?>
            <div class="col-md-3"><img src={{asset('storage/userImages/'.$image->name)}} alt="" class="img img-responsive" style="width:150px;" /></div>
         <?php $counter++; } else { ?>
            <div class="col-md-3"><img src={{asset('storage/userImages/'.$image->name)}} alt=""  class="img img-responsive" style="width:150px;" /></div>
         </div>
         <br>
        <?php $counter = 0; } ?>
        
        @endforeach

</div>