<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tz_empresasregistradas extends CI_Model {
	
	function get_empresas(){		
		//$this->db->cache_on();
		$query = $this->db->query("SELECT 
		  z.IDEmpRegistrada,
		  z.Nombre,
		  z.Descripcion,
		  z.RSocial,
		  z.RUT
		FROM
		  dbo.tz_EmpresaRegistrada z
		WHERE 
		  z.RSocial <> ''
		ORDER BY
		  z.RSocial");
		//$this->db->cache_off();			
		return $query->result_array();
		 	
	}
	
}