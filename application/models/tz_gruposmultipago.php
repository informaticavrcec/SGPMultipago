<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tz_grupos_multipago extends CI_Model {
	
	public function update_grupos_multipago($id_postulacionitems,$id_usuario){
		
		$arreglo = $id_postulacionitems;
		$id_postulacionitems = implode(',',$id_postulacionitems);				
				
		$query = $this->db->query("SELECT 
		  dbo.tz_grupos_multipago.ids_postulacionitems,
		  dbo.tz_grupos_multipago.creado
		FROM
		  dbo.tz_grupos_multipago
		WHERE
		  dbo.tz_grupos_multipago.ids_postulacionitems = '$id_postulacionitems' ");
		if(count($query->result_array()) > 0){
			//$this->db->query("");
		}else{
			foreach($arreglo as $value){
				
				$this->db->query("INSERT INTO
				  dbo.tz_grupos_multipago(
				  ids_postulacionitems,
				  creado,
				  id_postulacionitem,
				  creador)
				VALUES(
				  ".$this->db->escape($id_postulacionitems).",
				  GETDATE(),
				  $value,
				  $id_usuario)");
			}
		}
		return TRUE;
		
	}
	
	
	
		
	
	
}

?>