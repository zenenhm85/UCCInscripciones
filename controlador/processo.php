<?php 
session_start();

include_once '../modelo/processo.php';
$_POST = json_decode(file_get_contents("php://input"), true);
$opcao = (isset($_POST['opcao'])) ? $_POST['opcao'] : '';

if($opcao == 1){
	$ano = (isset($_POST['ano'])) ? $_POST['ano'] : '';    
	$processo = new Processo();
  $resultado = $processo::Cadastrar($ano); 
  $array = array();
	$array[0] = $resultado;
	print json_encode($array, JSON_UNESCAPED_UNICODE);
}
elseif ($opcao == 2) {
  $ano = (isset($_POST['ano'])) ? $_POST['ano'] : '';    
  $processo = new Processo();
  $resultado = $processo::Excluir($ano);
  $array = array();
  $array[0] = $resultado;
  print json_encode($array, JSON_UNESCAPED_UNICODE);         
}
else{
	$processo = new Processo();
  $resultado = $processo::todos(); 
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