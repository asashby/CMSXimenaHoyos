@if(count($questions))
    <table id="questionsTable" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Id</th>
            <th>Pregunta</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($questions as $question)
            <tr>
                <td>{{ $question->id }}</td>
                <td>{{ $question->title }}</td>
                <td>
                    @if($question->is_activated==1)
                        <input name="is_activated" class="activated_question" data-id="{{$question->id}}" value=""
                               type="checkbox" checked>
                    @else
                        <input name="is_activated" class="activated_question" data-id="{{$question->id}}"
                               type="checkbox">
                @endif
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false">
                            <i class="fas fa-cog text-info"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" role="menu" style="">
                            {!! Form::open(['route' => ['questions.destroy', $question->id], 'method' => 'DELETE','class'=>'delete-item'.$question->id]) !!}
                            <button type="button" class="btn btn-md list-question-answers dropdown-item"
                                    data-id="{{$question->id}}"
                                    data-title="{{$question->title}}"
                                    data-toggle="modal" data-target="#answerListModal">
                                <i class="fas fa-file text-info"></i>
                                Ver series y repeticiones
                            </button>
                            <button type="button" class="btn btn-md add-new-question dropdown-item"
                                    data-id="{{$question->id}}"
                                    data-tile="{{$question->title}}"
                                    data-toggle="modal" data-target="#answerModal">
                                <i class="fas fa-plus-circle text-success"></i>
                                Asignar series y repeticiones
                            </button>
                            <a class="dropdown-item" data-toggle="tooltip"
                               href="{{ route('questions.edit',$question->id) }}" title="Editar">
                                <i class="far fa-edit text-info"></i>
                                Editar
                            </a>
                            <button type="button" class="btn btn-md delete-item-table dropdown-item"
                                    data-toggle="tooltip"
                                    data-id="{{$question->id}}" title="Eliminar">
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
