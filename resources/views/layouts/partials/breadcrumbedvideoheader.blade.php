


<div class="breadcrumb-header">
  <div class="row">
    <div class="col-sm-8" > {{-- col-sm- --}}
       <p>Active Playlist: {{ app('playlist')->title }}</p>
   </div>

   <div class="col-sm-4"> {{-- col-sm-6  --}}
     <a title="Choisir un intervalle" data-toggle="modal" data-target="#dateModal" class="right-sidebar-toggle" data-sidebar-id="main-right-sidebar"><button type="button" class="btn btn-default"><i class="fa fa-calendar"><span class="span">Period Filter</span></i></button></a>
     <a title="Choisir une chaine" data-toggle="modal" data-target="#savedVideoModal" class="right-sidebar-toggle" data-sidebar-id="main-right-sidebar"><button type="button" class="btn btn-default"><i class="fa fa-calendar"><span class="span"> Saved Channel Filter</span></i></button></a>
 </div>
</div>





<!-- date modal-->
<div class="modal fade" id="dateModal" tabindex="-1" role="dialog" aria-labelledby="dateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <!-- Modal content-->
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title"  id="dateModalLabel" >Date Pick</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">




                <form action= "{{ route('datePick')}}" class = "form-inline" method="post" data-toggle="validator">
                    {{ csrf_field() }}

                    <div class="col-sm-6">
                        <label for="">Choisir une date de début</label>
                        <input type="date" name="start_date"  value={{ app('since')}} /><br>
                        <label for="">Choisir une date de fin</label>
                        <input type="date" name="end_date" value={{ app('until') }} /><br>
                        <div class="col-sm-12">
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Choisir</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
