@extends('layouts.install', ['no_header' => 1])
@section('title', 'Instalação NexusWeb')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="page-header text-center">{{ config('app.name', 'NexusWeb') }}</h1>

        <div class="col-md-8 col-md-offset-2">
          <h3 class="text-success">Excelente! <br/>Seu aplicativo foi instalado com sucesso.</h3>
          <hr>
          <p>Todos os detalhes do aplicativo são salvos no arquivo <b>.env</b>. Você pode alterá-los a qualquer momento lá.</p>

          <p>Para começar a usar, cadastre sua empresa <a href="{{route('business.getRegister')}}">aqui</a>.</p>
        </div>
    </div>
</div>
@endsection
