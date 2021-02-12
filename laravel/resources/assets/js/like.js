$(function(){
  $(".heart").on('click',function(){
    const post_id = $(this).data("post-id");
    const like_element = $(this);

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "put",
      url: `/posts/${post_id}/like`,
      // data: { "post_id": post_id },
      dataType: "json",
    })
    .done(function(data){

      // ログインしていない場合
      if(data.length <= 0){
        return alert("いいね機能はログイン中にのみ利用できます。");
      }

      if(data['liked']){
        like_element.addClass('liked')
      }else{
        like_element.removeClass('liked')
      }
      like_element.siblings('.like-count').text(data['count']);
      
    })
    .fail(function(data, xhr, err){
      alert("エラーが発生しました。");
    });
  });
});