<div>
    {{-- Stop trying to control. --}}

    @if ($selectedConversation)
    
        <div class="chatbox_header">

            

            <div class="img_container">
                <img src="https://ui-avatars.com/api/?name={{ $receiverInstance->name }}" alt="">

            </div>


            <div class="name">
                {{ $receiverInstance->name }}
            </div>


            <div class="info">

            </div>
        </div>

        <div class="chatbox_body">
            @foreach ($messages as $message)
                <div class="msg_body  {{ auth()->id() == $message->sender_id ? 'msg_body_me' : 'msg_body_receiver' }}"
                    style="width:80%;max-width:80%;max-width:max-content">
                    @if ($message->type == 'image')
                      <a href="{{ $message->body }}" target="_blank">
                        <img src="{{ $message->body }}" alt="" class="chat_image">
                      </a>
                    @elseif ($message->type == null)
                   <span class="message_body"> {{ $message->body }}</span>
                   @elseif ($message->type == 'request')
                   <div class="message_request">
                    @php

                    $request = $requests->where("message_id", $message->id)->first();
                    $film = $films->where("id", $request->film_id)->first();
                    
                @endphp
                    <img src="{{ $message->body }}" alt="" class="chat_image">
                    <a target="_blank" href="/request/{{ $request->id }}" class="message_request_btn">Посмотреть</a>
                    <div class="message_request_info">

                        <span>{{ $request->size }}</span><span>{{ $request->quantity }}</span>
                    </div>
                   </div>
                   
                      @else
                      <a href="{{ $message->body }}" download>
                        Скачать
                        <img src="https://www.iconpacks.net/icons/2/free-file-icon-1453-thumb.png" alt="" class="chat_image">
                      </a>
                   @endif

                    <div class="msg_body_footer">
                        <div class="date">
                            {{ $message->created_at->format('m: i a') }}
                        </div>

                        <div class="read">
                            
                            @php
                                
                          if($message->user->id === auth()->id()){

                
                                    if($message->read == 0){


                                        echo'<i class="bi bi-check2 status_tick "></i> ';
                                    }
                                    else {
                                        echo'<i class="bi bi-check2-all text-primary  "></i> ';
                                    }

                          }


                            @endphp
                      

                        </div>
                    </div>
                </div>
            @endforeach
                
        </div>
        


        <x-footer></x-footer>
        <script>
            $(".chatbox_body").on('scroll', function() {
                // alert('aahsd');
                var top = $('.chatbox_body').scrollTop();
                //   alert('aasd');
                if (top == 0) {

                    window.livewire.emit('loadmore');
                }

            });
        </script>


        <script>
           window.addEventListener('updatedHeight', event => {

let old = event.detail.height;
let newHeight = $('.chatbox_body')[0].scrollHeight;

let height = $('.chatbox_body').scrollTop(newHeight - old);


window.livewire.emit('updateHeight', {
    height: height,
});


});
        </script>
    @else
        <div class="fs-4 text-center text-primary mt-5">
            Выберите чат
        </div>




    @endif


    <script>
 


        window.addEventListener('rowChatToBottom', event => {

            $('.chatbox_body').scrollTop($('.chatbox_body')[0].scrollHeight);

        });
    </script>


<script>

    $(document).on('click','.return',function(){


window.livewire.emit('resetComponent');

    });
</script>
 

<script>

window.addEventListener('markMessageAsRead',event=>{
 var value= document.querySelectorAll('.status_tick');

 value.array.forEach(element, index => {
     

    element.classList.remove('bi bi-check2');
    element.classList.add('bi bi-check2-all','text-primary');
 });

});

</script>
	
<link rel="stylesheet" type="text/css" href="/lib/jquery-modal-master/jquery.modal.min.css"> 
	
<script src="/lib/jquery-3.6.3.min.js"></script>
<script src="/lib/jquery-modal-master/jquery.modal.min.js"></script>
<script defer src="/js/main.js?v=0.0.1"></script>
</div>
