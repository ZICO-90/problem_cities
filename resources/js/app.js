/*
require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


*/

require('./bootstrap');



import Echo from "laravel-echo"

window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

window.Echo.join('online')
    .here((users) => {
       
        users.forEach(function(user) {
           
            $('#media-list').append(`
            <li class="media" id="media-${user.id}">
                                        
                                        <div class="media-link">
                                            <div class="media-left"><img src="/Users/Picture/${user.avatar}" class="img-circle img-md" alt=""></div>
                                            <div class="media-body">
                                                <span class="media-heading text-semibold">${user.name}</span>
                                            
                                            </div>
                                            <div class="media-right media-middle">
                                                <span class="status-mark bg-success"></span>
                                            </div>
                                        </div>
                                    </li>
    
            
            `);
       
        });

     
        console.log(users);
    })
    .joining((user) => {
        console.log(user.name);

        $('#media-list').append(`
        <li class="media" id="media-${user.id}">
                                    
                                    <div class="media-link">
                                        <div class="media-left"><img src="/Users/Picture/${user.avatar}" class="img-circle img-md" alt=""></div>
                                        <div class="media-body">
                                            <span class="media-heading text-semibold">${user.name}</span>
                                        
                                        </div>
                                        <div class="media-right media-middle">
                                            <span class="status-mark bg-success"></span>
                                        </div>
                                    </div>
                                </li>

        
        `);
    })
    .leaving((user) => {
        console.log(user.name);
        $('#media-' + user.id ).remove();
       
    });



    let date = $('meta[name=date]').attr('content')

    $(document).on("keypress.key102", function(event) {
        if ($('#enter-message-chat').is(':visible')) {
    
            if (event.which == 13) {
                event.preventDefault();
                let ms = $('#enter-message-chat').val();
                let avatar = $('meta[name=avatar]').attr('content')
              
                let user_id = $('meta[name=user_id]').attr('content')
                $('#chat-list-message').append(`
                <li class="media reversed" id="media-reversed">
									<div class="media-body">
										<div class="media-content">${ms}</div>
										<span class="media-annotation display-block mt-10">${new Date(date).getHours()} :  ${new Date(date).getUTCMinutes()}<a href="#"><i class="icon-pin-alt position-right text-muted"></i></a></span>
									</div>

									<div class="media-right">
										<a href="../../../../global_assets/images/placeholders/placeholder.jpg">
											<img src="/Users/Picture/${avatar}" class="img-circle img-md" alt="">
										</a>
									</div>
								</li>
                `);

                let data = {
                    '_token': $('meta[name=csrf-token]').attr('content'),
                    message:ms
            };

                $.ajax({
                    url:'/user/user-chat/message',
                    method:'POST',
                    data:data ,  
                });
               
                $('#enter-message-chat').val('');

           
            }
    
        }
        else {
            if (event.which == 13) {
                
                return;
            }
        }
    });




    window.Echo.channel('laravel_database_chat-group')
    .listen('MessagesDelivered', (event) => {
        console.log(event);
        $('#chat-list-message').append(`
        <li class="media" id="media-text">
        <div class="media-left">
            <a >
                <img src="/Users/Picture/${event.messages.user.avatar}" class="img-circle img-md" alt="">
            </a>
        </div>

        <div class="media-body">
            <div class="media-content">${event.messages.message}</div>
            <span class="media-annotation display-block mt-10">${new Date(event.messages.created_at).getHours()} :  ${new Date(event.messages.created_at).getUTCMinutes()}  <a href="#"><i class="icon-pin-alt position-right text-muted"></i></a></span>
        </div>
    </li>

        `);
       
    });

    let user_id = $('meta[name=layout_user_id]').attr('content');
 

        
