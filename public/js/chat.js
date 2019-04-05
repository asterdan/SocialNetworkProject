var chatList = new Array();

function closeChat(id)
{
    
    $('#chat'+id).remove();
}
        function submitForm(id)
        {
            var dm = $('#formData'+id).parent().parent().find('#msgList');
            var chat = $('#formData'+id).parent().parent().parent();
            var chatbody = chat.children().find('#chatBody');
            
            
            $.ajax({
             headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                url:'/postMessage',
                type:'POST',
                data:$('#formData'+id).serialize(),
                cache:false,
                processData:false,
                success: function(response){
                    
                    $.ajax({
             headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                url:'/getMessages2',
                type:'POST',
                data:$('#formData'+id).serialize(),
                cache:false,
                processData:false,
                success: function(response){
                    var string = response;
                    var index = 0;
                    for(var i=0;i<string.length;i++)
                    {
                        if (string.charAt(i)=='<')
                        {
                            index = i;
                            break;
                        }
                    }
                    var content = string.substring(index,string.length);
                    
                    var doc = $('<b></b>');
                    doc.append(content);
                    
                    dm.html(doc);
                    chatbody.scrollTop(chatbody[0].scrollHeight);
                },
                error: function(xhr){
                    alert(xhr.statusText);
                }
                    });
                    

                },
                error: function(xhr){
                    alert(xhr.statusText);
                }
                
            });
            
            
        }

        function getMessages(selector)
        {
            
            $.ajax({
             headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                url:'/getMessages2',
                type:'POST',
                data:$('#formData'+id).serialize(),
                cache:false,
                processData:false,
                success: function(response){
                    var string = response;
                    var index = 0;
                    for(var i=0;i<string.length;i++)
                    {
                        if (string.charAt(i)=='<')
                        {
                            index = i;
                            break;
                        }
                    }
                    var content = string.substring(index,string.length);
                    
                    var doc = $('<b></b>');
                    doc.append(content);
                    selector.html(doc);
                },
                error: function(xhr){
                    alert(xhr.statusText);
                }
                
            });
        }

        
   
    $(document).ready(function(){

       

        
        var userId = null;
        var previousTarget = null;
        var clickIndex = 0;
        $('.closeChat').click(function(){
            alert($(this).parent().parent().parent().html());
            $(this).parent().parent().parent().hide();
        });



        function getChatBoxes()
        {
            
            $('.btnUser').each(function(index,value){
               
                var username = value.innerHTML;
                var id= value.id;
                getMessages(id,username);
                
                
            });

            
        }

        getChatBoxes();

        function refreshChatBoxes(){

            

            for (var i=0;i<chatList.length;i++)
            {
                var id = chatList[i].id_user;
                var userName = chatList[i].user_name;         
                refreshMessages(id,userName);
                
            }
            alert(chatList.length);
            alert('interval');
        }

        setInterval(function(){

            if($('#chatzone').is(':parent')){
                $('#chatzone').children().each(function(){
                   var string = $(this).attr('id');
                   var id = string.substring(4,string.length);
                   var messages = $(this).find('#msgList');
                   refreshWindowMessages(id,messages);
                })
            }

            for (var i=0;i<chatList.length;i++)
            {
                var id = chatList[i].id_user;
                var userName = chatList[i].user_name;         
                refreshMessages(id,userName);
                
            }
            

        },20000);

       
        
        
       
        $('.btnUser').click(function(){
           
            var user_id = $(this).attr('id');
            
            for (var i=0;i < chatList.length; i++)
            {
                     if(chatList[i].id_user == user_id)
                     {                            
                         var position = (i+1) * 325;                                               
                         chatList[i].chatbox.attr('style','z-index: 2;position:fixed;width:300px;bottom:0px; right:'+position+'px;'); 
                                      
                         $('#chatzone').append(chatList[i].chatbox);
                         $('#chatzone').find('#'+user_id).addClass('btnSendMsg');
                         $('#chatzone').find('#chatBody').scrollTop($('#chatBody')[0].scrollHeight);
                         return false;     
                     }
            }

            
            clickIndex = clickIndex + 1;
        });

        function getMessages(user_id,username){
            
            $.ajax({
             headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                url:'/getMessages2',
                type:'POST',
                data: $('#form'+user_id).serialize(),
                cache:false,
                async:false,
                processData:false,
                success: function(response){
                    var string = response;
                    var index = 0;
                    for(var i=0;i<string.length;i++)
                    {
                        if (string.charAt(i)=='<')
                        {
                            index = i;
                            break;
                        }
                    }
                    var content = string.substring(index,string.length);
                    
                    var doc = $('<b></b>');
                    doc.append(content);
                    
                   
                    var chat_box = `

                    
<div  class="card" id="chatCard" >
   <div class="card-header" id="cardHeader">
    
                <div class="row">
                    
                    <div class="col-md-9">
                        <h5 id="username">User</h5>
                    </div>
                    
                </div>
                <i id="${user_id}"  style="position:absolute;top:0;right:0; " onclick="closeChat(this.id)"  class="fa fa-window-close closeChat" aria-hidden="true" ></i>
           
   </div>
   <div class="card-body" id="chatBody">                     
         <ul id="msgList" class="list-group">
                 
         </ul>             
   </div>
   <div class="card-footer">         
      <form id="formData${user_id}" class="form-inline" onsubmit="return false;" >
          <div class="form-group">
                <input type="hidden" name="sent_to" id="sent_to${user_id}" value="${user_id}">
                <input type="text" name="body" class="form-control"  id="body${user_id}" placeholder="Enter message" style=" border-radius:5px;">  
          </div>
         &nbsp;
         <button id="${user_id}" type="button" class="btn btn-primary" onclick="submitForm(this.id)">Send</button>
      </form> 
         
   
                    
                    `;
                    var docm = $('<div id="chat'+user_id+'" style="z-index:2"></div>');
                    docm.append(chat_box);
                    docm.find('#username').html(username);
                    docm.find('#msgList').html(doc);
                    
                    clickIndex = clickIndex + 1;
                    chatList.push({id_user: user_id , chatbox: docm , chat_index: clickIndex , user_name : username});
                    
                    
                },error:function(xhr){
                    alert(xhr.responseText);
                }
                
            });
            
        }


        
        function refreshMessages(user_id,username){
            chatList = new Array();
            $.ajax({
             headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                url:'/getMessages2',
                type:'POST',
                data: $('#form'+user_id).serialize(),
                cache:false,
                async:false,
                processData:false,
                success: function(response){
                    var string = response;
                    var index = 0;
                    for(var i=0;i<string.length;i++)
                    {
                        if (string.charAt(i)=='<')
                        {
                            index = i;
                            break;
                        }
                    }
                    var content = string.substring(index,string.length);
                    
                    var doc = $('<b></b>');
                    doc.append(content);
                    
                   
                    var chat_box = `

                    
<div  class="card" id="chatCard" >
   <div class="card-header" id="cardHeader">
    
                <div class="row">
                    
                    <div class="col-md-9">
                        <h5 id="username">User</h5>
                    </div>
                    
                </div>
                <i id="${user_id}"  style="position:absolute;top:0;right:0; " onclick="closeChat(this.id)"  class="fa fa-window-close closeChat" aria-hidden="true" ></i>
           
   </div>
   <div class="card-body" id="chatBody">                     
         <ul id="msgList" class="list-group">
                 
         </ul>             
   </div>
   <div class="card-footer">         
      <form id="formData${user_id}" class="form-inline" onsubmit="return false;" >
          <div class="form-group">
                <input type="hidden" name="sent_to" id="sent_to${user_id}" value="${user_id}">
                <input type="text" name="body" class="form-control"  id="body${user_id}" placeholder="Enter message" style=" border-radius:5px;">  
          </div>
         &nbsp;
         <button id="${user_id}" type="button" class="btn btn-primary" onclick="submitForm(this.id)">Send</button>
      </form> 
         
   
                    
                    `;
                    var docm = $('<div id="chat'+user_id+'" style="z-index:2"></div>');
                    docm.append(chat_box);
                    docm.find('#username').html(username);
                    docm.find('#msgList').html(doc);
                    
                    clickIndex = clickIndex + 1;
                    chatList.push({id_user: user_id , chatbox: docm , chat_index: clickIndex , user_name : username});
                    
                    
                },error:function(xhr){
                    alert(xhr.responseText);
                }
                
            });
            
        }

        function refreshWindowMessages(user_id,window){
            var chatbody = window.parent().parent().parent().find('#chatBody');
            $.ajax({
             headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                url: '/getMessages2',
                type:'POST',
                data: $('#form'+user_id).serialize(),
                cache:false,
                async:false,
                processData:false,
                success: function(response){
                    var string = response;
                    var index = 0;
                    for(var i=0;i<string.length;i++)
                    {
                        if (string.charAt(i)=='<')
                        {
                            index = i;
                            break;
                        }
                    }
                    var content = string.substring(index,string.length);
                   
                    var doc = $('<b></b>');
                    doc.append(content);
                    window.html(doc);
                    chatbody.scrollTop(chatbody[0].scrollHeight);
                },
                error:function(xhr){
                    alert(xhr.responseText);
                }
            });


        }
        
        
        
       
        


    });