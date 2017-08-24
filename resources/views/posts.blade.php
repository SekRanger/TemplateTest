<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title }}</title>

    <!-- Styles -->
    <style>
      html, body {
        background-color: #fff;
        font-family: sans-serif;
        margin: 0;
        font-size: 16px;
      }
      div {
        box-sizing: border-box;
      }
      .container {
        margin: 0 auto;
        width: 1225px;
        padding: 20px;
      }
      .post {
        border: 1px solid #ddd;
        border-radius: 4px;
        box-shadow: 0 4px 8px #eee;
        display: flex;
        padding: 16px;
        margin-top: 16px;
        background-color: #fff;
      }
      .post:nth-child(even) {
        background-color: #f0f0f0;
      }
      .bg-contain {
        background-repeat: no-repeat;
        background-position: center;
        background-color: #ddd;
        background-size: contain;
      }
      .post-col-image {
        width: 200px;
        height: 150px;
      }
      .post-col-text {
        flex: 1;
        margin: 0 16px;
      }
      .post-title {
        font-size: 1.25em;
        font-weight: bold;
      }
      .post-body {
        color: #666;
        margin: 16px 0;
        line-height: 1.5em;
      }
      .post-created {
        color: #aaa;
        font-style: italic;
      }
      .post-created::before {
        content: '\1F558';
        font-style: normal;
        display: inline-block;
        margin-right: 8px;
      }
      .post-col-author {
        width: 220px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
        border-left: 1px solid #ddd;
      }
      .post-col-author div:not(:first-child) {
        margin-top: 16px;
      }
      .author-avatar {
        width: 100px;
        height: 100px;
        border-radius: 100%;
      }
      .author-name {
        color: #c83430;
        font-weight: bold;
      }
      .author-role {

      }
      .author-place {
        vertical-align: middle;
        font-size: 14px;
      }
      .author-place .material-icons {
        font-size: 12px;
      }
      .post-paging {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 60px 0;
      }
      .post-paging a,
      .post-paging a:visited {
        display: block;
        color: #000;
        text-decoration: none;
        line-height: 35px;
        border-radius: 100%;
        text-align: center;
        margin: 0 4px;
      }
      .post-paging a:hover,
      .post-paging a:active,
      .post-paging a.active {
        color: #fff;
        background: #c83430;
      }
      .post-paging a.number {
        height: 35px;
        width: 35px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h1>{{ $title }}</h1>
      <h2>{{ $subtitle }}</h2>
      <h3>Posts</h3>
      <div class="posts">
        @each('post', $posts, 'post')
      </div>
      @include('post-paging', ['page' => $page, 'pages' => $pages])
    </div>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  </body>
</html>
