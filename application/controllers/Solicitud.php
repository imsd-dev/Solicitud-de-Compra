<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitud extends CI_Controller{

	function __construct(){ 

		parent:: __construct();
		$this->load->helper('form');
	    $this->load->helper('url');
	    $this->load->helper('html');
	    $this->load->database();
	    $this->load->library('form_validation');
		$this->load->library('encryption');	
		$this->load->model('login_model');	
		$this->load->model('Solicitudes');	
		$this->load->driver('session');
		
		 $this->load->library('Pdf');   

		$id= $this->session->mark_as_flash('item');
		$nivel= $this->session->userdata('nivel'); 
		$key['llave'] =bin2hex ($this->encryption->create_key(26));
	}
 
	public function insertarUsuario(){ 
		$cla = "qwe";
        $contra  =  md5($cla) ; 
       
        $passw= md5($cla);
		$data = array(
		'id'       => "9",
		'username' => "yo",
		'password' => $contra		
		);
		
		$this->login_model->form_insert($data);
	}

	public function index()
     {
          //get the posted values
        $username = $this->input->post("txt_username");
        $password= $this->input->post("txt_password"); 

        //$password = md5($passw);

        //set validations
        $this->form_validation->set_rules("txt_username", "Username", "trim|required");
        $this->form_validation->set_rules("txt_password", "Password", "trim|required");

        if ($this->form_validation->run() == FALSE)
        {
             //validation fails
             $this->load->view('layout/header');
             $this->load->view('blog/login_view');
        }
        else
        {
             
            if ($this->input->post('btn_login') == "Iniciar Sesion"){

                    
                $usr_result = $this->login_model->get_user($username, $password);
                $resu_id = $this->login_model->get_di($username, $password); 

                $id = $resu_id['id'];
                $sistema= 'SolicitudCompra';
                $permiso= $this->login_model->get_nivel($id,$sistema);

	             
	            if ($usr_result){
		          	if ($permiso){		                 
		                $sessiondata = array(
		                     'username' => $username,
		                     'loginuser' => TRUE,
		                     'id_usuario'=> $id
		                );
		                $this->session->set_userdata('nivel',$permiso['nivel_acceso']);
		                $this->session->set_userdata('username',$sessiondata['username']);
		                $this->session->set_userdata('id_usuario',$sessiondata['id_usuario']);	
 						if ($permiso['nivel_acceso']== 4 ) {
 							redirect(base_url('index.php/solicitud/admin') );
 						}else{
		                	redirect(base_url('index.php/solicitud/missolicitudes') );
 						}
		            }else{
			               $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Usted no  tiene permisos para ingresar a este sistema</div>');
			               
			                 redirect($this->uri->uri_string());
	             	  }
	             
		        }else{
		            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Nombre de usuario o contraseña invalidos</div>');
		            redirect($this->uri->uri_string());		                   
		        }                   
            }else{  
            	echo "<script>alert('Falló el ingreso');</script>";
                redirect(base_url() );
            }
        }
    }    

    public function logout(){
      $this->session->sess_destroy();
      redirect(base_url('index.php/solicitud/index') );
    }

	function ingresarsolicitud(){
		$data['productos'] = null;
		$variable = $this->session->userdata('username');
		$id = $this->session->userdata('id_usuario'); 
		$data['user'] = $this->login_model->datos_user($id);
		if (is_null($variable)) {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Debe inciar Sesion antes</div>');
			redirect(base_url('index.php/solicitud/index') );
		}else{
			$this->load->view('blog/index',$data);
		}

	}

	function missolicitudes(){
		$variable = $this->session->userdata('username');
		$id = $this->session->userdata('id_usuario'); 
		$resu = $this->login_model->datos_user($id);		  
		$data['user'] = $resu;			
		$data['blogs'] = $this->Solicitudes->usergetall($resu->nombre.' '.$resu->apellido);
		if (is_null($variable)) {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Debe inciar Sesion antes</div>');
			redirect(base_url('index.php/solicitud/index') );
		}else{
			$this->load->view('blog/user',$data);
		}
	}

	function modificar($solicitud){
		$variable = $this->session->userdata('username');
		$id = $this->session->userdata('id_usuario'); 
		$data['user'] = $this->login_model->datos_user($id);

		$data ['solicitud'] = $this->Solicitudes->getpdfS($solicitud);
		$data ['producto'] = $this->Solicitudes->getpdfP($solicitud);	    
		if (is_null($variable)) {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Debe inciar Sesion antes</div>');
			redirect(base_url('index.php/solicitud/index') );
		}else{
			$this->load->view('blog/modificar',$data);
		}
	}


	function admin (){
		$variable = $this->session->userdata('username');
		$nivel= $this->session->userdata('nivel');		 
		$id = $this->session->userdata('id_usuario'); 
		$data['user'] = $this->login_model->datos_user($id);		  
		 
		
		if (is_null($variable)||$nivel!=4 ) {			

			$this->session->set_flashdata('error_msg', 'Usted no tiene permiso, buen intento.');

			redirect(base_url('index.php/solicitud/ingresarsolicitud') );

		}else{
			
			$data['blog'] = null;
			$data['blogp'] = null;
			$data['blogs'] = $this->Solicitudes->getall();
			$data['respon']= $this->login_model->getrespon();
			$this->load->view('blog/admin',$data);
		}
	}

	//Agregar Solicitud
	public function submit(){
		
		$this->load->library('form_validation');

		//Recibimos lo datos de productos por metodo Post los llenamos en variables
			$array_producto = $_POST['nombreP'];
			$array_unidad_medida = $_POST['unidadP'];
			$array_cantidad = $_POST['cantidadP'];
			$array_convenio= $_POST['convenioP'];

			//Obtenemos cada clave y su valor para poder contar la cantidad de datos e ingresarlos acorde a cada clave
		    foreach ($array_producto as $clave=>$nombreP) {
				$unidadP = $array_unidad_medida[$clave];
				$cantidadP = $array_cantidad[$clave];
				$idconvenio = $array_convenio[$clave];
				$misProductos[]  = array(
		                'detalle'=>$nombreP,
						'unidad'=>$unidadP,
						'cantidad'=>$cantidadP,
						'id_convenio   '=>$idconvenio
		        );
			}


		//$this->form_validation->set_rules("unidadP[]" 	  	  , "UnidadP"		      , "required");		
		//$this->form_validation->set_rules("cantidadP[]" 	      , "Cantidad"		      , "required");
		//$this->form_validation->set_rules("nombreP[]" 		  , "Detalle"			  , "required");

		$this->form_validation->set_rules("txt_destinocompra" , "Destino de la compra", "required");
		$this->form_validation->set_rules("txt_destinocompra" , "Destino de la compra", "required");
		$this->form_validation->set_rules("txt_fecharecepcion", "Fecha esperada"      , "required");
		$this->form_validation->set_rules("txt_lugarrecepcion", "Lugar de recepción " , "required");
		$this->form_validation->set_rules("txt_cotizaciones"  , "Cotizaciones"		  , "required");
		$this->form_validation->set_rules("txt_imagenes"      , "Imagenes"			  , "required");
		$this->form_validation->set_rules("txt_monto"         , "Costo total " 		  , "required");
		
		$this->form_validation->set_rules("txt_comentarios"   , "Comentarios"		  , "required");

		if ($this->form_validation->run() == FALSE)
        {
            //validation fails
            $data['productos'] = $misProductos;
			$variable = $this->session->userdata('username');
			$id = $this->session->userdata('id_usuario'); 
			$data['user'] = $this->login_model->datos_user($id);
			$this->load->view('blog/index',$data);
        }
        else
        {
        	$result = $this->Solicitudes->submit();
			
			
			if (!is_null($result->id_solicitud)) {
				$resu = $this->Solicitudes->submitP($result->id_solicitud);
				$data['id']= $result;
			
				if($resu){ 
					$this->session->set_flashdata('success_msg', 'Solicitud de compra ingresada');
					$this->load->view('blog/ingresada',$data);
				}else{
					$this->session->set_flashdata('error_msg', $result);
					$this->session->set_flashdata('divAgregar', ' ');				
					redirect(base_url('index.php/solicitud/ingresarsolicitud') );
				}
			}else{
				$this->session->set_flashdata('error_msg', 'la Solicitud de compra no se ha podido ingresar debido a que no hay datos');
					$this->session->set_flashdata('divAgregar', ' ');				
					redirect(base_url('index.php/solicitud/ingresarsolicitud') );
			}
		}
			
	}
	//Guardar Borrador
	public function guardarborrador(){
		
		$result = $this->Solicitudes->guardarborrador();
		if (!is_null($result->id_solicitud)) {
			$resu = $this->Solicitudes->submitP($result->id_solicitud);
			$data['id']= $result;
			if($resu){
				$this->session->set_flashdata('success_msg', 'Borrador guardada');
			}else{
				$this->session->set_flashdata('error_msg', 'Fallo el guardado');
			}
			redirect(base_url('index.php/solicitud/missolicitudes'));
		}else{
				$this->session->set_flashdata('error_msg', 'la Solicitud de compra no se ha podido guardar debido a que no hay datos');
					$this->session->set_flashdata('divAgregar', ' ');				
					redirect(base_url('index.php/solicitud/ingresarsolicitud') );
			}
	}

	//Actualizar Borrador actualizarborrador
	public function actualizarborrador(){
		$result = $this->Solicitudes->actualizarborrador();
		$delete =  $this->Solicitudes->eliminarproductos($result);
		$resu = $this->Solicitudes->submitP($result);

		if($delete){
			$this->session->set_flashdata('success_msg', 'Borrador guardado correctamente');
		}else{
			$this->session->set_flashdata('error_msg', 'Fallo la modificacion');
		}
		redirect(base_url('index.php/solicitud/missolicitudes'));
	}
	//Enviar Borrador  
	public function enviarborrador(){
		
		$result = $this->Solicitudes->enviarborrador();	
		$delete =  $this->Solicitudes->eliminarproductos($result->id_solicitud);
		$resu = $this->Solicitudes->submitP($result->id_solicitud);
		$data['id']= $result;
			if($resu){ 
				$this->session->set_flashdata('success_msg', 'Solicitud de compra enviada');
				$this->load->view('blog/ingresada',$data);
			}else{
				$this->session->set_flashdata('error_msg', $result);
				$this->session->set_flashdata('divAgregar', ' ');				
				redirect(base_url('index.php/solicitud/missolicitudes'));
			}
	}

	//Descar Solicitud
	public function descartarborrador(){
		$nivel= $this->session->userdata('nivel'); 
		$variable = $this->session->userdata('username');

		if (is_null($variable)) {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Debe inciar Sesion antes</div>');
			redirect(base_url('index.php/solicitud/index') );
		}else{
			$result = $this->Solicitudes->descartarborrador();
			if($result){
				$this->session->set_flashdata('success_msg', 'Solicitud de compra descartada');
			}else{
				$this->session->set_flashdata('error_msg', 'Solicitud de compra no descartada');
			}
			redirect(base_url('index.php/solicitud/missolicitudes'));
		}
	}
	// Llamar vista para editar
	public function edite($id){
		$variable = $this->session->userdata('username');
		$usuario = $this->session->userdata('id_usuario'); 
		
		if (is_null($variable)) {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Debe iniciar sesión</div>');
			redirect(base_url('index.php/solicitud/admin') );
		}else{
			$data['user'] = $this->login_model->datos_user($usuario);
			$data['blog'] = null;
			$data['blogp'] = $this->Solicitudes->getId($id);
			$data['blogs'] = $this->Solicitudes->getall();
			$data['respon']= $this->login_model->getrespon();

			$this->session->set_flashdata('modificar', 'Modificar');
		   	$this->load->view('blog/admin',$data);
		}
	}
	//Actualizar solicitud
	public function update(){
		$result = $this->Solicitudes->update();
		if($result){
			$this->session->set_flashdata('success_msg', 'Modificado Correctamente');
		}else{
			$this->session->set_flashdata('error_msg', 'Fallo la modificacion');
		}
		redirect(base_url('index.php/solicitud/admin'));
	}
	
	
   public function mpdf($id){
		$datos = $this->Solicitudes->getpdfS($id);
		$data ['blog'] = $this->Solicitudes->getpdfS($id);
		$data ['blogs'] = $this->Solicitudes->getpdfP($id);	    
	    $html = $this->load->view('blog/mypdf',$data,true);
	 	
	    $pdfFilePath = "Solicitud de Compra N°".$datos->id_solicitud.".pdf";
	   

	    $this->load->library('M_pdf');
        $mpdf = new mPDF('c', 'A4 '); 
 		$mpdf->WriteHTML($html);
		$mpdf->Output($pdfFilePath, "I");
			       
	}

 }