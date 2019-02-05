<!DOCTYPE html>
  <html>
  <head>
    <link href='https://serv2.raiolanetworks.es/wp-content/uploads/onepagecheckout1.png' rel='shortcut icon' type='image/png'>
  	<title>Ingresar Solicitud de Compra</title>
  	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript">
      
    function RefrescaProducto(){
        var ip = [];
        var i = 0;
        $('.iProduct').each(function(index, element) {
            i++;
            ip.push({ id_pro : $(this).val() });
        });

        if (i > 0) {
            $('#guardar').removeAttr('disabled','disabled');
        }
        var ipt=JSON.stringify(ip); 
        $('#ListaPro').val(encodeURIComponent(ipt));
    } 

    function agregarProducto() {
            
            var newtr = '<tr class="item">';
            newtr = newtr + '<td class="iProduct" hidden >';
            newtr = newtr + '<td><input  class="form-control" id="cantidadP[]" name="cantidadP[]" maxlength="6" pattern="[0-9]{1,6}" title=" Cantidad debe ser solo numeros"   /></td>';
            newtr = newtr + '<td> <select id="unidadP[]" name="unidadP[]" class="form-control"><option value="Unidades">Unidades</option> <option value="Kilos">Kilos</option><option value="Gramos">Gramos</option><option value="Litros">Litros</option><option value="Cajas">Cajas</option></select>                                                                                                                   </td>';
            newtr = newtr + '<td><input  class="form-control" id="nombreP" name="nombreP[]" maxlength="100"   /></td>';
            newtr = newtr + '<td><input  class="form-control" id="convenioP" name="convenioP[]" maxlength="8" pattern="[0-9]{1,7}" title=" Id debe ser solo numeros" /></td>';
            newtr = newtr + '<td><button type="button" class="btn btn-danger btn-xs remove-item"><i class="fa fa-times"></i></button></td></tr>';
            
            $('#ProSelected').append(newtr); //Agrego el Producto al tbody de la Tabla con el id=ProSelected
            

            RefrescaProducto();//Refresco Productos

            $('.remove-item').off().click(function(e) {
                $(this).parent('td').parent('tr').remove(); //En accion elimino el Producto de la Tabla
                if ($('#ProSelected tr.item').length == 0)
                    $('#ProSelected .no-item').slideDown(300); 
                RefrescaProducto();
            });        
           $('.iProduct').off().change(function(e) {
                RefrescaProducto();
           }); 
    }

    function mySubmitFunction() { 
      
      if(!$('input[name="cantidadP[]"]').length){
        alert('No ha ingresado ningún producto') ; 
        return false ; 
      }
    } 

     <?php  
      $nivel= $this->session->userdata('nivel'); 
     ?>
    </script>
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
        #administracion{
          margin-right:  13px;
          float: right;
        }
      }

      legend{
        border-bottom: 1px #e5e5e5;
      } 
      .card-body {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 1.5rem;
      }
      #containerForm{ 
        margin-bottom: 100px;
      }
      #botonEnviar{
        margin-top: 50px;
        margin-bottom: 10px;
      }

       #BotonAgregar {
          margin-bottom: 20px;
      }

      .table td, .table th {
        border-top: 0px solid #dee2e6;
      }
      #tutilo2 {
            color: #ecf0f1;
            margin-top: 70px;
            margin-left:  20px;
             
         }
    </style>

  </head>
  <body>
    <!-- TITULO-->
    <div class="container" >
        <div class="row">
          
            <div  class="form-group">
              <h2>Sistema de Solicitud de Compra</h2>
              <h4 id="tutilo">Modificar borrador</h4>         
            </div>

            <div class="form-group" style="float: left; width: 40% ">
              <h5 id="tutilo2"  >Usuario: <?php echo $user->nombre.' '.$user->apellido; ?></h5>
            </div>
        </div>
    </div>

    <!-- FORMULARIO -->
    <div id="containerForm" class="container" >
      <div  id="rowlogin" class="row"  >
      <div class="card bg-light text-dark" style="width: 100%" > 
      
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

      <div class="card-body">
        <legend><strong>Formulario de Ingreso</strong> 
          <a id="cerrarsesion" href="<?php echo base_url('index.php/solicitud/logout');?>" class="btn btn-danger">Cerrar Sesión</a>
          <a id="administracion" href="<?php echo base_url('index.php/solicitud/admin');?>" class="btn btn-secondary" <?php if($nivel!=4){echo 'style="display:none;"';}?>>Administración</a>
          <a id="administracion" href="<?php echo base_url('index.php/solicitud/missolicitudes');?>" class="btn btn-secondary"  >Mis Solicitudes</a>
           
        </legend> 
        <hr>
      <div class="btn-group btn-group-justified" style="width: 100%"    >
        <!--
      <form id="form" onsubmit="return mySubmitFunction(event)"  action="<?php echo base_url('index.php/solicitud/submit')?>"  method="post"> 
