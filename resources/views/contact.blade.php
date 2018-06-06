@extends('layouts.main')
@section('content')
<form action="send" method="post">
    {{csrf_field()}}
    to : <input type="text" name="to">
    message: <textarea type="text" name="message"> </textarea>
    <input type="submit" value="Send">
</form>
@endsection