window.Echo.channel('laravel_database_status-problem.'+ user_id )
    .listen('StatusProblemEvents', (event) => {

        document.getElementById("count-notify-refresh").innerHTML =event.counts ;

        $('#list-notify-refresh').append(`
        <li class="media">
        <div class="media-left">
        <i class="btn border-warning text-warning btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-commit"></i></i>
        </div>

        <div class="media-body">
            <a href="/user/problems/detail/${event.status.id}" class="media-heading">
                <span class="text-semibold">اسم الخلل :  ${event.status.problem_name}</span>
                <span class="media-annotation pull-right"> ${new Date(event.status.created_at).getHours()} :  ${new Date(event.status.created_at).getUTCMinutes()}  </span>
            </a>

            <span class="text-muted">حالة الاخلل الان :  ${event.status.order_status} </span>
        </div>
    </li>

        `);
        });


        console.log('App.Models.User.'+user_id );

    window.Echo.channel('laravel_database_private-App.Models.User.' + user_id)
    .notification((notification) => {
      
        if(notification.type === 'broadcast.message')
        {
            console.log(notification);
            document.getElementById("count-notify-refresh").innerHTML =notification.count_notification ;
            $('#list-notify-refresh').append(`
       
            <li class="media">
                                    <div class="media-left">
                                    <i class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-commit"></i></i>
                                    </div>
    
                                    <div class="media-body">
                                    <a href="/user/problems/detail/${notification.problem_id}" class="media-heading">
                                            <span class="text-semibold">تم اضافة خلل بواسطة - ${notification.user_name}</span>
                                            <span class="text-semibold">عنوان الخلل : ${notification.problem_name}</span>
                                            <span class="media-annotation pull-right">${new Date(date).getHours()} :  ${new Date(date).getUTCMinutes()} </span>
                                        </a>
    
                                        <span class="text-muted">تنبيه للأدمن: ${notification.to_admin}</span>
                                    </div>
                                </li>
    
            `);

        }else if(notification.type === 'broadcast.comments')
          {
            console.log(notification);
            document.getElementById("count-notify-refresh").innerHTML = notification.count_notification ;
        
            $('#list-notify-refresh').append(`
       
            <li class="media">
                                    <div class="media-left">
                                    <i class="btn border-success text-success btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-commit"></i></i>
                                    </div>
    
                                    <div class="media-body">
                                    <a href="/user/problems/detail/${notification.problem_id}" class="media-heading">
                                            <span class="text-semibold">تم التعليق بواسطة - ${notification.user_name}</span>
                                            <span class="text-semibold">علي الخلل التالي : ${notification.problem_name}</span>
                                            <span class="media-annotation pull-right">${new Date(date).getHours()} :  ${new Date(date).getUTCMinutes()} </span>
                                        </a>
    
                                        <span class="text-muted">التعليق: ${notification.text_comment}</span>
                                    </div>
                                </li>
    
            `);

          } 
  
       
    });



/*

    window.Echo.channel('laravel_database_private-App.Models.User.'+ user_id )
    .listen('.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', (event) => {

        console.log(event);
        });

/*

/*

    window.Echo.private('App.Models.User.' + user_id)
    .listen('BroadcastNotificationCreated', (e) => {
        console.log('Event Notification received ', e)
        })
 */
  

/*
        window.Echo.channel(`users.${user_id}`)
    .notification((data) => {
        console.log('Event Notification data ', data);
    });
*/

  


/*

    window.Echo.channel('laravel_database_status-problem')
    .listen('StatusProblemEvents', (event) => {
        console.log(event.counts);
        console.info(event.status);
        document.getElementById("count-notify-refresh").innerHTML =event.counts ;

        $('#list-notify-refresh').append(`
        <li class="media">
        <div class="media-left">
            <img src="../../../../global_assets/images/placeholders/placeholder.jpg" class="img-circle img-sm" alt="">
        </div>

        <div class="media-body">
            <a href="/user/problems/detail/${event.status.id}" class="media-heading">
                <span class="text-semibold">اسم الخلل :  ${event.status.problem_name}</span>
                <span class="media-annotation pull-right"> ${new Date(event.status.created_at).getHours()} :  ${new Date(event.status.created_at).getUTCMinutes()}  </span>
            </a>

            <span class="text-muted">حالة الاخلل الان :  ${event.status.order_status} </span>
        </div>
    </li>

        `);
        
       
    });
    */