@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Usuários</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('usuarios.create') }}"> Add Usuário</a>
        </div>
    </div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Email</th>
        <th width="280px">Ação</th>
    </tr>
    @foreach ($data as $key => $user)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('usuarios.show',$user->id) }}">Mostrar</a>
            <a class="btn btn-primary" href="{{ route('usuarios.edit',$user->id) }}">Editar</a>
            {!! Form::open(['method' => 'DELETE','route' => ['usuarios.destroy', $user->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Excluir', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
</table>
{!! $data->render() !!}
@endsection