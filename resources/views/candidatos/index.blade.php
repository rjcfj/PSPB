@extends('layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Candidatos</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('candidato.create') }}"> Add candidatos</a>
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
            <th>N</th>
            <th>Nome</th>
            <th>Técnicas</th>
            <th>Confirmação</th>
            <th width="280px">Ação</th>
        </tr>
    @foreach ($candidato as $key => $item)
    <?php 

    $arrayBt = array(0 => 'btn-danger', 1 => 'btn-success');
    $arrayNome = array(0 => 'Desativar', 1 => 'Ativo');

    ?>
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $item->nome }}</td>
        <td>{{ $item->tecnica }}</td>
        <td><button type="button" class="btn {{ $arrayBt[$item->confirmacao] }}">{{ $arrayNome[$item->confirmacao] }}</button></td>
        <td>
            <a class="btn btn-info" href="{{ route('candidato.show',$item->id) }}">Mostrar</a>
            <a class="btn btn-primary" href="{{ route('candidato.edit',$item->id) }}">Editar</a>
            {!! Form::open(['method' => 'DELETE','route' => ['candidato.destroy', $item->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Excluir', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>
    {!! $candidato->render() !!}
@endsection