  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1>Blank Page</h1> -->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Horario</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">
            <!-- Start creating your amazing application! -->
            <h1 class="text-center">Solicita tu horario</h1>
            <input type="hidden" name="motorcycle" id="motorcycle" value="">
            <table class="table table-hover p-1 text-center dt-responsive nowrap" style="width: 100%; font-size: 14px;" id="table-motorcycle">
                <thead class="table-light">
                    <tr>
                        <th class="text-center p-3" width="20%">Horario</th>
                        <th class="text-center p-3" width="50%">Conductor</th>
                        <th class="text-center p-3" width="15%">Cantidad Disponible</th>
                        <th class="text-center p-3" width="15%">Disponibilidad</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="<?php //URL::to("assets/css/style.css")?>">
    <title>Dashboard</title>
</head>
<body> -->
    <!-- <div class="ok">
        <a href="<?php // URL::to('finalizar')?>" class="btn btn-outline-primary mb-3" >Cerrar sesion</a>
        <h1 class="text-center">Solicita tu horario</h1>
        <input type="hidden" name="motorcycle" id="motorcycle" value="">
        <table class="table table-hover p-5 text-center" id="table-motorcycle">
            <thead class="table-light">
                <tr>
                    <th class="text-center p-3" width="20%">Horario</th>
                    <th class="text-center p-3" width="50%">Conductor</th>
                    <th class="text-center p-3" width="15%">Cantidad Disponible</th>
                    <th class="text-center p-3" width="15%">Disponibilidad</th>
                </tr>
            </thead>
        </table>
    </div> -->
    <!-- <pre> -->

        <?php // print_r($chofer)?>
    <!-- </pre>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>	
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> -->
    <!-- <script>
        // let chofer = JSON.parse('<?php //print $chofer?>')
        //     console.log(chofer)
        
        let d = document,
        chofer = []

        // d.addEventListener('DOMContentLoaded', ()=> {
            // y = JSON.parse(chofer)
            // $(document).ready( function(){
                
        d.addEventListener('DOMContentLoaded', ()=> {
            chofer1()
            listar()
        })

        let chofer1 = async () => {
            chofer = await fetch('http://localhost/ubermvc/listarchofer')
            chofer = await chofer.json()
            chofer = chofer.chofer
        }


        let listar = function() {
            let table = $('#table-motorcycle').DataTable({
                "ordering": false,
                "ajax": {
                    "method": "POST",
                    "url": "http://localhost/ubermvc/listar"
                },
                "columns":[
                    {"data": "schedule"},
                    {"data": null,
                        render: function(data, type, row){
                            let option = '',
                            datos = ''
                            if(data['user_motor_id']==0){
                                valor='selected' 
                                datos = '<p>Codigo: ------</p><p>Precio: ------</p>'
                            }else{
                                valor = ''
                            } 
                            option = `<option ${valor} value="0">Seleccionar</option>`
                            chofer.forEach(item => {
                                if(data['user_motor_id']==item.idchofer){
                                    valor='selected'
                                    datos=`<p>Codigo:  ${item.codigo}</p><p>Precio:  ${item.precio}</p>`
                                }else{
                                    valor = ''
                                }
                                    option += `<option value="${item.nombres}" ${valor}>${item.nombres}</option>`
                            })
                            let res = `<div class="d-flex justify-content-around"><div><select class="form-select select">${option}</select></div><div class="datos">${datos}</div></div>`
                            return res
                        },
                        "targets": -1
                    },
                    {"data": "quantity"},
                    {"data": null,
                        render: function(data, type, row){
                            status = data['status']
                            if(status==1){
                                return "<a href='http://localhost/ubermvc/actualizar/" + data["status"]+'_'+data['motor_id']+"'class='btn btn-warning'"+ data['disabled']+">Solicitado</a></form>"
                            }else if(status==0){
                                return "<a href='http://localhost/ubermvc/actualizar/" + data["status"]+'_'+data['motor_id']+"_marco'class='btn btn-success'"+ data['disabled']+">Solicitar</a>"
                            }
                        },
                        "targets": -1
                    }
                ]
            });
            
        }

        setTimeout(() => {
            let selected = d.querySelectorAll('.select')
            selected.forEach((input)=>{
                input.addEventListener('change', (e) => {
                    let valor = e.target.value,
                    datos = e.target.parentElement.nextElementSibling,
                    a = e.target.parentElement.parentElement.parentElement.nextElementSibling.nextElementSibling.firstElementChild,
                    href = a.getAttribute('href'),
                    arra = href.split('_')
                    chofer.forEach(item => {
                        if(valor == item.nombres){
                            p = `<p>Codigo: ${item.codigo}</p><p>Precio: ${item.precio}</p>`
                            href0 = href.indexOf('actualizar/0')
                            href1 = href.indexOf('actualizar/1')
                            console.log(href.indexOf('actualizar/0'));
                            if(href0==25){
                                url = `${arra[0]}_${arra[1]}_${item.nombres}`
                                a.setAttribute('href',url)
                            }else if(href1==25){
                                // url = 'encontro'
                            }else if(href0==-1 && href1==-1){
                                window.location.href=''
                            }
                        }
                        else if(valor == 0)
                            p = '<p>Codigo: ------</p><p>Precio: ------</p>'
                    })
                    datos.innerHTML = p
                })
            });
        },1000)
    </script>
    <script>
      message = `<?php // (URL::getMessages()[1])?>`,
      codigo = `<?php // (URL::getMessages()[0])?>`
      if(codigo != ''){
        codigo<=0
          ?toastr.warning(message,{
              "progressBar": true,
              "timeOut": 3000
            })
          :toastr.success(message,{
            "progressBar": true,
            "timeOut": 3000
          })
      }
    </script> -->
<!-- </body>
</html> -->