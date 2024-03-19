@extends('layouts.install', ['no_header' => 1])
@section('title', 'Instalação NexusWeb')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="page-header text-center">{{ config('app.name', 'NexusWeb') }}</h1>

        <div class="col-md-8 col-md-offset-2">
          @include('install.partials.nav', ['active' => 'app_details'])

          <div class="box box-primary active">
            <!-- /.box-header -->
            <div class="box-body">

              @if(session('error'))
                <div class="alert alert-danger">
                  {{ session('error') }}
                </div>
              @endif

              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                  </ul>
                </div>
              @endif

              <form class="form" method="post" 
                    action="{{route('install.installAlternate')}}" 
                    id="env_details_form">
                  {{ csrf_field() }}

                  <h4 class="install_instuction">Ei, preciso da sua ajuda. </h4>
                  <p class="install_instuction">
                    Por favor crie um arquivo com o nome <code>.env</code> no <strong>{{$envPath}}</strong> com <code>permissão de leitura e gravação</code> e cole o conteúdo abaixo. <br/> Depois de salvar as modificações do arquivo, pressione instalar.
                  </p>
                  <hr/>

                  <div class="col-md-12">
                    <div class="form-group">
                        <textarea rows="25" cols="50">{{$envContent}}</textarea>
                    </div>
                  </div>
                  
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-primary pull-right" id="install_button">Instalar</button>
                  </div>

                  <div class="col-md-12 text-center text-danger install_msg hide">
                    <h3>Instalação em andamento, não atualize, volte ou feche o navegador.</strong>
                  </h3>
              </form>
            </div>
          <!-- /.box-body -->
          </div>
        </div>

    </div>
</div>
@endsection

@section('javascript')
  <script type="text/javascript">
    $(document).ready(function(){

      $('form#env_details_form').submit(function(){
        $('button#install_button').attr('disabled', true).text('Instalando...');
        $(".install_instuction").addClass('hide');
        $('div.install_msg').removeClass('hide');
        $('textarea').addClass('hide');
        $('.back_button').hide();
      });

    })
  </script>
@endsection