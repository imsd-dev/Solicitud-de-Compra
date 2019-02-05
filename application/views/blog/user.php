<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Mis Solicitudes</title>
    <link href='https://serv2.raiolanetworks.es/wp-content/uploads/onepagecheckout1.png' rel='shortcut icon' type='image/png'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style type="text/css">
         body{
            background-color: #34495e;
            font-family: Arial;
         }
         h2{
            color: #ecf0f1;
            font-size: 38px;
            font-family: inherit;
            margin-top: 20px;
            margin-left:  20px;
            margin-bottom: 0px;          
            font-weight: 700;
            line-height: 1.1;
         }

         #tutilo {
            color: #ecf0f1;
            font-size: 28px;
            margin-top: 5px;
            margin-left:  20px;
            font-weight: 700;
         }
         #tutilo2 {
            color: #ecf0f1;
            margin-top: 70px;
            margin-left:  20px;
            font-weight: 700;
         }
         .colbox {
            margin-left: 0px;
            margin-right: 0px;
         }
         @media only screen and (max-width: 400px) {
          h2 {font-size :33px;}
          h4{font-size :19px;}
         }
         /*Estilos para pantallas mayor a 1578 pixeles. Para pantallas menores, usa diseño responsivo por defecto de cada clase*/
         @media only screen and (min-width: 1578px) {
       
          #divsolicitud{
            width: 100%; 
           
            max-width: 1260px;
          }
         }

          @media only screen and (min-width: 400px) {
              #cerrarsesion{
                margin-right:  13px;
              }

              #agregarsolicitud{
                margin-right:  13px;
              }
          }
    </style>
    <script type="text/javascript">
    

      $(document).ready(function () {
          $('#entradafilter').keyup(function () {
           var rex = new RegExp($(this).val(), 'i');
            $('.contenidobusqueda tr').hide();
            $('.contenidobusqueda tr').filter(function () {
                return rex.test($(this).text());
            }).show();

         })
           orden();    

      });

      $(document).ready(function() { 
        $("table") 
        .contenidobusqueda({widthFixed: true, widgets: ['zebra']}) 
        .contenidobusquedaPager({container: $("#pager")}); 
      }); 
    </script>
    <script type="text/javascript">

        function orden(){
          if (document.form.ordenpedido[0].checked == true) {
              document.getElementById('orden').style.display='block';

            } else {
              document.getElementById('orden').style.display='none';
              document.getElementById("txt_orden").value = "";
            }
        
            if (document.form.ordenpedido[1].checked == true) {
              document.getElementById('pedido').style.display='block';
            } else {
              document.getElementById('pedido').style.display='none';
              document.getElementById("txt_numeropedido").value = "";
            }
        }
    </script>
</head>

<body >
<!-- ************************************************* Titulos ****************************** -->
  <div class="container" >
      <div class="row" >
        <div  class="form-group" style="float: right; width: 60% ">
          <h2>Sistema de Solicitud de Compra</h2>
          <h4 id="tutilo">Mis Solicitudes</h4>         
        </div>

        <div class="form-group" style="float: left; width: 40% ">
           <h5 id="tutilo2"  >Usuario: <?php echo $user->nombre.' '.$user->apellido; ?></h5>
        </div>
      </div>
  </div>
  <hr/>
   <?php $nivel= $this->session->userdata('nivel'); ?>
 
<!-- ************************************************** Tabla de puntos ********************************** -->
  <div  class="container" id="divsolicitud">
    <div class="card bg-light text-dark" style="width: 100%"  >
        <div class="card-body"  >
            <div class="btn-group btn-group-justified" role="group" style="width: 100%" aria-label="..."  >
              <div class="btn-group btn-group-lg " style="width: 100%" role="group">

                <input id="entradafilter" type="text" class="form-control" placeholder="Buscador de solicitudes" style="width: 60%;margin-right: 15px;" >
              <legend> 
                <a id="agregarsolicitud" href="<?php echo base_url('index.php/solicitud/ingresarsolicitud');?>" class="btn btn-info">Agregar solicitud</a> 
                <a id="cerrarsesion" href="<?php echo base_url('index.php/solicitud/admin');?>" class="btn btn-secondary" <?php if($nivel!=4){echo 'style="display:none;"';}?>>Administración</a>
                <a id="cerrarsesion" href="<?php echo base_url('index.php/solicitud/logout');?>" class="btn btn-danger">Cerrar Sesión</a>
                <a id="cerrarsesion" href="https://docs.google.com/document/d/1t6UVhVNdseIVu398n5yEd4QT-iOQIWzuC40YphpycLs/edit?usp=sharing" class="btn btn-warning"  >Manual</a> 
            
            
            
              </legend> 
              </div>
            </div>
        </div>       
      </div>

    
    
    <!-- ********** Mensajes ****************************** -->
    <div style="width: 100%">
      <br>
        <?php
          if($this->session->flashdata('add_msg')){
          ?>
            <div class="alert alert-danger alert-dismissible fade show">
             <button type="button" class="close" data-dismiss="alert">&times;</button>
              <?php echo $this->session->flashdata('add_msg'); ?>
            </div>
          <?php   
            }
          ?>

          <?php
            if($this->session->flashdata('success_msg')){
          ?>
            <div class="alert alert-info alert-dismissible fade show">
             <button type="button" class="close" data-dismiss="alert">&times;</button>
              <?php echo $this->session->flashdata('success_msg'); ?>
            </div>
          <?php   
            }
          ?>


          <?php
            if($this->session->flashdata('error_msg')){
          ?>
            <div class="alert alert-danger alert-dismissible fade show">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <?php echo $this->session->flashdata('error_msg'); ?>
            </div>
          <?php   
            }
          ?>
    </div>
    <div class="table-responsive" style="font-size: 13px">
      <table class="table table-dark table-striped">
            <thead>
              <tr>                
                <td>Solicitud </td>                 
                <td>OC o NP </td>
                <td>Fecha Solicitud</td>
                <td>Destino de los bienes o motivo de la compra </td>                
                <td>Responsable </td>
                <td>Estado  </td>
                <td></td>
              </tr>
            </thead>
            <tbody  class="contenidobusqueda">
              <?php 
              if($blogs){
                foreach($blogs as $blogg){
                  $id= $blogg->id_solicitud;
                  $newDate = date("d-m-Y", strtotime($blogg->fechasolicitud));    
              ?>  
              <tr>
              <td><?php echo $id;                     ?></td>
              <td><?php echo $blogg->ordendecompra.' '.$blogg->numeropedido;?></td>        
              <td><?php echo $newDate;                ?></td>                
              <td><?php echo $blogg->destinocompra;   ?></td>              
              <td><?php echo $blogg->responsable ;    ?></td>
              <td><?php echo $blogg->estado ;         ?></td>
              <td>
                <a href="<?php  echo base_url('index.php/solicitud/modificar/'.$id); ?>" class="btn btn-success" <?php if($blogg->estado !='Borrador'){echo 'hidden=""';}?>><i class="material-icons">border_color</i></span></a>
                     
                <a target="_blank" <?php if($blogg->estado =='Borrador'){echo 'hidden=""';}?> href="<?php  echo base_url('index.php/solicitud/mpdf/'.$id);?>" class="btn btn-primary"  > <i  class="material-icons">visibility</i></a> 
              </td>

              </tr>

              <?php
                }
              }
            ?>
              
            </tbody>
        </table>
    </div>
  </div>

</body>

