@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Criar novo candidato</h2>
        </div>
        @if (Auth::check())
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('candidato.index') }}"> Voltar</a>
        </div>
        @endif
        
    </div>
</div>
@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if (Auth::check())
{!! Form::open(array('route' => 'candidato.store','method'=>'POST')) !!}
@else
{!! Form::open(array('url' => 'jobcandidatos/store','method'=>'POST', 'files' => true)) !!}
@endif
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome:</strong>
            {!! Form::text('nome', null, array('placeholder' => 'Seu nome','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Seu Email','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>CPF:</strong>
            {!! Form::text('cpf', null, array('placeholder' => '000.000.000-00','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Telefone:</strong>
            {!! Form::text('telefone', null, array('placeholder' => '+55(88)88888-8888','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Suas habilidades técnicas:</strong>
            {!! Form::text('tecnica', null, array('placeholder' => '(PHP, Laravel, Java, SpringBoot, Ruby, etc)','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Seu link em redes sociais:</strong>
            {!! Form::text('sociais', null, array('placeholder' => 'como Lattes, Linkedin (Apenas a URL)','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Sua experiências profissionais incluindo o trabalho atual:</strong>
            {!! Form::textarea('experiencia', null, array('class' => 'form-control','style'=>'height:100px')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Selecionar a oportunidade em que deseja concorrer:</strong>
            {!! Form::select('job_id', App\Job::pluck('nome', 'id'), null, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Realizar upload de arquivos para anexar.:</strong>
            {!! Form::file('arquivo', null, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</div>
{!! Form::close() !!}
@endsection