<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Listado de unidades del curso @if(isset($title_course)) "<b>{{$title_course}}</b>
                    "@endif</h3>
            </div>
            <div class="card-body">
                @if(count($units)>0)
                    <table id="tb_users" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Título</th>
                            <th>Orden</th>
                            <th>Estado</th>
                            <th>Fecha de finalización</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($units as $unit)
                            <tr>
                                <td>{{$unit->title}}</td>
                                <td>{{$unit->order}}</td>
                                <td>
                                    @if($unit->is_completed==1)
                                        <i class="fa fa-check-circle text-success"></i>
                                    @else
                                        <i class="fa fa-clock text-warning"></i>
                                    @endif
                                </td>
                                <td>
                                    @if ($unit->date_answered =="")
                                        pendiente
                                    @else
                                        {{$unit->date_answered }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h6 class="text-center text-secondary">No se encontrarón usuarios registrados en
                        @if(isset($title_course)) "<b>{{$title_course}}</b>"@endif
                    </h6>
                @endif
            </div>
        </div>
    </div>
</div>

