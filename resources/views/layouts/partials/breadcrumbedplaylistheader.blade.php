<div class="breadcrumb-header">

    <div style="margin-bottom:15px;" class="input-group">
        <div class="input-group-btn">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Playlists<span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu">
                @foreach($savedPlaylists as $id => $title )
                 <form action= "{{ url('/setplaylist')}}" class = "form-inline" method="POST" data-toggle="validator">

 {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{ $id  }}">
                                      <input class="form-control" type="submit" name="title" value="{{$title}}">





            </form>
                @endforeach
            </ul>
        </div>
        <input type="hidden" name="id" value="{{ $id }}"/>
    </div>
</div>