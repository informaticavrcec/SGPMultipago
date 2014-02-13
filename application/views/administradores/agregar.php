<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" type="image/x-icon" href="<?=base_url()?>assets/images/favicon.ico" />
<link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>assets/images/favicon.ico" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/general.css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/colorbox.css" />
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.colorbox.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/caja.js"></script>
<title>Untitled Document</title>
</head>

<body id="popup">
<?=($message)?'<div class="alert">'.$message.'<input type="button" id="close" value="Cerrar"></div>':'';?>
<form method="post">
<table width="100%" border="0" cellpadding="3" cellspacing="0" align="center">
<tr>
<td class="titulo" >Agregar usuario SGP</td>
</tr>
</table>
<table width="100%" border="0" cellpadding="3" cellspacing="0" align="center">
<tr>
<td width="125" height="40"><strong>Rut usuario</strong></td>
<td><input type="text" name="rut" class="center" value="<?=set_value('rut')?>" size="11" /> <input type="submit" value="Buscar" /> </td>
</tr>
</table>

<table width="100%" border="0" cellpadding="3" cellspacing="0" align="center" class="tabla_result">
<tr>
<th width="80">Rut</th>
<th>Nombres / Apellidos</th>
<th width="80">Seleccionar</th>
</tr><?
if(count($encontrados) < 1){
	?>
    <tr>
    <td colspan="3">NADA PARA LISTAR</td>    
    </tr><?
}else{
	foreach($encontrados as $value){
		?>
		<tr class="row">
		<td align="center"><?=$value['rut']?></td>
		<td><?=$value['nombres']?> <?=$value['apellidos']?> <span class="red" style="float:right"><?=$error[$value['idt_usrio']]?></span></td>
		<td align="center"><input type="checkbox" value="<?=$value['idt_usrio']?>" name="add[]" /></td>
		</tr><?
	}
}?>
</table>
<table width="100%" border="0" cellpadding="3" cellspacing="0" align="center" >
<tr>
<td></td>
<td width="80" align="center"><input type="submit" value="Agregar" /></td>
</tr>
</table>
</form>
</body>
</html>
