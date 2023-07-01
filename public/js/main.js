$(document).ready(function(){

  
  $('.load__head').on('click', function() {
    $('.load__drop').slideToggle();
  });

  $('.filter__ico').on('click', function() {
    $('.filter__drop').slideToggle();
  });

  $('.status__head').on('click', function() {
    $('.status__list').slideToggle();
  });

  $('.open').on('click', function() {
    $(this).toggleClass('active');
    $(this).closest('.table__inner').children('.table__inline').toggleClass('active');
    return false;
  });

  const icons = document.querySelectorAll('.nav-open');
    icons.forEach (icon => {  
      icon.addEventListener('click', (event) => {
        icon.classList.toggle("open");
      });
    });

    $('.nav-open').on('click', function() {
      $('.nav').slideToggle();
    });

});	



window.addEventListener('rowChatToBottom', event => {

  $('.chat__body').scrollTop($('.chat__body')[0].scrollHeight);

});
const onscrollbody = () => {
  // alert('aahsd');
  var top = $('.chat__body').scrollTop();
  //   alert('aasd');
  if (top == 0) {

      window.livewire.emit('loadMore');
  }


// const chatBody = document
}  


window.addEventListener('updatedHeight', event => {
    let old = event.detail.height;
  //  console.log(old);
    let newHeight = $('.chat__body')[0].scrollHeight;

    let height = $('.chat__body').scrollTop(newHeight - old);


    window.livewire.emit('updateHeight', {
        height: height,
    });


}); 
const filter__item = document.querySelectorAll(".filter__item");
const filter_input = document.getElementById('filter_input');
const filter__drop = document.querySelector('.filter__drop')
filter__item.forEach((e)=>{
  e.addEventListener("click", () => {
    filter_input.value = e.getAttribute('aria-valuetext')
    filter__drop.submit()
  })
})

const link_home = document.getElementById("link_home");
link_home.addEventListener("click", ()=>{
  localStorage.setItem('header__active', 'link_home');

})
const link_studios = document.getElementById("link_studios");
link_studios.addEventListener("click", ()=>{
  localStorage.setItem('header__active', 'link_studios');
})
if(localStorage.getItem('header__active') == 'link_home'){
  link_home.classList.add("header__active")
  localStorage.removeItem('header__active')
}else if(localStorage.getItem('header__active') == 'link_studios'){
  link_studios.classList.add("header__active")
  localStorage.removeItem('header__active')
}