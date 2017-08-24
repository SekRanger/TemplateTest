<div class="post">
  <div class="post-col-image bg-contain" style="background-image: url({{ $post['image_url'] }})"></div>
  <div class="post-col-text">
    <div class="post-title">{{ $post['title'] }}</div>
    <div class="post-body">{{ $post['body'] }}</div>
    <div class="post-created">{{ $post['interval'] }}</div>
  </div>
  <div class="post-col-author">
    <div class="author-avatar bg-contain" style="background-image: url({{ $post['author']['avatar_url'] }})"></div>
    <div class="author-name">{{ $post['author']['name'] }}</div>
    <div class="author-role">{{ $post['author']['role'] }}</div>
    <div class="author-place"><i class="material-icons">place</i>{{ $post['author']['place'] }}</div>
  </div>
</div>