<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tz_grupospago extends CI_Model {
	
	function get_grupo($idpostulacionitem){
		
		$sql = "SELECT 
		  dbo.tz_GruposPagos.IDGrupo,
		  dbo.tz_PostulacionItem.IDSeccion,
		  dbo.tz_GruposPagos.IdPostulacionItem
		FROM
		  dbo.tz_GruposPagos
		  INNER JOIN dbo.tz_PostulacionItem ON (dbo.tz_GruposPagos.IdPostulacionItem = dbo.tz_PostulacionItem.IDPostulacionItem)
		WHERE
		  dbo.tz_GruposPagos.IDGrupo IN (SELECT dbo.tz_GruposPagos.IDGrupo FROM dbo.tz_GruposPagos WHERE dbo.tz_GruposPagos.IdPostulacionItem = $idpostulacionitem )";
		$query = $this->db->query($sql);
		return $query->result_array();	
	}
	
	function get_grupo_actividad($idpostulacionitem){
		
		$sql = "SELECT 
		  dbo.tz_GruposPagos.IDGrupo,
		  dbo.tz_PostulacionItem.IDSeccion,
		  dbo.tz_GruposPagos.IdPostulacionItem,
		  dbo.tz_Cursos.Nombre_Curso,
		  dbo.tz_PostulacionItem.ValorNuevo,
		  CASE dbo.tz_Secciones.es_admision
		  WHEN 1 THEN '(Cuota admision)'
		  END AS es_admision
		FROM
		  dbo.tz_GruposPagos
		  INNER JOIN dbo.tz_PostulacionItem ON (dbo.tz_GruposPagos.IdPostulacionItem = dbo.tz_PostulacionItem.IDPostulacionItem)
		  INNER JOIN dbo.tz_Secciones ON (dbo.tz_PostulacionItem.IDSeccion = dbo.tz_Secciones.IDSeccion)
		  INNER JOIN dbo.tz_Cursos ON (dbo.tz_Secciones.IDCurso = dbo.tz_Cursos.IDCurso)
		WHERE
		  dbo.tz_GruposPagos.IDGrupo IN (SELECT dbo.tz_GruposPagos.IDGrupo FROM dbo.tz_GruposPagos WHERE dbo.tz_GruposPagos.IdPostulacionItem = $idpostulacionitem)";
		$query = $this->db->query($sql);
		return $query->result_array();	
	}
	
	function insert_grupo($idpostulacionitem,$id_padre){
		
		if(is_numeric($idpostulacionitem) AND is_numeric($id_padre)){	
		
			$query = $this->db->query("SELECT 
			  dbo.tz_GruposPagos.IDGrupo
			FROM
			  dbo.tz_GruposPagos
			WHERE
			  dbo.tz_GruposPagos.IdPostulacionItem = $id_padre ");
			$resultado = $query->row();
			if(is_numeric($resultado->IDGrupo)){
				$query = $this->db->query("SELECT 
				  dbo.tz_GruposPagos.IDGrupo
				FROM
				  dbo.tz_GruposPagos
				WHERE
				  dbo.tz_GruposPagos.IdPostulacionItem = $idpostulacionitem ");					  
				if(count($query->result_array()) < 1){ 			
					echo "inserta hijo";
					$this->db->query("INSERT INTO
					  dbo.tz_GruposPagos(
					  IdPostulacionItem,
					  IDGrupo)
					VALUES(
					  $idpostulacionitem,
					  ".$resultado->IDGrupo.")");
				}
				
			}else{
				$query = $this->db->query("SELECT TOP 1 
				  dbo.tz_GruposPagos.IDGrupo AS c
				FROM
				  dbo.tz_GruposPagos
				ORDER BY
				  dbo.tz_GruposPagos.IDGrupo DESC");
				$resultado2 = $query->row();
				if(is_numeric($resultado2->c)){
					echo "inserta padre";
					$this->db->query("INSERT INTO
					  dbo.tz_GruposPagos(
					  IdPostulacionItem,
					  IDGrupo)
					VALUES(
					  $id_padre,
					  ".($resultado2->c + 1).")");
				}
			}
		}
		
		return TRUE;
		
	}
	
}