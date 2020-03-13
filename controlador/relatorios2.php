<?php 

session_start();
include_once '../modelo/relatorios.php';

$_POST = json_decode(file_get_contents("php://input"), true);

$opcao = (isset($_POST['opcao'])) ? $_POST['opcao'] : '';
$ano = (isset($_POST['ano'])) ? $_POST['ano'] : '';

if($opcao == 1){	

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::inscricaoporCursos($ano); 
	$resultado2 = $relatorio1::inscricaoporCursos($ano); 
	
	$array = array();
	$i = 0;
	$suma = 0;

	while ($f = mysqli_fetch_array($resultado2)) 
	{
				
		$suma+=$f['quant'];
	}
	
	while ($f2 = mysqli_fetch_array($resultado)) 
	{
				
		$array[$i] =array('curso' =>$f2['curso'],'perido'=>$f2['perido'],'quant'=>$f2['quant'],'porcento'=>(round($f2['quant']*100/$suma, 2)));
		$i++;
	}
	
	print json_encode($array, JSON_UNESCAPED_UNICODE);
}
else if($opcao == 2){

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::SexoPorCursos($ano); 
	
	print json_encode($resultado, JSON_UNESCAPED_UNICODE);	
}
else if($opcao == 3){

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::AprovadosPorCursos($ano); 
	
	print json_encode($resultado, JSON_UNESCAPED_UNICODE);	
}
else if($opcao == 4){

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::ResultadosporCursoAVG($ano); 
	
	$array = array();
	$i = 0;
	while ($f = mysqli_fetch_array($resultado)) 
	{
		$array[$i] =$f;
		$i++;
	}
	print json_encode($array, JSON_UNESCAPED_UNICODE);	
}
else if($opcao == 5){

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::ResultadosporCursoAVGII($ano); 
	
	$array = array();
	$i = 0;
	while ($f = mysqli_fetch_array($resultado)) 
	{
		$array[$i] =$f;
		$i++;
	}
	print json_encode($array, JSON_UNESCAPED_UNICODE);	
}
else if($opcao == 6){

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::AprovadosPorCursosII($ano); 
	
	print json_encode($resultado, JSON_UNESCAPED_UNICODE);	
}
else if($opcao == 7){	

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::inscricaoporCursosII($ano); 
	$resultado2 = $relatorio1::inscricaoporCursosII($ano); 
	
	$array = array();
	$i = 0;
	$suma = 0;

	while ($f = mysqli_fetch_array($resultado2)) 
	{
				
		$suma+=$f['quant'];
	}
	
	while ($f2 = mysqli_fetch_array($resultado)) 
	{
				
		$array[$i] =array('curso' =>$f2['curso'],'perido'=>$f2['perido'],'quant'=>$f2['quant'],'porcento'=>(round($f2['quant']*100/$suma, 2)));
		$i++;
	}
	
	print json_encode($array, JSON_UNESCAPED_UNICODE);
}
else if($opcao == 8){

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::QuantCentroProcedencia($ano); 
	$resultado2 = $relatorio1::QuantCentroProcedencia($ano); 
	
	$array = array();
	$i = 0;
	$suma = 0;

	while ($f = mysqli_fetch_array($resultado2)) 
	{
				
		$suma+=$f['quant'];
	}
	
	while ($f2 = mysqli_fetch_array($resultado)) 
	{
				
		$array[$i] =array('procedencia' =>$f2['procedencia'],'quant'=>$f2['quant'],'porcento'=>(round($f2['quant']*100/$suma, 2)));
		$i++;
	}
	
	print json_encode($array, JSON_UNESCAPED_UNICODE);
}
else if($opcao == 9){

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::ResultadosCentroProcedenciaAVG($ano); 
	
	$array = array();
	$i = 0;
	while ($f = mysqli_fetch_array($resultado)) 
	{
		$array[$i] =$f;
		$i++;
	}
	print json_encode($array, JSON_UNESCAPED_UNICODE);
	
}
else if($opcao == 10){

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::ResultadosCentroProcedenciaAVGII($ano); 
	
	$array = array();
	$i = 0;
	while ($f = mysqli_fetch_array($resultado)) 
	{
		$array[$i] =$f;
		$i++;
	}
	print json_encode($array, JSON_UNESCAPED_UNICODE);
	
}
else if($opcao == 11){

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::ResultadosProcedenciaI($ano); 
	
	
	print json_encode($resultado, JSON_UNESCAPED_UNICODE);
}
else if($opcao == 12){

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::ResultadosProcedenciaII($ano); 
	
	
	print json_encode($resultado, JSON_UNESCAPED_UNICODE);
	
}
else if($opcao == 13){

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::QuantEnsinoMedio($ano); 
	$resultado2 = $relatorio1::QuantEnsinoMedio($ano); 
	
	$array = array();
	$i = 0;
	$suma = 0;

	while ($f = mysqli_fetch_array($resultado2)) 
	{
				
		$suma+=$f['quant'];
	}
	
	while ($f2 = mysqli_fetch_array($resultado)) 
	{
				
		$array[$i] =array('cursomedio' =>$f2['cursomedio'],'quant'=>$f2['quant'],'porcento'=>(round($f2['quant']*100/$suma, 2)));
		$i++;
	}
	
	print json_encode($array, JSON_UNESCAPED_UNICODE);
}
else if($opcao == 14){

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::ResultadosporCursosdeProcedenciaAVG($ano); 
	
	$array = array();
	$i = 0;
	while ($f = mysqli_fetch_array($resultado)) 
	{
		$array[$i] =$f;
		$i++;
	}
	print json_encode($array, JSON_UNESCAPED_UNICODE);
	
}
else if($opcao == 15){

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::ResultadosporCursosdeProcedenciaAVGII($ano); 
	
	$array = array();
	$i = 0;
	while ($f = mysqli_fetch_array($resultado)) 
	{
		$array[$i] =$f;
		$i++;
	}
	print json_encode($array, JSON_UNESCAPED_UNICODE);
	
}
else if($opcao == 16){

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::ResultadosProcedenciaCursoI($ano); 
	print json_encode($resultado, JSON_UNESCAPED_UNICODE);
}
else if($opcao == 17){

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::ResultadosProcedenciaCursoII($ano); 
	print json_encode($resultado, JSON_UNESCAPED_UNICODE);
}
else if($opcao == 18){

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::inscricaoporProvincias($ano); 
	$resultado2 = $relatorio1::inscricaoporProvincias($ano); 
	$array = array();
	$i = 0;
	$suma = 0;
	while ($f = mysqli_fetch_array($resultado)) 
	{
		$suma+=$f['quant'];		
	}
	while ($f2 = mysqli_fetch_array($resultado2)) 
	{
				
		$array[$i] =array('provincia' =>$f2['provincia'],'porcento'=>(round($f2['quant']*100/$suma, 2)),'quant'=>$f2['quant']);
		$i++;
	}
	
	print json_encode($array, JSON_UNESCAPED_UNICODE);
}
else if($opcao == 19){

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::ResultadosProvinciasAVG($ano); 
	
	$array = array();
	$i = 0;
	while ($f = mysqli_fetch_array($resultado)) 
	{
		$array[$i] =$f;
		$i++;
	}
	print json_encode($array, JSON_UNESCAPED_UNICODE);
	
}
else if($opcao == 20){

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::ResultadosProvinciasAVGII($ano); 
	
	$array = array();
	$i = 0;
	while ($f = mysqli_fetch_array($resultado)) 
	{
		$array[$i] =$f;
		$i++;
	}
	print json_encode($array, JSON_UNESCAPED_UNICODE);
	
}
else if($opcao == 21){

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::ResultadosProcedenciaProvinciaI($ano); 
	print json_encode($resultado, JSON_UNESCAPED_UNICODE);
}
else if($opcao == 22){

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::ResultadosProcedenciaProvinciaII($ano); 
	print json_encode($resultado, JSON_UNESCAPED_UNICODE);
}
else{	
	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::QuantPagamentosPorUser($ano); 
	$array = array();
	$i = 0;
	while ($f = mysqli_fetch_array($resultado)) 
	{
		$array[$i] =$f;
		$i++;
	}
	print json_encode($array, JSON_UNESCAPED_UNICODE);
}

?>