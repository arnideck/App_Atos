@extends('layouts.install')
@section('title', 'Instalação')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <br/><br/>
          <div class="box box-primary active">
            <!-- /.box-header -->
            <div class="box-body">

              @if(session('error'))
                <div class="alert alert-danger">
                    {!! session('error') !!}
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

              <form class="form" id="details_form" method="post" 
                      action="{{$action_url}}">
                    {{ csrf_field() }}

                    <h4> Detalhes da Licenças <small class="text-danger">Certifique-se de fornecer informações corretas do Mercado Livre</small></h4>
                    <hr/>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="license_code">Código de Compra ML:*</label>
                            <input type="text" name="license_code" required class="form-control" id="license_code">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="login_username">Apelido Mercado Livre:*</label>
                            <input type="text" name="login_username" required class="form-control" id="login_username">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="ml_email">Seu Email:</label>
                          <input type="email" name="ML_EMAIL" class="form-control" id="ml_email" placeholder="opcional">
                          <p class="help-block">Para boletim informativo e suporte</p>
                        </div>
                    </div>
                    {{-- @include('install.partials.e_license') --}}

                    <div class="col-md-12">
                        <button type="submit" id="install_button" class="btn btn-primary pull-right">Eu aceito, instalar</button>
                    </div>
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
      $('form#details_form').submit(function(){
        $('button#install_button').attr('disabled', true).text('Instalando...');
        $('div.install_msg').removeClass('hide');
        $('.back_button').hide();
      });
    })
  </script>
@endsection