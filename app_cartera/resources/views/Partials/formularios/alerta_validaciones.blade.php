@if ($errors->any())
    <div class="alert alert-danger alert-icon" role="alert">
        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <div class="alert-icon-aside">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div class="alert-icon-content">
            @foreach($errors->all() as $error)
                
                <h6>{{$error}}</h6>
                
            @endforeach
        </div>
    </div>
@endif

@if(Session::get('tipo') == 'error')
    <div class="alert alert-danger alert-icon" role="alert">
        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <div class="alert-icon-aside">
            <i class="far fa-flag"></i>
        </div>
        <div class="alert-icon-content">
        {{Session::get('message')}}
        </div>
    </div>
@endif

@if(Session::get('tipo') == 'message')
    <div class="alert alert-success alert-dismissible" role="alert" style="margin-bottom: 1em;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{Session::get('message')}}
    </div>
    <br>
@endif