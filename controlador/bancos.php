<?php 
session_start();

include_once '../modelo/bancos.php';
$_POST = json_decode(file_get_contents("php://input"), true);
$opcao = (isset($_POST['opcao'])) ? $_POST['opcao'] : '';

if($opcao == 1){
	$nome = (isset($_POST['nome'])) ? $_POST['nome'] : '';
    $descricao = (isset($_POST['descricao'])) ? $_POST['descricao'] : '';
	$banco = new Banco();
    $resultado = $banco::Cadastrar($nome,$descricao); 
    $array = array();
	$array[0] = $resultado;
	print json_encode($array, JSON_UNESCAPED_UNICODE);
}
elseif ($opcao == 2) {
  $nome = (isset($_POST['nome'])) ? $_POST['nome'] : '';  
  $banco = new Banco();
  $resultado = $banco::Excluir($nome);
  $array = array();
  $array[0] = $resultado;
  print json_encode($array, JSON_UNESCAPED_UNICODE);         
}
elseif ($opcao == 3) {
  $nomea = (isset($_POST['nomea'])) ? $_POST['nomea'] : '';  
  $nome = (isset($_POST['nome'])) ? $_POST['nome'] : '';  
  $descricao = (isset($_POST['descricao'])) ? $_POST['descricao'] : '';  
  $banco = new Banco();
  $resultado = $banco::Alterar($nomea, $nome, $descricao);
  $array = array();
  $array[0] = $resultado;
  print json_encode($array, JSON_UNESCAPED_UNICODE);         
}
else{
	$banco = new Banco();
    $resultado = $banco::todos(); 
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