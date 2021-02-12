$(function(){
  $(".flash_message").slideDown(500);
  setTimeout(()=>{
    $(".flash_message").slideUp(500);
  }, 2000);
});