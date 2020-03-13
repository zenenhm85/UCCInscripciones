<?php 
session_start();

include_once '../modelo/cursomedio.php';
$_POST = json_decode(file_get_contents("php://input"), true);
$opcao = (isset($_POST['opcao'])) ? $_POST['opcao'] : '';

if($opcao == 1){
	$nome = (isset($_POST['nome'])) ? $_POST['nome'] : '';    
	$curso = new Cursomedio();
  $resultado = $curso::Cadastrar($nome); 
  $array = array();
	$array[0] = $resultado;
	print json_encode($array, JSON_UNESCAPED_UNICODE);
}
elseif ($opcao == 2) {
  $nome = (isset($_POST['nome'])) ? $_POST['nome'] : '';  
  $curso = new Cursomedio();
  $resultado = $curso::Excluir($nome);
  $array = array();
  $array[0] = $resultado;
  print json_encode($array, JSON_UNESCAPED_UNICODE);         
}
elseif ($opcao == 3) {
  $nomea = (isset($_POST['nomea'])) ? $_POST['nomea'] : '';  
  $nome = (isset($_POST['nome'])) ? $_POST['nome'] : '';  
   
  $curso = new Cursomedio();
  $resultado = $curso::Alterar($nomea, $nome);
  $array = array();
  $array[0] = $resultado;
  print json_encode($array, JSON_UNESCAPED_UNICODE);         
}
else{
	$curso = new Cursomedio();
  $resultado = $curso::todos(); 
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