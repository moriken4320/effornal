$(function(){
  $("#app").css("padding-top", 66);
  if(document.URL.match(/users\/\d+/)){
    $("#post-list").css("padding-top", 189);
  }
});