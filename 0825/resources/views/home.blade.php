<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Learning Laravel 5</title>
    <link href="//cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="//cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<div class="container">
    <div id="title" style="text-align:center;" class="h3">Hello Laravel5 greeting GongBiao</div>
    <div id="content">
        <ul>
            @foreach ($articles as $article)
            <li style="margin: 50px 0;">
                <div class="title">
                        <a href="{{ url('article/'.$article->id) }}">
                            <h3>{{ $article->title }} Love</h3>
                        </a>
                </div>
                <div class="body">
                    <p>{{ $article->body }}</p>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
</html>

