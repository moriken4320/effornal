const set_function = ()=>{

  // 自動補完リストを選択したら
  $(".subject-complement-item").on("mousedown touchstart",function(){
    // inputフォームに値を入れ込む
    $("#subject-title").val($(this).text());
  });

};

$(function(){

  // 科目名のフォームに何かしら入力されたら
  $("#subject-title").on("keyup",()=>{
    let keyword = $("#subject-title").val();
    
    // 何も入力されていない場合
    if(!keyword){
      // 自動補完を削除
      $("#subject-complement-list").remove();
      return false;
    }

    $.ajax({
      type: "get",
      url: "/subjects/complement/" + keyword,
      data: { "keyword": keyword },
      dataType: "json"
    })
    .done(function(data){
      // 自動補完を削除
      $("#subject-complement-list").remove();
      const subject_complement_list = $("<ul>").attr("id","subject-complement-list");
      data.forEach((subject)=>{
        const subject_complement_item = $("<li>").addClass("subject-complement-item").text(subject.name);
        subject_complement_list.append(subject_complement_item);
      });
      $("#subject-input").append(subject_complement_list);
      set_function();
    })
    .fail(function(){
      alert("エラーが発生しました。");
    });
  });

  // 科目名のinputフォームから外れた時
  $("#subject-title").on("blur", function(){
    // 自動補完リストを削除
    $("#subject-complement-list").remove();
  });

});