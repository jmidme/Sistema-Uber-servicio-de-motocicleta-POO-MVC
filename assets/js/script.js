    let d = document,
    chofer = []

    window.addEventListener('load', ()=> {
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
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "processing": true,
            "serverSide": true,
            "ordering": true,
            "responsive": true,
            "info": true,
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
                        
                        let res = `<div class="d-flex justify-content-around"><div><select class="custom-select select">${option}</select></div><div class="datos">${datos}</div></div>`
                        return res
                    },
                    "targets": -1
                },
                {"data": "quantity"},
                {"data": null,
                    render: function(data, type, row){
                        let status = data['status']
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