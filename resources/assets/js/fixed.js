$(function(){
  $("#app").css("padding-top", 77);
  if(document.URL.match(/users\/\d+/)){
    $("#post-list").css("padding-top", 189);
  }
});