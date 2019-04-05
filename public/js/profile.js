
var images = new Array();
var files = null;
$(document).ready(function(){
    $('.btnAddPhotos').click(function(){
        $('#files').trigger('click');
    });

    $('#files').change(function(){

        files = $(this).prop('files');

        for(var i=0;i<files.length;i++)
        {
            images.push(files[i].name);
        }

        for(var i=0;i<images.length;i++)
        {
            document.getElementById('imgToUpload').innerHTML += '<li class="list-group-item">'+images[i]+'</li>';
        }

        $('#btnModal').trigger('click');
    });

    $('#btnUploadImg').click(function(){
        
            var formData = new FormData();
            for (var i=0;i<files.length;i++)
            {
                formData.append('files'+i,$('#files').prop('files')[i]);
            }
            $.ajax({
                 headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                 url:'/uploadUserImages',
                 type:'POST',
                 data:formData,
                 contentType:false,
                 cache:false,
                 processData:false,
                 success: function(response){
                    getUserImages();
                    $('#imgToUpload').html(response.message);
                    },
                 error: function(xhr,status,error){
                    alert(xhr.responseText);
                 }
             });
             files = null;
             document.getElementById('imgToUpload').innerHTML = "";
             $('#btnDismiss').trigger('click');
    });

    $('#btnDismiss').click(function(){
        files = null;
        $('#imgToUpload').html('');
            
    })

    function getUserImages()
    {
        $.ajax({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            url:'/getuserimages',
            type:'GET',
            contentType:false,
            cache:false,
            processData:false,
            async:false,
            success: function(response){
                $('#images').html(response);
            },
            error: function(xhr,status,error){
               alert(xhr.responseText);
            }
        });
    }

    getUserImages();
        
    function getPosts()
    {
        $.ajax({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            url:'/getUserPosts',
            type:'GET',
            contentType:false,
            cache:false,
            processData:false,
            async:false,
            success: function(response){
                $('#posts').html(response);
            },
            error: function(xhr,status,error){
               alert(xhr.responseText);
            }
        });
    }

    getPosts();
    


})