<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Listado de usuarios registrados</h3>
            </div>
            <div class="card-body">
                @if(count($course->users)>0)
                    <table id="tb_users" class="table table-head-fixed table-responsive-lg">
                        <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Inscripción</th>
                            <th>Inicio</th>
                            <th>Fin</th>
                            <th>Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($course->users as $user)
                            <tr>
                                <td>{{$user->name}} {{$user->sur_name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->pivot->insc_date}}</td>
                                <td>{{$user->pivot->init_date}}</td>
                                <td>{{$user->pivot->final_date}}</td>
                                <td>
                                    <button data-toggle="modal" data-target="#unitsListModal" title="Ver avance"
                                            data-course="{{$user->pivot->course_id}}"
                                            data-user="{{$user->id}}"
                                            class="btn btn-sm units_user_course"><i class="fa fa-eye text-primary"></i>
                                    </button>
                                    <button data-toggle="tooltip" data-id="{{$user->pivot->id}}"
                                            data-course="{{$user->pivot->course_id}}"
                                            title="Desvincular usuario del curso" class="btn btn-sm delete_user_course">
                                        <i class="fa fa-trash-alt text-danger"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h6 class="text-center text-secondary">No se encontrarón usuarios registrados en "
                        <b>{{$course->title}}</b>
                        "</h6>
                @endif
            </div>
        </div>
    </div>
</div>

