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
<br>
<form action="send" method="post">
    {{csrf_field()}}
    to : <input type="text" name="to">
    message: <textarea type="text" name="message"> </textarea>
    <input type="submit" value="Send">
</form>
</body>
</html>