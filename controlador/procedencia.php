<?php 
session_start();

include_once '../modelo/procedencia.php';
$_POST = json_decode(file_get_contents("php://input"), true);
$opcao = (isset($_POST['opcao'])) ? $_POST['opcao'] : '';

if($opcao == 1){
	$nome = (isset($_POST['nome'])) ? $_POST['nome'] : '';    
	$procedencia = new Procedencia();
  $resultado = $procedencia::Cadastrar($nome); 
  $array = array();
	$array[0] = $resultado;
	print json_encode($array, JSON_UNESCAPED_UNICODE);
}
elseif ($opcao == 2) {
  $nome = (isset($_POST['nome'])) ? $_POST['nome'] : '';  
  $procedencia = new Procedencia();
  $resultado = $procedencia::Excluir($nome);
  $array = array();
  $array[0] = $resultado;
  print json_encode($array, JSON_UNESCAPED_UNICODE);         
}
elseif ($opcao == 3) {
  $nomea = (isset($_POST['nomea'])) ? $_POST['nomea'] : '';  
  $nome = (isset($_POST['nome'])) ? $_POST['nome'] : '';  
   
  $procedencia = new Procedencia();
  $resultado = $procedencia::Alterar($nomea, $nome);
  $array = array();
  $array[0] = $resultado;
  print json_encode($array, JSON_UNESCAPED_UNICODE);         
}
else{
	$procedencia = new Procedencia();
  $resultado = $procedencia::todos(); 
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