<!DOCTYPE html>
<html>
<head>
	<title> Solicitud N° <?php echo $blog->id_solicitud ?>  </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    
</head>
<style>
    body{ 
        font-size: 11px;
        font-family: helvetica neue;
    }
	#cuerpo{
	 
	    padding:  8px;
	    height: 200%; 
	}
	#Cabecera,#body{
		 
	    border: 2px solid lightgrey;
	    padding:  8px;
	   
	    
	    margin-right: -50px;
		margin-left:-50px ;
		
	    margin-top: -50px;      
	}
	table#t01 tr:nth-child(even) {
	    background-color: #eee;
	}
	table#t01 tr:nth-child(odd) {
	   background-color: #fff;
	}
	table#t01 th {
	    background-color: lightgrey;
	    color: black;
	}
</style>

<body >
    <!---->
<section id="cuerpo"  >
<div id="Cabecera">
	<div style=" margin-bottom: -120px ; ">
		<img  src="logo_firma.jpg" height="82" width="52" style="float: left;">

		<div style=" float: left; margin-left: 8px; margin-top: -10px; width: 40%; text-align: center; font-size: 13px;">
		 <p style="float: left;"> Ilustre Municipalidad de Santo Domingo  
		 	<br> Direccion de Administración y Finanzas 
		 	<br> Departamento de Adquisiciones </p>
		</div>

		<div style=" float: right; margin-right: 10px; margin-top: -10px; width: 50%;text-align: center; ">

			<h1 style="color: #095B97; padding-bottom: -15px;"  > SOLICITUD DE COMPRA </h1> 
			<h1 >N° <?php echo $blog->id_solicitud ?></h1>
			<hr style="margin-top: -5px;" >
			<p  style="margin-top: -5px; " >Fecha de Solicitud de Compra <?php $newDate = date("d-m-Y", strtotime($blog->fechasolicitud)); echo $newDate  ?></p>
		</div>
 	</div>

    <div style=" margin-left:10px ; width: 100%; font-family: Helvetica Neue; ">
        <!-- ****** ****** --> 
    	<h3 style="color:#095B97;"> I. Individualización de la Compra Solicitada. </h3>
    	<hr style="margin-top: -10px;">
        <table id="t01" style="width: 100%; text-align: center; " >
                <tr>
                    <th style="width: 8%">Cantidad</th>
                    <th style="width: 9%">Unidad </th>
                    <th>Detalle del bien o servicio que se requiere </th>
                    <th style="width: 8%">Id CM</th>
                </tr>
               
    	            <?php 
    		            if($blogs){
    		               foreach($blogs as $blogg){    
    	            ?>  
        		<tr>
                  <td><?php echo $blogg->cantidad;?></td>
                  <td><?php echo $blogg->unidad_medida;?></td>
                  <td><?php echo $blogg->producto ; ?></td>
                  <td><?php echo $blogg->id_convenio ; ?></td>
                </tr>
                  <?php
    	                }
    	            }
                ?>     
        </table> 

        <!-- ****** ****** --> 
        <h3 style="color:#095B97;"> II. Consideraciones. </h3>
        <hr style="margin-top: -10px;">
        <table id="t1">
            <tr>
                <td style="padding-right: 70px;">
                    <label style="margin-right: -70px;" >Destino de la compra :</label>
                 </td>
                <td style="padding-right:  60px;" >
                     <b><p ><?php echo $blog->destinocompra ;?> </p></b>
                     
                </td>
                <td>
                    <label style="margin-right: -70px;">Fecha esperada de recepción :</label>
                </td>
                <td>
                    <b><p ><?php $recepcion = date("d-m-Y", strtotime($blog->fecharecepcion)); echo $recepcion;?> </p></b> 
                </td>
            </tr>
             <tr >
                <td>
                    <label style="margin-right: -70px;">Lugar de recepción de productos :</label>
                 </td>
                <td>
                    <b><p ><?php echo $blog->lugarrecepcion ;?> </p></b>  
                </td>
               <td>
                    <label style="margin-right: -70px;">Fecha esperada de contrato :</label>
                </td>
                <td>
                    <b><p ><?php $contrato = date("d-m-Y", strtotime($blog->fechacontrato)); 
                    if(!$contrato =='00-00-0000'){ echo $contrato;}else{echo "N/A";}?> </p></b> 
                </td>


            </tr>
            <tr>
                <td>
                    <label style="padding-right: -140px;">¿Adjunta Cotizaciones? :   <b><?php  echo '    '.$blog->cotizaciones;?></b></label>        
                </td>
                <td>
                    <label style="padding-right: -90px;">¿Adjunta Imagenes? : <b><?php  echo  $blog->imagenes;?></b></label> 
                </td>

                <td>
                    <label style="margin-right: -70px;">Hora recepción de productos :</label> 
                </td>
                <td>
                     <b><p ><?php $hora= $blog->horarecepcion; if(!$hora =='00:00:00'){ echo $hora;}else{echo "N/A";} ?>  </p></b>  
                </td>
              
            </tr>
          
              <tr>
                <td>
                    <label style="margin-right: -70px;">Presupuesto :</label> 
                </td>
                <td>
                     <b><p ><?php echo  "$ ".number_format($blog->costototal); ?></p></b>  
                </td>
            </tr>
        </table>
        <table id="t1">
            <tr>
                <td style="vertical-align: top; padding-right: 20px;">
                    <label style="margin-right: -20px; padding-left: 40px">Comentarios y/o especificaciones:</label>
                </td>
                <td  >
                    <b><p ><?php  echo $blog->comentarios ;?> </p></b> 
                </td>              
             
            </tr>
        </table>
        <!-- --> 
        <!-- ****** ****** --> 
        <h3 style="color:#095B97;"> III. Datos de la Unidad Municipal Solicitante. </h3>
        <hr style="margin-top: -10px;">
            <table id="t2" style="padding-bottom:  40px" >
                 <tbody>
                     <tr>
                         <td style="padding-right:  20px;" >
                             <label style="margin-right: -70px;" > Departamento / Unidad : </label>
                          </td>
                         <td style="padding-right:  90px;" >
                              <b><p ><?php echo $blog->departamento ;?> </p></b>
                         </td>
                         <td >
                             <label style="margin-right: -70px;">Direccion solicitante :  </label>
                         </td>
                         <td>
                             <b> <p ><?php echo $blog->direccionsolicitante;?>  </p></b>
                         </td>
                     </tr>
                      <tr >
                         <td>
                             <label style="margin-right: -70px;">Nombre solicitante  :</label>
                          </td>
                         <td>
                              <b><p ><?php echo $blog->nombresolicitante ;?></p></b>
                         </td>
                         <td>
                             <label style="margin-right: -70px;">Cargo solicitante :</label>
                         </td>
                         <td>
                             <b> <p ><?php echo $blog->cargosolicitante ;?></p></b>
                         </td>
                     </tr>
                     <tr>
                         <td>
                             <label style="margin-right: -70px;">Teléfono de contacto :</label>
                         </td>
                         <td>
                              <b> <p ><?php echo $blog->telefonocontacto;  ?></p> </b>
                         </td>
                         
                     </tr>
            </table>
            <table id="t2" style=" margin-bottom:15px;  "  >
                     <tr >
                         <td style="vertical-align: middle; text-align: center; padding-right: 25px;   " >
                             ________________________________________<br> 
                             <small>Firma Funcionario/a Solicitante</small>
                         </td>

                         <td style="vertical-align: middle; text-align: center; padding-right: 32px; " >
                             ________________________________________<br> 
                             <small>Firma y timbre Jefatura Solicitante</small>
                         </td>

                         <td style="vertical-align: middle; text-align: center;padding-top:12px; padding-right: 10px " >
                             ________________________________________<br> 
                             <small   >Firma y timbre Depto. Informática <br> Solo en caso de ser productos y/o servicios informáticos
                             </small>
                         </td>

                     </tr>
            </table>         
            <table id="t2"   >         
                     <tr>
                        <td>
                            <div>
                                <div>
                                     <label>
                                           El funcionario/a solicitante declara que: <br>
                                           <strong>a)</strong> Conoce el <strong>Manual de Procedimientos de Adquisiciones</strong>, aprobado por el decreto alcaldicio N° 000X, de fecha 00-000-2019;<br>
                                           <strong>b)</strong> La presente solicitud fue previamente puesta en conocimiento de su Jefatura Directa y aprobada por la misma Jefatura de la Unidad Solicitante;<br>
                                           <strong>c)</strong> Se compromete a acatar la resolución, instrucciones, plazos o antecedentes que determine o solicite el <strong>Departamento de Adquisiciones</strong>, la Dirección de
                                           Administración y Finanzas y/o la Dirección de Control Municipal, con la finalidad de dar fiel cumplimiento a las disposiciones establecidas en la <strong>Ley de
                                           Compras (ley N° 19.886) y a su Reglamento (Decreto N° 250, de 2004, del Ministerio de Hacienda)</strong>;
                                     </label>
                                </div>
                            </div> 
                               <br>
                        </td>
                     </tr>
            </table>
        <!-- ****** Parte del pdf de Adquisiciones******
            <h3 style="color:#095B97;"> IV. Autorización Presupuestaria. </h3>
            <hr style="margin-top: -10px;">
                <table id="t2">
                        <tr>
                            <td >
                                <label >Área de Gestión :</label>
                             </td>
                            <td >
                                 <input style="width: 40%"  type="text"  > 
                            </td>
                        </tr>
                         <tr>
                            <td >
                                <label  >Programar :</label>
                             </td>
                            <td >
                                 <input style="width: 40%"    type="text"  > 
                            </td>
                        </tr>
                        <tr>
                            <td >
                                <label  >Subprograma :</label>
                             </td>
                            <td >
                                 <input style="width: 40%"   type="text"  > 
                            </td>
                        </tr>
                         <tr>
                            <td >
                                <label >Código Cuenta :</label>
                             </td>
                            <td >
                                 <input style="width: 40%" type="text"  > 
                            </td>
                        </tr>
                        <tr>
                            <td >
                                <label  >Nombre Cuenta :</label>
                             </td>
                            <td >
                                 <input style="width: 40%" type="text" > 
                            </td>
                        </tr>
                         <tr>
                            <td >
                                <label  >Direccion solicitante :</label>
                             </td>
                            <td >
                                 <input style="width: 40%"  type="text"  > 
                            </td>

                        </tr>
                </table>
                <table id="t3">
                    <tr>       
                        <td>
                            <label style="margin-right: -70px;">¿Tiene saldo disponible?:</label>
                          </td>
                        <td>
                            <input  type="text"   > 
                        </td>
                        <td >
                            <label style="margin-right: -50px;">¿Cuenta extrapresupuestaria?:</label>
                        </td>
                        <td style="padding-right: 30px">
                            <input  type="text"    > 
                        </td> 
                        <td style="vertical-align: top; text-align: center;  " >
                                 _______________________________________________ <br>
                                 <small>Firma y timbre Encargado Ejecución Presuspuest.</small>
                             </td>
                    </tr>
                </table>
         -->     

        <!-- 
            <h3 style="color:#095B97;"> V. Resolución del Departamento de Adquisiciones. </h3>
            <hr style="margin-top: -10px;">
                <table id="t2" >  
                     <tr>

                         <td >
                             <label  >Sustento de la solicitud :</label>
                          </td>
                         <td >
                               <input style="width: 30%"  type="text"  > 
                         </td>
                         <td>
                             <label  >Resolución :</label>
                         </td>
                         <td>
                              <input style="width: 30%"  type="text"  > 
                         </td>
                     </tr>
                      <tr >
                         <td>
                             <label >Monto Total Compra :</label>
                          </td>
                         <td>
                              <input style="width: 30%"  type="text"  > 
                         </td>
                         <td>
                             <label  >Método de Compra :</label>
                         </td>
                         <td>
                              <input style="width: 30%"  type="text"  > 
                         </td>
                     </tr>
                     <tr>
                         <td>
                             <label  >Nombre Responsable :</label>
                         </td>
                         <td>
                               <input style="width: 30%"  type="text"  > 
                         </td>
                         <td>
                             <label  >Plazo Máximo :</label>
                         </td>
                         <td>
                             <input style="width: 30%"  type="text"  > 

                         </td>
                      
                     </tr>
                </table>    

                <table id="t2" >
                           
                                <tr>
                                    <td style="padding-right:  65px;vertical-align: top;">
                                        <label >Alcances:</label>
                                       
                                    </td>
                                    <td style="padding-right: 30px">  
                                        <textarea style="width:40%; display: none;"  rows="7" cols="51"  >asd</textarea>
                                    </td>
                                 
                                    <td style="vertical-align: bottom; text-align: center;" >
                                        _______________________________________________ <br>
                                        <small>Firma y timbre Jefe de Adquisiciones</small>
                                    </td>
                                 
                                </tr>
                               
                </table> --> 
    </div>
 
</div>
</section>




</body>
</html>

 