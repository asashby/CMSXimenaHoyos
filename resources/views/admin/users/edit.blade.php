@extends('layouts.admin_layout')
@section('title', 'Editar Usuario')
@section('content')
<div class="content-wrapper">
    <x-position root="Usuarios" title="Usuarios" position="Editar" url="{{route('users.index')}}" />
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <x-alert />
                <div class="col-12">
                    <div class="card card-primary">
                        <x-header title="Editar usuario" url="{{route('users.index')}}" btn="Atras"
                            className="btn btn-sm bg-white" icon="fa fa-arrow-circle-left" />
                        <div id="table-courses" class="card-body">
                            {!! Form::model($user,['url' => route('users.update',$user->id),'method' => 'PUT','files' =>
                            true]) !!}
                            @include('admin.users.partials.form')
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@php
$section_ids= $userCourses;
/* foreach ($userCourses as $course){
array_push($section_ids, $course);
} */
@endphp
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        $(".assignChallenges").select2({
            width: '100%',
        });
        var data = [];
        data =
        <?php echo json_encode($section_ids); ?>;
        console.log('planIds', data);
        $(".assignChallenges").val(data).trigger('change');
    });
</script>
@endsection