-->

        <?php 
          $attributes = array(
            "class" => "form-horizontal", 
            "id"    => "form", 
            "name" => "form",
            "onsubmit" => "return mySubmitFunction(event)" 

          );
          echo form_open(base_url('index.php/solicitud/submit'), $attributes);?>

        <h5><strong>I. Individualización de la compra solicitada.</strong></h5>
        <hr> 
        <!-- CONTENIDO DE FORMULARIO -->
        <!-- Productos -->
        <div class="container">   
          <input type="hidden" id="ListaPro" name="ListaPro" value=""  />
          <div name="productos">
            <table id="TablaPro" class="table">
              <button type="button" class="btn btn-info"   id="BotonAgregar"  onclick="agregarProducto()" data-target="#myModal">Agregar producto</button>
                <thead>
                    <tr>
                      <th style="width: 90px;">Cantidad</th>
                      <th style="width: 110px;">Unidad</th>
                      <th>Detalle del bien o servicio que se requiere</th>
                      <th style="width: 120px;">ID CM</th>
                    </tr>
                </thead>
                 <tbody id="ProSelected"><!--Ingreso un id al tbody-->

                  <?php 
                  if($productos){
                    foreach ($productos as $producto){
                    ?>  


                    <tr class="item">
                          <td>
                              <input  class="form-control" id="cantidadP" name="cantidadP[]" maxlength="6" pattern="[0-9]{1,6}" title=" Cantidad debe ser solo numeros" value="<?php echo $producto['cantidad'];?>"    />
                          </td>
                          <td> 
                            <select id="unidadP" name="unidadP[]" class="form-control" >                               
                              <option <?php if ( $producto['unidad'] =="Unidades") {echo "selected"; } ?> value="Unidades">Unidades</option> 
                              <option <?php if ( $producto['unidad'] =="Kilos") {echo "selected"; } ?> value="Kilos">Kilos</option>
                              <option <?php if ( $producto['unidad'] =="Gramos") {echo "selected"; } ?> value="Gramos">Gramos</option>
                              <option <?php if ( $producto['unidad'] =="Litros") {echo "selected"; } ?> value="Litros">Litros</option>
                              <option <?php if ( $producto['unidad'] =="Cajas") {echo "selected"; } ?> value="Cajas">Cajas</option>
                            </select>                                                                                                              
                          </td>
                          <td>
                            <input class="form-control" id="nombreP" name="nombreP[]" maxlength="100" value="<?php echo $producto['detalle']; ?>" />
                          </td>
                          <td>
                            <input  class="form-control" id="convenioP" name="convenioP[]" maxlength="8" pattern="[0-9]{1,7}" title=" Id debe ser solo numeros"  />
                          </td>
                          <td>
                            <button type="button" class="btn btn-danger btn-xs remove-item"><i class="fa fa-times"></i></button>

                          </td>
                    </tr>

                    <?php
                  } } ?>

      </tbody>
            </table>
          </div>
        </div>
        <!-- Datos de solicitud -->
        <table class="table">
        <h5><strong>II. Consideraciones.</strong></h5>
          <tbody>
            <tr>
              <td>
                <div class="form-group" >
                  <label>Destino de los bienes o motivo de la compra <font size="3" color="red">*</font> </label>
                  <input type="text" class="form-control" id="txt_destinocompra" name="txt_destinocompra"    placeholder="Escriba aquí el destino de la compra."  maxlength="50" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9\s]+" title="Destino debe ser alfabético" value="<?php echo set_value('txt_destinocompra'); ?>">
                  <span class="text-danger"><?php echo form_error('txt_destinocompra'); ?></span>
                </div>
              </td>
              <td>
               <div class="form-group">
                  <label>Fecha esperada de recepción <font size="3" color="red">*</font></label>
                    <input class="form-control" type="date" placeholder="YYYY-MM-DD" id="txt_fecharecepcion" name="txt_fecharecepcion" value="<?php echo set_value('txt_fecharecepcion'); ?>"   >
                    <span class="text-danger"><?php echo form_error('txt_fecharecepcion'); ?></span>
                </div>
              </td> 
            </tr>
            <tr>
              <td>
                <div class="form-group">
                  <label >Lugar de recepción de productos <font size="3" color="red">*</font></label>
                  <input type="text" class="form-control" id="txt_lugarrecepcion" name="txt_lugarrecepcion"    placeholder="Escriba aquí el lugar de recepción de productos"  maxlength="50" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+" title="Lugar debe ser alfabético" value="<?php echo set_value('txt_lugarrecepcion'); ?>">
                  <span class="text-danger"><?php echo form_error('txt_lugarrecepcion'); ?></span>
                </div>
                 
              </td>
              <td>
                <div class="form-group">
                  <label>Fecha esperada de contrato (Opcional)</label>
                    <input class="form-control" type="date"  id="txt_fechacontrato" name="txt_fechacontrato" value="<?php echo set_value('txt_fechacontrato'); ?>" >
                    <span class="text-danger"><?php echo form_error('txt_fechacontrato'); ?></span>
                </div>
             </td>
            </tr>
            <tr>
              
              <td>
                 <div class="form-group">
                  <label >¿Adjunta Cotizaciones? <font size="3" color="red">*</font></label>
                   <div class="radio">
                      <label><input type="radio" id="txt_cotizaciones" name="txt_cotizaciones"  value="Si" value="<?php echo set_value('txt_cotizaciones'); ?>" <?php if(set_value('txt_cotizaciones')=="Si"){echo "checked";} ?>> Si</label>
                      <label><input type="radio" id="txt_cotizaciones" name="txt_cotizaciones" value="No" value="<?php echo set_value('txt_cotizaciones'); ?>" <?php if(set_value('txt_cotizaciones')=="No"){echo "checked";} ?>> No</label>
                      <span class="text-danger"><?php echo form_error('txt_cotizaciones'); ?></span>
                    </div>
                
                  <label >¿Adjunta Imagenes? <font size="3" color="red">*</font> </label>
                   
                    <div class="radio">
                      <label><input type="radio" id="txt_imagenes" name="txt_imagenes"  value="Si" value="<?php echo set_value('txt_imagenes'); ?>" <?php if(set_value('txt_imagenes')=="Si"){echo "checked";} ?> > Si</label>
                      <label><input type="radio" id="txt_imagenes" name="txt_imagenes" value="No" value="<?php echo set_value('txt_imagenes'); ?>" <?php if(set_value('txt_imagenes')=="No"){echo "checked";} ?>> No</label>
                      <span class="text-danger"><?php echo form_error('txt_imagenes'); ?></span>
                    </div>
                  
                </div> 

              </td>
              <td>            
                <div class="form-group">
                    <label>Hora recepción de productos (Opcional)</label>
                    <input class="form-control" type="time" id="txt_horarecepcion" name="txt_horarecepcion" value="<?php echo set_value('txt_horarecepcion'); ?>"  >
                    <span class="text-danger"><?php echo form_error('txt_horarecepcion'); ?></span>
                </div>
              </td>
            </tr>
            <tr>
              
              <td>
                <div class="form-group">
                  <label>Costo total estimado Adquisición <font size="3" color="red">*</font></label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                      </div>
                      <input type="text" class="form-control" id="txt_monto" name="txt_monto"   placeholder="Escriba aquí el monto"  pattern="[0-9]+"
                      title=" El Apellido Paterno debe ser solo numeros"  value="<?php echo set_value('txt_monto'); ?>">
                      <div class="input-group-prepend">
                        <span class="input-group-text">.-(CLP)</span>
                      </div>
                      
                    </div>
                    <span class="text-danger"><?php echo form_error('txt_monto'); ?></span>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
                <div class="form-group">
                  <label>Comentarios y/o especificaciones <font size="3" color="red">*</font></label>
                  <textarea class="form-control" id="txt_comentarios" name="txt_comentarios" rows="3"  placeholder="Haga click aqui para escribir sus comentarios o especificaciones del bien a comprar o del servicio a contratar"  ><?php echo set_value('txt_comentarios'); ?> </textarea>
                  <span class="text-danger"><?php echo form_error('txt_comentarios'); ?></span>
                </div>
          
        <h5><strong> III. Datos de la Unidad Municipal Solicitante.</strong></h5>
        <hr> 
        <table class="table">
          <tbody>
            <tr>
              

              <td>
               <div class="form-group">
                  <label>Departamento / Unidad </label>
                    <input type="text" class="form-control" id="txt_departamentosolicitante" name="txt_departamentosolicitante" pattern="[a-zA-ZñÑ\s\W]+" title=" El Apellido Paterno debe ser solo letras" 
                    value="<?php echo $user->departamento; ?>" readonly  >
                </div>
              </td> 
              <td>
                <div class="form-group" >
                  <label>Direccion solicitante</label>
                  <input type="text" class="form-control" id="txt_direccionsolicitante" name="txt_direccionsolicitante" pattern="[a-zA-ZñÑ\s\W]+"title=" El Apellido Paterno debe ser solo letras" 
                  value="<?php echo $user->direccion; ?>" readonly  >
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="form-group">
                  <label >Nombre solicitante</label>
                  <input type="text" class="form-control" id="txt_nombresolicitante" name="txt_nombresolicitante"  pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s\W]+" title=" El Apellido Paterno debe ser solo letras"
                  value="<?php echo $user->nombre.' '.$user->apellido; ?>" readonly >
                </div>            
              </td>
              <td>
                <div class="form-group">
                  <label >Cargo solicitante</label>
                  <input type="text" class="form-control" id="txt_cargosolicitante" name="txt_cargosolicitante" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s\W]+" title=" El Apellido Paterno debe ser solo letras" value="<?php echo $user->cargo;?>" readonly >
                </div>
             </td>
            </tr>
            <tr>
              <td>
                <div class="form-group">
                  <label >Teléfono de contacto </label>
                  <input type="text" class="form-control" id="txt_telefono" name="txt_telefono" pattern="[0-9]+" title=" El Apellido Paterno debe ser solo numeros" value="<?php echo $user->telefono; ?>" readonly >
                </div>        
              </td>
            </tr>
            <tr>
              <td>            
              </td>
            </tr>
          </tbody>

        </table>
              <div class="form-group">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="checkbox" id="txt_validacion" class="form-check-input" value="Si" <?php if(set_value('txt_validacion')=="Si"){echo "checked";} ?>>
                          El funcionario/a solicitante declara que: <br>
                          <strong>a)</strong> Conoce el <strong>Manual de Procedimientos de Adquisiciones</strong>, aprobado por el decreto alcaldicio N° 000X, de fecha 00-000-2019;<br>
                          <strong>b)</strong> La presente solicitud fue previamente puesta en conocimiento de su Jefatura Directa y aprobada por la misma Jefatura de la Unidad Solicitante;<br>
                          <strong>c)</strong> Se compromete a acatar la resolución, instrucciones, plazos o antecedentes que determine o solicite el <strong>Departamento de Adquisiciones</strong>, la Dirección de
                          Administración y Finanzas y/o la Dirección de Control Municipal, con la finalidad de dar fiel cumplimiento a las disposiciones establecidas en la <strong>Ley de
                          Compras (ley N° 19.886) y a su Reglamento (Decreto N° 250, de 2004, del Ministerio de Hacienda)</strong>;
                    </label>
                  </div>
                  <span class="text-danger"><?php echo form_error('txt_validacion'); ?></span>
              </div> 
              <button type="submit"  id="botonEnviar" class="btn btn-secondary btn-block" formaction="<?php echo base_url('index.php/solicitud/guardarborrador')?>">Guardar Borrador</button> 
              <button type="submit" class="btn btn-info btn-block">Enviar</button> 
     <!-- </form> -->
          <?php echo form_close(); ?>         
        </div>  
        </div>       
        </div>
        </div>    
    </div>
  </body>
</html>  

