<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= URL::to("assets/plantilla/plugins/fontawesome-free/css/all.min.css")?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= URL::to("assets/plantilla/plugins/icheck-bootstrap/icheck-bootstrap.min.css")?>">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= URL::to("assets/plantilla/plugins/toastr/toastr.min.css")?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= URL::to("assets/plantilla/dist/css/adminlte.min.css")?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Uber</b>Motos</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Registrar nuevo usuario</p>

      <form method="post" action="registrar" class="log" id="formulario" enctype="" name="formusuario">
        <div class="input-group mb-3">
          <input type="text" name="name" class="form-control" placeholder="Full name" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-10 mx-auto">
            <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mt-2 mb-0">
        <a href="<?= URL::base()?>" class="text-center">Volver</a>
      </p>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="<?= URL::to("assets/plantilla/plugins/jquery/jquery.min.js")?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= URL::to("assets/plantilla/plugins/bootstrap/js/bootstrap.bundle.min.js")?>"></script>
<!-- Toastr -->
<script src="<?= URL::to("assets/plantilla/plugins/toastr/toastr.min.js")?>"></script>
<!-- AdminLTE App -->
<script src="<?= URL::to("assets/plantilla/dist/js/adminlte.min.js")?>"></script>
<script>
    let d = document,
    message = `<?= (URL::getMessages()[1])?>`,
    codigo = `<?= (URL::getMessages()[0])?>`
    if(codigo != ''){
      codigo<=0
        ?toastr.warning(message,{
            "progressBar": true,
            "timeOut": 3000
          })
        :toastr.succes(message,{
          "progressBar": true,
          "timeOut": 3000
        })
    }
</script>
</body>
</html>



<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="<?php //URL::to("assets/css/style.css")?>">
    <title>Signup</title>
</head>
<body>
    <h1 class="pt-5 pb-4 text-center">Motos Uber Signup</h1>
    <div class="my">
      <?php //URL::getMessages()?>
      <div class="d-grid gap-2 col-3 d-md-flex mx-end">
        <a href="<?php // URL::base()?>" class="btn btn-outline-success mb-4 register" id="buttonregister">Volver</a>
      </div>
      <form method="post" action="registrar" class="log" id="formulario" enctype="" name="formusuario">
        <div class="grupo-name" id="grupo-name">
            <label for="name" class="form-control-label" id="labelname">¿ Como te llamas ?</label>
            <input type="text" tabIndex="1" class="form-control mt-3 focusNext" id="name" name="name" placeholder="nombre" minlength="1" maxlength="30" autocomplete="off">
            <p class="input-error">El nombre puede contener solo letras, con una longitud de 4 a 30 caracteres</p>
        </div>
        <div class="grupo-password" id="grupo-password">
            <label for="password" class="form-control-label mt-3" id="labelpassword">Crea una clave</label>
            <input type="password" tabIndex="2" class="form-control mt-3 focusNext" id="password" name="password" placeholder="clave" autocomplete="off">
            <p class="input-error">La clave contiene una longitud de 4 a 30 caracteres</p>
        </div>
        <div class="d-grid gap-2 col-6 mx-auto">
            <button type="submit" tabIndex="" class="btn btn-primary mt-4 confirmar">Iniciar</button>
        </div>
        <p><?php // URL::getFull()?></p>
        <p><?php // URL::base()?></p>
        <p><?php // basename($_SERVER["SCRIPT_NAME"])?></p>
        <p><?php // $_SERVER["SCRIPT_NAME"]?></p>
      </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
      let d = document,
      message = `<?php // (URL::getMessages()[1])?>`,
      codigo = `<?php // (URL::getMessages()[0])?>`
      if(codigo != ''){
        codigo<=0
          ?toastr.warning(message,{
              "progressBar": true,
              "timeOut": 3000
            })
          :toastr.succes(message,{
            "progressBar": true,
            "timeOut": 3000
          })
      }
      
    </script>
</body>
</html> -->