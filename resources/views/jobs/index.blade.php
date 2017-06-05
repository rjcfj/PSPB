@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Jobs</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('job.create') }}"> Add Jobs</a>
        </div>
    </div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

{!! Form::open(array('route' => 'job.index','method'=>'GET')) !!}

<div class="row">
    <div class="col-xs-3 col-sm-3 col-md-3">
        <div class="form-group">
            <strong>Data de início:</strong>
            {!! Form::date('idata', null, array('placeholder' => '00/00/0000','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3">
        <div class="form-group">
            <strong>Data de fim:</strong>
            {!! Form::date('fdata', null, array('placeholder' => '00/00/0000','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3">
        <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Buscar</button>
    </div>
</div>

{!! Form::close() !!}

<table class="table table-bordered">
    <tr>
        <th>N</th>
        <th>Nome</th>
        <th>Técnicas</th>
        <th width="280px">Ação</th>
    </tr>
    @foreach ($job as $key => $item)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $item->nome }}</td>
        <td>{{ $item->descricao }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('job.show',$item->id) }}">Mostrar</a>
            
            <a class="btn btn-primary" href="{{ route('job.edit',$item->id) }}">Editar</a>
            {!! Form::open(['method' => 'DELETE','route' => ['job.destroy', $item->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Excluir', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
</table>
{!! $job->render() !!}
@endsection