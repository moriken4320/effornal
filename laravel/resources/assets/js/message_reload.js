import {escapeStr} from "./escape";

//メッセージ表示用ajax関数
const ajax = (url, html_create, create_message)=>{
  let last_message_id = $(".message:last").data("message-id");
  if(last_message_id == null){
    last_message_id = 0;
  }

  $.ajax({
    url: url,
    type: "get",
    data: {last_message_id: last_message_id},
    dataType: "json",
  })
  .done((data)=>{
    if(data.length <= 0){
      create_message();
      return;
    }
    data.forEach((data)=>{
      html_create(data);
    });
    create_message();
  })
  .fail(()=>{
    location.reload();
  })
  .always(()=>{
  });
};

const html_create = (data) =>{
  const message_other = $("<div>").addClass("message other").attr("data-message-id", data.id);

  const message_top = $("<div>").addClass("message-top");
  let user_image = '';
  if(data.user.image != null){
    user_image = `data:image/png;base64,${data.user.image}`;
  }else{
    user_image = "/images/blank_profile.png";
  }
  const message_user_image = $("<img>").addClass("message-user-image").attr("src", user_image).attr("alt", "avatar");
  const message_content = $("<div>").addClass("message-content").html(escapeStr(data.message));
  message_top.append(message_user_image);
  message_top.append(message_content);

  const message_bottom = $("<div>").addClass("message-bottom");
  const message_time = $("<p>").addClass("message-time").text(data.created_at.substr(0,16));
  message_bottom.append(message_time);

  message_other.append(message_top);
  message_other.append(message_bottom);

  $("#message").append(message_other);
};

export const message_reload = (create_message)=>{
  ajax(`/rooms/${$("#message").attr("data-room-id")}/reload`, html_create, create_message);
};

$(function(){
  if(location.href.match(/\/rooms\/\d+/)){
    setInterval(function(){
      message_reload(function(){});
    }, 5000);
  }
});