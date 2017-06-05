@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Você está logado!
                </div>
            </div>
        </div>
        <div class="col-md-2 col-md-offset-1">
            <div class="panel panel-default">
            <div class="panel-heading"><a href="{{ url('/jobs') }}">Jobs</a></div>

                <div class="panel-body">
                     {{ \App\Job::count() }}
                </div>
            </div>
        </div>
        <div class="col-md-2 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{ url('/candidatos') }}">Candidatos</a></div>

                <div class="panel-body">
                    {{ \App\Candidato::count() }}
                </div>
            </div>
        </div>
        <div class="col-md-2 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Usuário</div>

                <div class="panel-body">
                    {{ \App\User::count() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
