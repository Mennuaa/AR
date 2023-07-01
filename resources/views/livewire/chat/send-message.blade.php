<div>

@if ($selectedConversation)
<div class="send_message">
    <div class="send_message_left">
        <form class="send_message_left_info">
            <input wire:model='body' type="text" name="" id="">
            <button  wire:click.prevent='sendMessage' type="submit" class="submit">									
                <img src="img/layout/general/send.svg" alt="" style="width: 20px;height:20px;">
            </button>
            <form wire:submit.prevent="sendMessageFile" class="send_message_right_upload" enctype="multipart/form-data">
                <label class="upload__label_message">
                    <span class="upload__ico">
                            <img wire:model="file"   src="/img/layout/general/upload.png"  style="width: 20px;height:20px;" alt="">
                    </span>
                    <input wire:model="file" type="file" id="file" style="width: 20px;height:20px;" class="upload__input">
              </label> 
            </form>
        </form>
    </div>
</div>
<script>
const imageButton = document.getElementById('file');


const submitForm = ()=>{
setTimeout(() => {
   window.livewire.emit("sendMessageFile")
}, 200);
}

imageButton.addEventListener('change', ()=>{
console.log(imageButton.files[0]);
   window.livewire.emit("sendMessageFile", imageButton.files)
console.log(imageButton.value);
})
</script>
@endif
<script>

</script>
