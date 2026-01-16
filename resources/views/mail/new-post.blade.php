<!DOCTYPE html>
<html>

<head>
    <title>{{ $post->title }}</title>
</head>

<body>
    <h1>New Post: {{ $post->title }}</h1>
    <p>{{ $post->description }}</p>

    <p>Website: {{ $post->website->name }}</p>

    <hr>
    <small>Thanks,<br>{{ config('app.name') }}</small>
</body>

</html>