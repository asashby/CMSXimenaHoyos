<table class="table table-head-fixed table-responsive-lg">
    <thead>
    <tr>
        <th>Id</th>
        <th>Series</th>
        <th>Repeticiones</th>
        <th>Acción</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($question->type_answers as $answer)
        <tr>
            <td>{{ $answer->pivot->id}}</td>
            <td> {{$answer->series}}</td>
            <td>{!! $answer->reps !!}</td>
     {{--        <td>
                @if($answer->pivot->type_answer_valid==1)
                    <input name="type_answer_valid" class="valid_answer" data-id="{{$answer->pivot->id}}" value=""
                           type="checkbox" checked>
                @else
                    <input name="type_answer_valid" class="valid_answer" data-id="{{$answer->pivot->id}}"
                           type="checkbox">
                @endif
            </td>
            <td>
                @if($answer->pivot->status==1)
                    <input name="status" class="status_answer" data-id="{{$answer->pivot->id}}" type="checkbox" checked>
                @else
                    <input name="status" class="status_answer" data-id="{{$answer->pivot->id}}" type="checkbox">
                @endif
            </td> --}}
            <td>
               {{--  <a data-toggle="tooltip"
                   href="{{url('dashboard/answers-questions')}}/{{$answer->pivot->id}}/edit" title="Editar">
                    <i class="far fa-edit text-info"></i>
                </a> --}}
                <button data-toggle="tooltip" class="ml-2 delete-answer-btn btn" data-id="{{$answer->pivot->id}}"
                        data-question="{{$answer->pivot->question_id}}" title="Eliminar">
                    <i class="far fa-trash-alt text-danger"></i>
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
