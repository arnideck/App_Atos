@extends('layouts.install', ['no_header' => 1])
@section('title', 'Bem Vindo a Instalação do NexusWeb')

@section('content')
<div class="container">
    
    <div class="row">
      <h3 class="text-center">{{ config('app.name', 'NexusWeb') }} Instalação <small>Etapa 1 de 3</small></h3>

        <div class="col-md-8 col-md-offset-2">
          <hr/>
          @include('install.partials.nav', ['active' => 'install'])

          <div class="box box-primary active">
            <!-- /.box-header -->
            <div class="box-body">
              <h3 class="text-success">
                Bem-vindo à instalação do NexusWeb!
              </h3>
              <p><strong class="text-danger">[IMPORTANTE]</strong> Antes de iniciar a instalação, certifique-se de ter as seguintes informações prontas:</p>

              <ol>
                <li>
                  <b>Fique por dentro dos detalhes desse projeto.</b> - <a href="https://www.youtube.com/channel/UCyopg9bRMEmE1Q9WRJYwoGg" target="_blank">Youtube</a>
                </li>
                <li>
                  <b>Nome do Aplicativo</b> - Algo curto e significativo.
                </li>
                <li>
                  <b>Informações de Banco de Dados:</b>
                  <ul>
                    <li>Username</li>
                    <li>Password</li>
                    <li>Nome do Banco</li>
                    <li>Host do Banco</li>
                  </ul>
                </li>
                <li>
                  <b>Configurações de Email</b> - Detalhes SMTP (opcional)
                </li>
                <li>
                  <b>Detalhes da compra no Mercado Livre:</b>
                  <ul>
                    <li><b>Código da Compra.</b> (Você recebeu no chat da compra)</li>
                    <li>
                      <b>Usuário Mercado Livre.</b> (Você recebeu no chat da compra)
                    </li>
                  </ul>
                </li>
              </ol>

              @include('install.partials.i_service')

              @include('install.partials.e_license')
              
              <a href="{{route('install.details')}}" class="btn btn-primary pull-right">Concordo com os termos!</a>
            </div>
          <!-- /.box-body -->
          </div>

        </div>

    </div>
</div>
@endsection
