@if (session('status'))
    @if (session('status')!="error")
        <div class="alert alert-success mr-3 ml-3">
            <a href="#" class="close" data-dismiss="alert"
               aria-label="close">&times;</a> {{ session('status') }}
        </div>
    @else
        <div class="alert alert-danger mr-3 ml-3">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Se
            presentó un inconveniente con esta petición. Por favor contacta con el administrador
        </div>

    @endif
@endif
@if (Session::has('error_message'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px;">
        {{ Session::get('error_message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if (Session::has('success_message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
        {{ Session::get('success_message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
