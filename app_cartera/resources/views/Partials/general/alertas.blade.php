@if(Session::get('tipo') == 'error')
    <div class="alert alert-danger alert-dismissible" role="alert" style="margin-bottom: 1em;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{Session::get('message')}}
    </div>
    <br>
@endif

@if(Session::get('tipo') == 'message')
    <div class="alert alert-success alert-dismissible" role="alert" style="margin-bottom: 1em;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{Session::get('message')}}
    </div>
    <br>
@endif