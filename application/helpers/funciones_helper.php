<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * calculo costo
 *
 */
if ( ! function_exists('getCosto'))
{
	function getCosto($precio, $iva){
		return round($precio/($iva/100+1),2);

	}
}


/**
 * pid
 *
 */
if ( ! function_exists('pid'))
{
function pid(){
	return date('mydhis');

}
}

/**
 * campoId
 * 
 */
if ( ! function_exists('idCampo'))
{
	function idCampo(){
		$micro_date = microtime();
		$date_array = explode(" ",$micro_date);
		$id_campo = date("mdj", $date_array[1]);
		$id_campo=date('md'.rand(0,9).substr($date_array[1],4));
		return $id_campo;
	}
}

/**
 * getBetween
 * devuelve string entre start y end
 */
if ( ! function_exists('getBetween'))
{
function getBetween($content,$start,$end){
	$r = explode($start, $content);
	if (isset($r[1])){
		$r = explode($end, $r[1]);
		return $r[0];
	}
	return '';
}
}
/**
 * validarEmail()
 * valida el Email
 */
if ( ! function_exists('validarEmail'))
{
	function validarEmail($email)
	{
		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;
	}
	
}
/**
 * retorna los valores de la session
 */

if ( ! function_exists('getSesion'))
{
	function getSesion($val='')
	{
		$CI =& get_instance();
		return $CI->session->userdata($val);
	}

}

////////////////////////////////////////////////////
//Redondea el valor del precio
////////////////////////////////////////////////////
if ( ! function_exists('redondear'))
{
function redondear($valor){
	 
	$precio=round($valor);
	if($precio>40){
		$ultimo=substr ($precio, -1, 1);
		 
		if($ultimo>=0 && $ultimo<5)
			$precio=$precio-$ultimo;
		 
		switch($ultimo){
			case 5;
			$precio=$precio+5;
			break;
			case 6;
			$precio=$precio+4;
			break;
			case 7;
			$precio=$precio+3;
			break;
			case 8;
			$precio=$precio+2;
			break;
			case 9;
			$precio=$precio+1;
			break;
		}
		//return number_format($precio,2,',','.');
		return $precio;
	}
	else{
		//return number_format($precio,2,',','.');		
		return $precio;
	}
}
if ( ! function_exists('calcula_tiempo')){
function calcula_tiempo($start_time, $end_time) {
	$total_seconds = strtotime($end_time) - strtotime($start_time);
	$horas              = floor ( $total_seconds / 3600 );
	$minutes            = ( ( $total_seconds / 60 ) % 60 );
	$seconds            = ( $total_seconds % 60 );
	 
	$time['horas']      = str_pad( $horas, 2, "0", STR_PAD_LEFT );
	$time['minutes']    = str_pad( $minutes, 2, "0", STR_PAD_LEFT );
	$time['seconds']    = str_pad( $seconds, 2, "0", STR_PAD_LEFT );
	 
	$time               = implode( ':', $time );
	 
	return $time;
}
}
if ( ! function_exists('fechaParaMysql')){
function fechaParaMysql($fecha){
	
	//echo $fecha;
	//$f = array();
	//$f=explode("/", $fecha);
	//$time = strtotime($f[1]."/".$f[0]."/".$f[2]);
	//$newformat = date('Y-m-d',$time);
	//return $newformat;
	list($dia,$mes,$ano)= array_pad(explode("/",$fecha), 3, $fecha);
	$fecha="$ano-$mes-$dia";
	return $fecha;
}

}
}

// ------------------------------------------------------------------------


/* End of file funciones_varias.php */
/* Location: ./system/helpers/funciones_varias.php */