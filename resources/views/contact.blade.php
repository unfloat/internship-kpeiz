@extends('layouts.main')
@section('content')
<class = "form-inline" method="POST" data-toggle="validator
    {{csrf_field()}}
    to : <input type="text" name="to">
    message: <textarea type="text" name="message"> </textarea>
    <input type="submit" value="Send">
</form>
@endsection