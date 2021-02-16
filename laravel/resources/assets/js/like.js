const likes_count_link_html = (post_id, like_count)=>{
  const html = `
  <hr>
    <a href="${location.origin}/posts/${post_id}/like_index" class="text-center">
      <p><strong>${like_count}</strong>名に「いいね」されています。</p>
    </a>
  <hr>
  `;
  return html;
};

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

      if(data['count'] != 0){
        $("#likes-count-link").html(likes_count_link_html(post_id, data['count']));
      }else{
        $("#likes-count-link").html('');
      }
      
    })
    .fail(function(data, xhr, err){
      alert("エラーが発生しました。");
    });
  });
});