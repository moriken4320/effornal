$(function(){
  if(document.URL.match(/users\/edit/)){
    //画像変更時、プロフィールの画像も即時に変更
    $("#input-user-image").on("change",(e)=>{
      const blob = window.URL.createObjectURL(e.target.files[0]);
      $("#user-image").attr("src", blob);
    });
  }
});