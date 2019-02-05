<!DOCTYPE html>
  <html>
  <head>
    <link href='https://serv2.raiolanetworks.es/wp-content/uploads/onepagecheckout1.png' rel='shortcut icon' type='image/png'>
  	<title>Solicitud Ingresada</title>
  	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style type="text/css">
      body{background-color: #34495e;} 
      h2{
         color: #ecf0f1;
         font-size: 38px;
         margin-top: 10px;    
      }
      h4{
         color: #ecf0f1;
         font-size: 28px;
      }
      @media only screen and (min-width: 400px) {
              #cerrarsesion{
                float: right;
              }

              #agregarsolicitud{
                margin-right:  13px;
                float: right;
              }
              #administracion{
                margin-right:  13px;
                float: right;
              }
              #ver{
                margin-left:  23px;
                padding-right: 45px;
                padding-left:  45px;
              }
          }
     
    </style>
  </head>
 <?php  
      $nivel= $this->session->userdata('nivel'); 
     ?>
  <body>
    <!-- TITULO-->
    <div class="container" >
        <div class="row">
          <div  class="form-group">
            <h2>Solicitud de compra ingresada</h2>
          </div>
        </div>
    </div>

    <!-- FORMULARIO -->
    <div id="containerForm" class="container" >
      <div  id="rowlogin" class="row"  >
        <div class="card bg-light text-dark" style="width: 100%" > 
          <div class="card-body">
            <legend>Resumen de solicitud 
              <a id="cerrarsesion" href="<?php echo base_url('index.php/solicitud/logout');?>" class="btn btn-danger">Cerrar Sesión</a> 
              <a id="agregarsolicitud" href="<?php echo base_url('index.php/solicitud/ingresarsolicitud');?>" class="btn btn-info">Agregar solicitud</a>
               <a id="administracion" href="<?php echo base_url('index.php/solicitud/admin');?>" class="btn btn-secondary" <?php if($nivel!=4){echo 'style="display:none;"';}?>>Administración</a>
           <a id="administracion" href="<?php echo base_url('index.php/solicitud/missolicitudes');?>" class="btn btn-secondary"  >Mis Solicitudes</a>
            </legend> 
            <hr>
            <div class="btn-group btn-group-justified" style="width: 100%"    >
              <table>
                <tr>
                  <td>
                    <br> 
                   <h5>Estimado su solicitud de compra fue ingresada con número   <mark><b><?php echo '#'.$id->id_solicitud; ?></b></mark> </h5>
                  </td>
                </tr>
                <tr><td><br></td></tr>
                <tr>
                  <td>
                   <h5>Ver solicitud   <a id="ver"  target="_blank" href="<?php  echo base_url('index.php/solicitud/mpdf/'.$id->   id_solicitud);   ?>" class="btn btn-primary" > <i  class="material-icons">visibility</i></a>  </h5>
                  </td>
                </tr>
              </table>
          </div>       
        </div>
      </div>    
    </div>
  </body>
</html>  

