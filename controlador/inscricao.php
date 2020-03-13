<?php 
session_start();

include_once '../modelo/inscricao.php';
$_POST = json_decode(file_get_contents("php://input"), true);
$opcao = (isset($_POST['opcao'])) ? $_POST['opcao'] : '';

if($opcao == 1){
	$bi = (isset($_POST['bi'])) ? $_POST['bi'] : ''; 
  $ano = (isset($_POST['ano'])) ? $_POST['ano'] : '';  
  $cursos = (isset($_POST['cursos'])) ? $_POST['cursos'] : '';
  $cursosp = (isset($_POST['cursosp'])) ? $_POST['cursosp'] : '';

  $usurioaux = $_SESSION['Usuario']; 
  $userid = $usurioaux['idusuario'];  

	$inscricao = new Inscricao();
  $resultado = $inscricao::Cadastrar($bi,$ano,$cursos,$cursosp,$userid); 
  $array = array();
	$array[0] = $resultado;
	print json_encode($array, JSON_UNESCAPED_UNICODE);
}
elseif ($opcao == 2) {
  $bi = (isset($_POST['bi'])) ? $_POST['bi'] : ''; 
  $ano = (isset($_POST['ano'])) ? $_POST['ano'] : ''; 

  $inscricao = new Inscricao();
  $resultado = $inscricao::Excluir($bi,$ano);
  $array = array();
  $array[0] = $resultado;
  print json_encode($array, JSON_UNESCAPED_UNICODE);         
}
elseif ($opcao == 3) {
  $bi = (isset($_POST['bi'])) ? $_POST['bi'] : ''; 
  $ano = (isset($_POST['ano'])) ? $_POST['ano'] : ''; 
  $perido = (isset($_POST['perido'])) ? $_POST['perido'] : '';

  $inscricao = new Inscricao();
  $resultado = $inscricao::todosbiano($bi,$ano,$perido);
  $array = array();
  $i = 0;
  while ($f = mysqli_fetch_array($resultado)) 
  {
    $array[$i] =$f;
    $i++;
  }
  print json_encode($array, JSON_UNESCAPED_UNICODE);         
}
elseif ($opcao == 5) {
  $bi = (isset($_POST['bi'])) ? $_POST['bi'] : '';
  $inscricao = new Inscricao();
  $resultado = $inscricao::dadosbi($bi);
  $array = array();
  $array[0] = $resultado;
  print json_encode($array, JSON_UNESCAPED_UNICODE);          
}
elseif ($opcao == 6) { 

  $usurioaux = $_SESSION['Usuario']; 
  $userid = $usurioaux['idusuario']; 
  
  $inscricao = new Inscricao();
  $resultado = $inscricao::compagamento($userid);
  $array = array();
  $i = 0;
  while ($f = mysqli_fetch_array($resultado)) 
  {
    $array[$i] =$f;
    $i++;
  }
  print json_encode($array, JSON_UNESCAPED_UNICODE);          
}
elseif ($opcao == 7) {
  $usurioaux = $_SESSION['Usuario']; 
  $userid = $usurioaux['idusuario']; 

  $bi = (isset($_POST['bi'])) ? $_POST['bi'] : ''; 
  $ano = (isset($_POST['ano'])) ? $_POST['ano'] : ''; 
  $banco = (isset($_POST['banco'])) ? $_POST['banco'] : ''; 
  $valor = (isset($_POST['valor'])) ? $_POST['valor'] : '';
  $codigo = (isset($_POST['codigo'])) ? $_POST['codigo'] : '';

  $inscricao = new Inscricao();
  $resultado = $inscricao::Pagar($bi,$ano,$banco,$valor,$codigo,$userid);
  $array = array();
  $array[0] = $resultado;
  print json_encode($array, JSON_UNESCAPED_UNICODE);         
}
elseif ($opcao == 8) {
  $bi = (isset($_POST['bi'])) ? $_POST['bi'] : ''; 
  $ano = (isset($_POST['ano'])) ? $_POST['ano'] : ''; 
  $inscricao = new Inscricao();
  $resultado = $inscricao::ExcluirPago($bi,$ano);
  $array = array();
  $array[0] = $resultado;
  print json_encode($array, JSON_UNESCAPED_UNICODE);         
}
elseif($opcao == -1){
  $bi = (isset($_POST['bi'])) ? $_POST['bi'] : '';
  $inscricao = new Inscricao();
  $resultado = $inscricao::listarPorBI($bi);    
  $array = array();
  $i = 0;
  while ($f = mysqli_fetch_array($resultado)) 
  {
      $array[$i] = $f;
      $i++;
  }
  print json_encode($array, JSON_UNESCAPED_UNICODE);
}
elseif($opcao == -2){
  $bi = (isset($_POST['bi'])) ? $_POST['bi'] : '';
  $inscricao = new Inscricao();
  $resultado = $inscricao::listarPorBIPago($bi);    
  $array = array();
  $i = 0;
  while ($f = mysqli_fetch_array($resultado)) 
  {
      $array[$i] = $f;
      $i++;
  }
  print json_encode($array, JSON_UNESCAPED_UNICODE);
}
elseif($opcao == -3){
  $usurioaux = $_SESSION['Usuario']; 
  $userid = $usurioaux['idusuario'];  
  $inscricao = new Inscricao();
  $resultado = $inscricao::todos2($userid); 
  $array = array();
  $i = 0;
  while ($f = mysqli_fetch_array($resultado)) 
  {
    $array[$i] =$f;
    $i++;
  }
  print json_encode($array, JSON_UNESCAPED_UNICODE);
}
elseif($opcao == -4){
  $bi = (isset($_POST['bi'])) ? $_POST['bi'] : '';
  $inscricao = new Inscricao();
  $resultado = $inscricao::listarPorBI2($bi);    
  $array = array();
  $i = 0;
  while ($f = mysqli_fetch_array($resultado)) 
  {
      $array[$i] = $f;
      $i++;
  }
  print json_encode($array, JSON_UNESCAPED_UNICODE);
}
elseif($opcao == -5){
  $bi = (isset($_POST['bi'])) ? $_POST['bi'] : ''; 
  $ano = (isset($_POST['ano'])) ? $_POST['ano'] : '';  
  $cursos = (isset($_POST['cursos'])) ? $_POST['cursos'] : '';
  $cursosp = (isset($_POST['cursosp'])) ? $_POST['cursosp'] : '';

  $usurioaux = $_SESSION['Usuario']; 
  $userid = $usurioaux['idusuario'];  

  $inscricao = new Inscricao();
  $resultado = $inscricao::Cadastrar2($bi,$ano,$cursos,$cursosp,$userid); 
  $array = array();
  $array[0] = $resultado;
  print json_encode($array, JSON_UNESCAPED_UNICODE);
}
elseif ($opcao == -6) {
  $bi = (isset($_POST['bi'])) ? $_POST['bi'] : ''; 
  $ano = (isset($_POST['ano'])) ? $_POST['ano'] : ''; 

  $inscricao = new Inscricao();
  $resultado = $inscricao::Excluir2($bi,$ano);
  $array = array();
  $array[0] = $resultado;
  print json_encode($array, JSON_UNESCAPED_UNICODE);         
}
elseif ($opcao == -7) {
  $bi = (isset($_POST['bi'])) ? $_POST['bi'] : ''; 
  $ano = (isset($_POST['ano'])) ? $_POST['ano'] : ''; 
  $perido = (isset($_POST['perido'])) ? $_POST['perido'] : '';

  $inscricao = new Inscricao();
  $resultado = $inscricao::todosbiano2($bi,$ano,$perido);
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
  $usurioaux = $_SESSION['Usuario']; 
  $userid = $usurioaux['idusuario'];  
	$inscricao = new Inscricao();
  $resultado = $inscricao::todos($userid); 
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