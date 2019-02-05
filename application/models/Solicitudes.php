<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitudes extends CI_model{

	//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@********** Solicitudes **********@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
	public function getall(){	

			$this->db->select('*' );
            $this->db->where('estado !=', 'Borrador');
            $this->db->where('estado !=', 'Descartado');
			$this->db->order_by('id_solicitud','desc');		
			$query = $this->db->get('solicitudes_compra');

			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
	}
	public function usergetall($nombre){	

			$this->db->select('*' );
			$this->db->where('nombresolicitante', $nombre);
			$this->db->where('estado !=', 'Descartado');
			$this->db->order_by('id_solicitud','desc');		
			$query = $this->db->get('solicitudes_compra');

			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
	}



	//Agregar Solicitud 
	public function submit(){	
			try{
				//Convierte fechas en una compatible con mysql 
				$fecharecepcion= $this->input->post('txt_fecharecepcion');
				$Fecha1 = implode( '-', array_reverse( explode( '-', $fecharecepcion ) ) ) ;

				$fechacontrato= $this->input->post('txt_fechacontrato');
				$Fecha2 = implode( '-', array_reverse( explode( '-', $fechacontrato ) ) ) ;
				$estado ="Emitida";
				//$id= 1; 
				$hoy = date('y-m-d');
				$field = array(
					//'id_solicitud'=>$id,
					'fechasolicitud' =>$hoy,
					'destinocompra'=>$this->input->post('txt_destinocompra'),
					'lugarrecepcion'=>$this->input->post('txt_lugarrecepcion'),
					'cotizaciones'=>$this->input->post('txt_cotizaciones'),
					'imagenes'=>$this->input->post('txt_imagenes'),
					'fecharecepcion'=>$fecharecepcion,
					'fechacontrato'=>$fechacontrato,
					'horarecepcion'=>$this->input->post('txt_horarecepcion'),	
					'costototal'=>$this->input->post('txt_monto'),
					'comentarios'=>$this->input->post('txt_comentarios'),
					'direccionsolicitante'=>$this->input->post('txt_direccionsolicitante'),
					'nombresolicitante'=>$this->input->post('txt_nombresolicitante'),
					'telefonocontacto'=>$this->input->post('txt_telefono'),
					'departamento'=>$this->input->post('txt_departamentosolicitante'),
					'cargosolicitante'=>$this->input->post('txt_cargosolicitante'),
					'estado'=>$estado
				);

				$this->db->insert('solicitudes_compra', $field);

				if($this->db->affected_rows() > 0){
					//Si agrega la solicitud obtiene el id de esta y lo retorna para agregar los productos
					
					$this->db->select('id_solicitud');
					$this->db->order_by('id_solicitud','DESC' );
					$this->db->limit('1');
					$query = $this->db->get('solicitudes_compra');
					if($query->num_rows() > 0){

						return $query->row();
					}else{
						return false;
					}

				}else{
					$db_error = $this->db->error();
			        if (!empty($db_error)) {
			            throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
			            return false; // unreachable retrun statement !!!
			        }
			    }
			}catch (Exception $e) {
				return $e;
			}	 
	}
	//Guardar Borrador
	public function guardarborrador(){	
			try{
				//Convierte fechas en una compatible con mysql 
				$fecharecepcion= $this->input->post('txt_fecharecepcion');
				$Fecha1 = implode( '-', array_reverse( explode( '-', $fecharecepcion ) ) ) ;

				$fechacontrato= $this->input->post('txt_fechacontrato');
				$Fecha2 = implode( '-', array_reverse( explode( '-', $fechacontrato ) ) ) ;
				$estado ="Borrador";
				//$id= 1; 
				$hoy = date('y-m-d');
				$field = array(
					//'id_solicitud'=>$id,
					//'fechasolicitud' =>$hoy,
					'destinocompra'=>$this->input->post('txt_destinocompra'),
					'lugarrecepcion'=>$this->input->post('txt_lugarrecepcion'),
					'cotizaciones'=>$this->input->post('txt_cotizaciones'),
					'imagenes'=>$this->input->post('txt_imagenes'),
					'fecharecepcion'=>$fecharecepcion,
					'fechacontrato'=>$fechacontrato,
					'horarecepcion'=>$this->input->post('txt_horarecepcion'),	
					'costototal'=>$this->input->post('txt_monto'),
					'comentarios'=>$this->input->post('txt_comentarios'),
					'direccionsolicitante'=>$this->input->post('txt_direccionsolicitante'),
					'nombresolicitante'=>$this->input->post('txt_nombresolicitante'),
					'telefonocontacto'=>$this->input->post('txt_telefono'),
					'departamento'=>$this->input->post('txt_departamentosolicitante'),
					'cargosolicitante'=>$this->input->post('txt_cargosolicitante'),
					'estado'=>$estado
				);

				$this->db->insert('solicitudes_compra', $field);

				if($this->db->affected_rows() > 0){
					//Si agrega la solicitud obtiene el id de esta y lo retorna para agregar los productos
					
					$this->db->select('id_solicitud');
					$this->db->order_by('id_solicitud','DESC' );
					$this->db->limit('1');
					$query = $this->db->get('solicitudes_compra');
					if($query->num_rows() > 0){

						return $query->row();
					}else{
						return false;
					}

				}else{
					$db_error = $this->db->error();
			        if (!empty($db_error)) {
			            throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
			            return false; // unreachable retrun statement !!!
			        }
			    }
			}catch (Exception $e) {
				return $e;
			}	 
	}

	//Editar Borrador
	public function actualizarborrador(){	
		$id = $this->input->post('txtid');
		$fecharecepcion= $this->input->post('txt_fecharecepcion');
		$Fecha1 = implode( '-', array_reverse( explode( '-', $fecharecepcion ) ) ) ;

		$fechacontrato= $this->input->post('txt_fechacontrato');
		$Fecha2 = implode( '-', array_reverse( explode( '-', $fechacontrato ) ) ) ;
		$estado ="Emitida";

		$field = array(	
		'destinocompra ' =>$this->input->post('txt_destinocompra'),
		'lugarrecepcion'=>$this->input->post('txt_lugarrecepcion'),
		'cotizaciones    '=>$this->input->post('txt_cotizaciones'),
		'imagenes     '=>$this->input->post('txt_imagenes'),
		'fecharecepcion     '=>$this->input->post('txt_fecharecepcion'),
		'fechacontrato     '=>$this->input->post('txt_fechacontrato'),
		'horarecepcion     '=>$this->input->post('txt_horarecepcion'),
		'costototal     '=>$this->input->post('txt_monto'),
		'comentarios     '=>$this->input->post('txt_comentarios') 
		);
		$this->db->where('id_solicitud', $id);
		$this->db->update('solicitudes_compra', $field);
		if($this->db->affected_rows() > 0){
			return $id;
		}else{
			return false;
		}
	}
	public function descartarborrador(){	
		$id = $this->input->post('txtid');
		$fecharecepcion= $this->input->post('txt_fecharecepcion');
		$Fecha1 = implode( '-', array_reverse( explode( '-', $fecharecepcion ) ) ) ;

		$fechacontrato= $this->input->post('txt_fechacontrato');
		$Fecha2 = implode( '-', array_reverse( explode( '-', $fechacontrato ) ) ) ;
		$estado ="Descartado";

		$field = array(	
		'destinocompra ' =>$this->input->post('txt_destinocompra'),
		'lugarrecepcion'=>$this->input->post('txt_lugarrecepcion'),
		'cotizaciones    '=>$this->input->post('txt_cotizaciones'),
		'imagenes     '=>$this->input->post('txt_imagenes'),
		'fecharecepcion     '=>$this->input->post('txt_fecharecepcion'),
		'fechacontrato     '=>$this->input->post('txt_fechacontrato'),
		'horarecepcion     '=>$this->input->post('txt_horarecepcion'),
		'costototal     '=>$this->input->post('txt_monto'),
		'comentarios     '=>$this->input->post('txt_comentarios'),
		'estado'=>$estado

		);
		$this->db->where('id_solicitud', $id);
		$this->db->update('solicitudes_compra', $field);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	//Eliminar productos 
	public function eliminarproductos($id){
		$this->db->where('solicitud', $id);
		$this->db->delete('solicitudes_productos');
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	//Editar productos
	public function actualizarproductos(){	

			$id = $this->input->post('txtid');
			$array_id = $_POST['idP'];
			$array_producto = $_POST['nombreP'];
			$array_unidad_medida = $_POST['unidadP'];
			$array_cantidad = $_POST['cantidadP'];
			$array_convenio= $_POST['convenioP'];
			$misProductos = array();
			//Obtenemos cada clave y su valor para poder contar la cantidad de datos e ingresarlos acorde a cada clave
		    foreach ($array_id as $clave=>$idproducto) {
		    	$nombreP = $array_producto[$clave];		    	 
				$unidadP = $array_unidad_medida[$clave];
				$cantidadP = $array_cantidad[$clave];
				$idconvenio = $array_convenio[$clave];
				$misProductos[] = array(
						'id 		   '=>$idproducto,
		                'producto      '=>$nombreP,
						'unidad_medida '=>$unidadP,
						'cantidad      '=>$cantidadP,
						'id_convenio   '=>$idconvenio,
						'solicitud 	   '=>$id   
		        );
			}
		$this->db->update_batch('solicitudes_productos', $misProductos, 'id'); 
		 
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	//Enviar Borrador 
	public function enviarborrador(){	
		$id = $this->input->post('txtid');
		$estado ="Emitida";
		$hoy = date('y-m-d');

		$field = array(	
		'fechasolicitud' =>$hoy,
		'estado'=>$estado, 
		'destinocompra ' =>$this->input->post('txt_destinocompra'),
		'lugarrecepcion'=>$this->input->post('txt_lugarrecepcion'),
		'cotizaciones    '=>$this->input->post('txt_cotizaciones'),
		'imagenes     '=>$this->input->post('txt_imagenes'),
		'fecharecepcion     '=>$this->input->post('txt_fecharecepcion'),
		'fechacontrato     '=>$this->input->post('txt_fechacontrato'),
		'horarecepcion     '=>$this->input->post('txt_horarecepcion'),
		'costototal     '=>$this->input->post('txt_monto'),
		'comentarios     '=>$this->input->post('txt_comentarios') 
		);
		$this->db->where('id_solicitud', $id);
		$this->db->update('solicitudes_compra', $field);

		if($this->db->affected_rows() > 0){
			$this->db->select('id_solicitud');
			$this->db->where('id_solicitud', $id);
			$query = $this->db->get('solicitudes_compra');
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	//Eliminar Solicitud
	public function delete($id){
		$this->db->where('id', $id);
		$this->db->delete('puntos');
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}	

	// Obtener datos para editar
	public function getId($id){	

		$this->db->where('id_solicitud', $id);
		$query = $this->db->get('solicitudes_compra'); 
		if($query->num_rows() > 0){
			return $query->row();
			 
		}else{
			return false;
		}
	}

	//Obtener datos de solicitud para pdf
	public function getpdfS($id){	
		
		$this->db->where('id_solicitud', $id);
		$query = $this->db->get('solicitudes_compra'); 
		if($query->num_rows() > 0){
			return $query->row();
			 
		}else{
			return false;
		}
	}

	//Obtener datos de productos para pdf
	public function getpdfP($id){	
		
		$this->db->where('solicitud', $id);
		$query = $this->db->get('solicitudes_productos'); 
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@********** Productos ************@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

	//Agregar Solicitud
	public function submitP($id){
		try{
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
		                'producto      '=>$nombreP,
						'unidad_medida '=>$unidadP,
						'cantidad      '=>$cantidadP,
						'id_convenio   '=>$idconvenio,
						'solicitud 	   '=>$id   
		        );
			}

			$this->db->insert_batch('solicitudes_productos', $misProductos);
			
			if($this->db->affected_rows() > 0){
				return true;
			}else{
				$db_error = $this->db->error();
				if (!empty($db_error)) {
				    throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
				    return false; // unreachable retrun statement !!!
				}
			}	    
		}catch (Exception $e){
			return $e;
		}
	}

	//Editar Solicitud
	public function update(){	
		$id = $this->input->post('txtid');
		
		$field = array(
		'ordendecompra     '=>$this->input->post('txt_orden'), 
		'numeropedido ' =>$this->input->post('txt_numeropedido'),
		'responsable'=>$this->input->post('txt_responsable'),
		'estado    '=>$this->input->post('txt_estado')
		);
		$this->db->where('id_solicitud', $id);
		$this->db->update('solicitudes_compra', $field);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}


}
