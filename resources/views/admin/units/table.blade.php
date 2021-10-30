@if(count($units))
    <table id="sectionsTable" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Id</th>
            <th>Zona</th>
            <th>Día</th>
            <th>Reto</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($units as $unit)
            <tr>
                <td>{{ $unit->id }}</td>
                <td>{{ $unit->title }}</td>
                <td>{{ $unit->day }}</td>
                <td>
                    @if (isset($unit->course))
                        {{ $unit->course->title }}
                    @else
                        inactiva
                    @endif
                </td>
                <td>
                    @if($unit->is_activated==1)
                        <input name="is_activated" class="activated_unit" data-id="{{$unit->id}}" value=""
                               type="checkbox" checked>
                    @else
                        <input name="is_activated" class="activated_unit" data-id="{{$unit->id}}"
                               type="checkbox">
                    @endif
                </td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false">
                            <i class="fas fa-cog text-info"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" role="menu" style="">
                            {!! Form::open(['route' => ['units.destroy', $unit->id], 'method' => 'DELETE','class'=>'delete-item'.$unit->id]) !!}
                            <a class="dropdown-item" data-toggle="tooltip"
                               href="{{ route('units.edit',$unit->id) }}" title="Editar">
                                <i class="far fa-edit text-info"></i>
                                Editar
                            </a>
                            <button type="button" class="btn btn-md delete-item-table dropdown-item"
                                    data-toggle="tooltip"
                                    data-id="{{$unit->id}}" title="Eliminar">
                                <i style="color: red;" class="fas fa-trash-alt"></i>
                                Eliminar
                            </button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <x-table></x-table>
@endif
