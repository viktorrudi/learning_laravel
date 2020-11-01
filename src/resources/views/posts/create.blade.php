<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Create Post</h1>
    <form action={{route('posts.store')}} method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" type="text" id="title">
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea class="form-control" id="body" rows="3"></textarea>
        </div>
        <input type="submit" class="btn btn-primary">
    </form>
</body>
</html>
