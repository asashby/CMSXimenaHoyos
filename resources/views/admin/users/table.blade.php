@if(count($users))
    <table id="sectionsTable" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Id</th>
            <th>Nombres</th>
            <th>Email</th>
            <th>Estado</th>
            <th>Registrados</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }} {{ $user->sur_name }}</td>
                <td>
                    {{$user->email}}
                </td>
                <td>
                    @if($user->is_activated==1)
                        <input name="is_activated" class="activated_user" data-id="{{$user->id}}" value=""
                               type="checkbox" checked>
                    @else
                        <input name="is_activated" class="activated_user" data-id="{{$user->id}}"
                               type="checkbox">
                    @endif
                </td>
                <td>
                    {{$user->created_at}}
                </td>

                <td>
                    {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE']) !!}
                    <a data-toggle="tooltip" href="{{ route('users.edit',$user->id) }}" title="Editar">
                        <i class="far fa-edit"></i>
                    </a>
                    <button class="btn btn-md" data-toggle="tooltip" href="" title="Eliminar">
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
