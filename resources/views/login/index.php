<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin</title>
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
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Uber</b>Motos</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Iniciar session</p>

      <form method="post" action="login" class="log" id="formulariod">
        <div class="input-group mb-4">
          <input type="text" name="name" value="jorge" class="form-control" placeholder="Escribe tu nombre" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-4">
          <input type="password" name="password" value="1234" class="form-control" placeholder="Password" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-10 mx-auto">
            <button type="submit" class="btn btn-primary btn-block">Iniciar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->
      <p class="mt-2 mb-0">
        <a href="<?= URL::to("signup")?>" class="text-center">Registrarse</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

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