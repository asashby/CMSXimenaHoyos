@if(count($type_answers))
    <table id="sectionsTable" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Id</th>
            <th>Series</th>
            <th>Repeticiones</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($type_answers as $type_answer)
            <tr>
                <td>{{ $type_answer->id }}</td>
                <td>{{ $type_answer->series }}</td>
                <td>{{ $type_answer->reps }}</td>
                {{-- <td>
                    <img src="{{asset($type_answer->url_image)}}" width=200 height=100 alt="">
                </td>
                <td>{{ $type_answer->confirm_answer }}</td>--}}
                <td> 
                    {!! Form::open(['route' => ['type-answers.destroy', $type_answer->id], 'method' => 'DELETE','class'=>'delete-item'.$type_answer->id]) !!}
                    <a data-toggle="tooltip" href="{{ route('type-answers.edit',$type_answer->id) }}" title="Editar">
                        <i class="far fa-edit"></i>
                    </a>
                    <button type="button" class="btn btn-md delete-item-table" data-toggle="tooltip"
                            data-id="{{$type_answer->id}}"
                            title="Eliminar">
                        <i style="color: red;" class="fas fa-trash-alt"></i>
                    </button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <x-table></x-table>
@endif
