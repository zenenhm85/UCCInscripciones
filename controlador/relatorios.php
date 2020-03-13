<?php 

session_start();
include_once '../modelo/relatorios.php';

$_POST = json_decode(file_get_contents("php://input"), true);

$opcao = (isset($_POST['opcao'])) ? $_POST['opcao'] : '';
$ano = date('Y');

if($opcao == 1){	

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::QuantInscricoesPorUser($ano); 
	$array = array();
	$i = 0;
	while ($f = mysqli_fetch_array($resultado)) 
	{
		$array[$i] =$f;
		$i++;
	}
	print json_encode($array, JSON_UNESCAPED_UNICODE);
}
else if($opcao == 2){

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::QuantPagamentosInsc($ano); 
	
	
	print json_encode($resultado, JSON_UNESCAPED_UNICODE);
}
else if($opcao == 3){

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::TotalDinheiro($ano); 

	$array = array();
	$array[0] = $resultado;
	
	print json_encode($resultado, JSON_UNESCAPED_UNICODE);
}
else if($opcao == 4){

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::Sexo($ano); 
	
	
	print json_encode($resultado, JSON_UNESCAPED_UNICODE);
}
else if($opcao == 5){

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
else if($opcao == 6){

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
else if($opcao == 7){

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::InscsimPagar($ano); 
	$array = array();
	$i = 0;
	while ($f = mysqli_fetch_array($resultado)) 
	{
		$array[$i] =$f;
		$i++;
	}
	print json_encode($array, JSON_UNESCAPED_UNICODE);
}
else if($opcao == 8){
	$data = (isset($_POST['data'])) ? $_POST['data'] : '';

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::QuantInscricoesPorUserporData($data); 
	$array = array();
	$i = 0;
	while ($f = mysqli_fetch_array($resultado)) 
	{
		$array[$i] =$f;
		$i++;
	}
	print json_encode($array, JSON_UNESCAPED_UNICODE);
}
else if($opcao == 9){

	$data = (isset($_POST['data'])) ? $_POST['data'] : '';
	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::QuantPagamentosInscporData($data); 
	
	
	print json_encode($resultado, JSON_UNESCAPED_UNICODE);
}
else if($opcao == 10){

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
else if($opcao == 11){

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
else if($opcao == 12){

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::Trabalhador($ano); 
	
	
	print json_encode($resultado, JSON_UNESCAPED_UNICODE);
}
else if($opcao == 13){

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::ResultadosI($ano); 
	
	
	print json_encode($resultado, JSON_UNESCAPED_UNICODE);
}
else if($opcao == 14){

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
else if($opcao == 15){

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::ResultadosII($ano); 
	
	
	print json_encode($resultado, JSON_UNESCAPED_UNICODE);;
	
}
else if($opcao == 16){

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
else if($opcao == 17){	

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::QuantInscricoesPorUserII($ano); 
	$array = array();
	$i = 0;
	while ($f = mysqli_fetch_array($resultado)) 
	{
		$array[$i] =$f;
		$i++;
	}
	print json_encode($array, JSON_UNESCAPED_UNICODE);
}
else if($opcao == 18){
	$data = (isset($_POST['data'])) ? $_POST['data'] : '';

	$relatorio1 = new Relatorios();
	$resultado = $relatorio1::QuantInscricoesPorUserporDataII($data); 
	$array = array();
	$i = 0;
	while ($f = mysqli_fetch_array($resultado)) 
	{
		$array[$i] =$f;
		$i++;
	}
	print json_encode($array, JSON_UNESCAPED_UNICODE);
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