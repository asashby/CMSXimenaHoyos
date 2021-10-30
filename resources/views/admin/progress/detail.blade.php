<table class="table table-head-fixed">
    <thead>
    <tr>
        <th>Reto</th>
        <th>Estado</th>
        <th>Inscritos</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{$course->title}}</td>
        <td>
            @if($course->is_activated ==1)
                <i class="fa fa-circle text-success"></i>
            @else
                <i class="fa fa-circle text-danger"></i>
            @endif
        </td>
        <td>{{count($course->users)}}</td>
    </tr>
    </tbody>
</table>



