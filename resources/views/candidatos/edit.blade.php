@extends('layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar candidato</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('candidato.index') }}"> Voltar</a>
            </div>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Houve alguns problemas com a sua entrada.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::model($candidato, ['method' => 'PATCH', 'files' => true, 'route' => ['candidato.update', $candidato->id]]) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nome:</strong>
                {!! Form::text('nome', null, array('placeholder' => 'Seu Nome','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>E-mail:</strong>
                {!! Form::email('email', null, array('placeholder' => 'Seu Email','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>CPF:</strong>
                {!! Form::text('cpf', null, array('placeholder' => 'Número de CPF','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Telefone:</strong>
                {!! Form::text('telefone', null, array('placeholder' => 'Telefone para contato','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Suas habilidades técnicas:</strong>
                {!! Form::text('tecnica', null, array('placeholder' => 'PHP, Laravel, Java, SpringBoot, Ruby, etc','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Seu link em redes sociais:</strong>
                {!! Form::text('sociais', null, array('placeholder' => 'email','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Sua experiências profissionais incluindo o trabalho atual:</strong>
                {!! Form::text('experiencia', null, array('placeholder' => 'email','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Selecionar a oportunidade:</strong>
                {!! Form::select('job_id', App\Job::pluck('nome', 'id'), null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Arquivos:</strong>
                {!! Form::file('arquivo', null, array('placeholder' => 'email','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Atualizar</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection