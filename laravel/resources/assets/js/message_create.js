
import {escapeStr} from "./escape";
import {message_reload} from "./message_reload";

//メッセージ表示用ajax関数
const ajax = (url, form_data, html_create)=>{
  $.ajax({
    url: url,
    type: "post",
    data: form_data,
    dataType: "json",
    processData: false,
    contentType: false
  })
  .done((data)=>{
    html_create(data);
    reset_form();
  })
  .fail(()=>{
    location.reload();
  });
};

//フォーム送信後のリセット関数
const reset_form = ()=>{
  $("textarea[name='message']").val("");
  $("html, body").animate({ scrollTop: $(document).height() }, "fast");
};

//メッセージ要素作成関数
const message_element = (data)=>{
  $("#no-text").remove();
  const message_own = $("<div>").addClass("message own").attr("data-message-id", data.id);

  const message_top = $("<div>").addClass("message-top");
  const message_content = $("<div>").addClass("message-content").html(escapeStr(data.message));
  message_top.append(message_content);

  const message_bottom = $("<div>").addClass("message-bottom");
  const message_time = $("<p>").addClass("message-time").text(data.created_at.substr(0,16));
  message_bottom.append(message_time);

  message_own.append(message_top);
  message_own.append(message_bottom);

  $("#message").append(message_own);
};

$(function(){
  $("#form-bar").on("submit",(e)=>{
    e.preventDefault();
    const form_data = new FormData(e.target);
    if(form_data.get('message') == ''){
      return false;
    }
    const url = $(e.target).attr("action");
    const create_ajax = ()=>{ajax(url, form_data, message_element)};
    message_reload(create_ajax);
  });
});