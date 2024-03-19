@extends('layouts.install', ['no_header' => 1])
@section('title', 'NexusWeb - Update')

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
                      action="{{route('install.update')}}">
                    {{ csrf_field() }}

                    <h4> Detalhes da licença <small class="text-danger">Certifique-se de fornecer as informações corretas do Pedido</small></h4>
                    <hr/>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ml_purchase_code">Número do Pedido:*</label>
                            <input type="text" name="ML_PURCHASE_CODE" required class="form-control" id="ml_purchase_code">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ml_username">Nome Completo:*</label>
                            <input type="text" name="ML_USERNAME" required class="form-control" id="ml_username">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="ml_email">Seu Email:</label>
                          <input type="email" name="ML_EMAIL" class="form-control" id="ml_email" placeholder="opcional">
                          <p class="help-block">Para boletim informativo e suporte</p>
                        </div>
                    </div>
                    @include('install.partials.i_service')
                    @include('install.partials.e_license')

                    <div class="col-md-12">
                        <button type="submit" id="install_button" class="btn btn-primary pull-right">Eu concordo, atualize</button>
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
      $('select#MAIL_DRIVER').change(function(){
        var driver = $(this).val();

        if(driver == 'smtp'){
          $('div.smtp').removeClass('hide');
          $('input.smtp_input').attr('disabled', false);
        } else {
          $('div.smtp').addClass('hide');
          $('input.smtp_input').attr('disabled', true);
        }
      })

      $('form#details_form').submit(function(){
        $('button#install_button').attr('disabled', true).text('Installing...');
        $('div.install_msg').removeClass('hide');
        $('.back_button').hide();
      });

    })
  </script>
@endsection