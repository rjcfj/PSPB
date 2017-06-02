@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Mostrando o candidato</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('candidato.index') }}"> Voltar</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome:</strong>
            {{ $candidato->nome }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>E-Mail:</strong>
            {{ $candidato->email }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>CPF:</strong>
            {{ $candidato->cpf }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Suas habilidades técnicas:</strong>
            {{ $candidato->tecnica }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Seu link em redes sociais:</strong>
            {{ $candidato->sociais }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Sua experiências profissionais incluindo o trabalho atual:</strong>
            {{ $candidato->experiencia }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Selecionar a oportunidade:</strong>
            {{ $candidato->jobs->nome }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Arquivos:</strong>
            <a href="{{ route('getentry', $candidato->arquivo) }}" target="_blank">{{ $candidato->arquivo }}</a>
        </div>
    </div>
</div>
@endsection