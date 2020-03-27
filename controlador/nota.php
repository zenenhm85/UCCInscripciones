<?php 
session_start();

include_once '../modelo/nota.php';
$_POST = json_decode(file_get_contents("php://input"), true);
$opcao = (isset($_POST['opcao'])) ? $_POST['opcao'] : '';

if($opcao == 1){

	$bi = (isset($_POST['bi'])) ? $_POST['bi'] : ''; 
  $ano = (isset($_POST['ano'])) ? $_POST['ano'] : '';  
  $curso = (isset($_POST['curso'])) ? $_POST['curso'] : '';
  $periodo = (isset($_POST['periodo'])) ? $_POST['periodo'] : '';
  $nota1 = (isset($_POST['nota'])) ? $_POST['nota'] : '';

  $usurioaux = $_SESSION['Usuario']; 
  $userid = $usurioaux['idusuario'];  

	$nota = new Nota();
  $resultado = $nota::Cadastrar1($bi,$ano,$curso,$periodo,$nota1,$userid); 
  $array = array();
	$array[0] = $resultado;
	print json_encode($array, JSON_UNESCAPED_UNICODE);
}
elseif($opcao == 2){

  $bi = (isset($_POST['bi'])) ? $_POST['bi'] : ''; 
  $ano = (isset($_POST['ano'])) ? $_POST['ano'] : '';  
  $curso = (isset($_POST['curso'])) ? $_POST['curso'] : '';
  $periodo = (isset($_POST['periodo'])) ? $_POST['periodo'] : '';  

  $nota = new Nota();
  $resultado = $nota::Excluir($bi,$ano,$curso,$periodo); 
  $array = array();
  $array[0] = $resultado;
  print json_encode($array, JSON_UNESCAPED_UNICODE);
}
elseif($opcao == 3){

  $bi = (isset($_POST['bi'])) ? $_POST['bi'] : ''; 
  $ano = (isset($_POST['ano'])) ? $_POST['ano'] : '';  
  $curso = (isset($_POST['curso'])) ? $_POST['curso'] : '';
  $periodo = (isset($_POST['periodo'])) ? $_POST['periodo'] : '';
  $nota1 = (isset($_POST['nota'])) ? $_POST['nota'] : ''; 

  $usurioaux = $_SESSION['Usuario']; 
  $userid = $usurioaux['idusuario'];

  $nota = new Nota();
  $resultado = $nota::Alterar($bi,$ano,$curso,$periodo,$nota1,$userid); 
  $array = array();
  $array[0] = $resultado;
  print json_encode($array, JSON_UNESCAPED_UNICODE);
}
elseif($opcao == 5){

  
  $ano = (isset($_POST['ano'])) ? $_POST['ano'] : '';  
  $curso = (isset($_POST['curso'])) ? $_POST['curso'] : '';
  $periodo = (isset($_POST['periodo'])) ? $_POST['periodo'] : '';  

  $nota = new Nota();
  $resultado = $nota::AnoCursoPeriodoPublicar($ano,$curso,$periodo); 


  $array = array();
  $i = 0;
  
         
  while ($f = mysqli_fetch_array($resultado)) 
  {
      $apto = "Apto";
      if($f['nota1']< 10){
        $apto = "Não Apto";
      }
      $arrayAux= array('no' =>$i + 1,'bi'=>$f['bi'],'nomecompleto'=>$f['nomecompleto'],'nota1'=>$f['nota1'],'admitido'=>$f['admitido'],'apto'=>$apto );

      $array[$i] = $arrayAux;
      $i++;            
  }
  print json_encode($array, JSON_UNESCAPED_UNICODE); 
}
elseif($opcao == 6){

  $bi = (isset($_POST['bi'])) ? $_POST['bi'] : ''; 
  $ano = (isset($_POST['ano'])) ? $_POST['ano'] : '';  
  $curso = (isset($_POST['curso'])) ? $_POST['curso'] : '';
  $periodo = (isset($_POST['periodo'])) ? $_POST['periodo'] : ''; 
  $valor = (isset($_POST['valor'])) ? $_POST['valor'] : '';  

  $nota = new Nota();
  $resultado = $nota::Admitir($bi,$valor,$ano,$curso,$periodo); 
  $array = array();
  $array[0] = $resultado;
  print json_encode($array, JSON_UNESCAPED_UNICODE);
}
elseif($opcao == 7){

  $bi = (isset($_POST['bi'])) ? $_POST['bi'] : ''; 
  $ano = (isset($_POST['ano'])) ? $_POST['ano'] : '';  
  $curso = (isset($_POST['curso'])) ? $_POST['curso'] : '';
  $periodo = (isset($_POST['periodo'])) ? $_POST['periodo'] : ''; 
   

  $nota = new Nota();
  $resultado = $nota::ProcurarPorBI($ano,$curso,$periodo,$bi); 
  $array = array();
  $i = 0;
  while ($f = mysqli_fetch_array($resultado)) 
  {
    $array[$i] =$f;
    $i++;
  }
  print json_encode($array, JSON_UNESCAPED_UNICODE);
}
elseif($opcao == -1){

  $bi = (isset($_POST['bi'])) ? $_POST['bi'] : ''; 
  $ano = (isset($_POST['ano'])) ? $_POST['ano'] : '';  
  $curso = (isset($_POST['curso'])) ? $_POST['curso'] : '';
  $periodo = (isset($_POST['periodo'])) ? $_POST['periodo'] : '';
  $nota2 = (isset($_POST['nota'])) ? $_POST['nota'] : '';

  $usurioaux = $_SESSION['Usuario']; 
  $userid = $usurioaux['idusuario'];  

  $nota = new Nota();
  $resultado = $nota::Cadastrar2($bi,$ano,$curso,$periodo,$nota2,$userid); 
  $array = array();
  $array[0] = $resultado;
  print json_encode($array, JSON_UNESCAPED_UNICODE);
}
elseif($opcao == -2){

  $ano = (isset($_POST['ano'])) ? $_POST['ano'] : '';  
  $curso = (isset($_POST['curso'])) ? $_POST['curso'] : '';
  $periodo = (isset($_POST['periodo'])) ? $_POST['periodo'] : '';

  $usurioaux = $_SESSION['Usuario']; 
  $userid = $usurioaux['idusuario']; 

  $nota = new Nota();

  $resultado = $nota::AnoCursoPeriodo2($ano,$curso,$periodo,$userid); 
  $array = array();
  $i = 0;
  while ($f = mysqli_fetch_array($resultado)) 
  {
    $array[$i] =$f;
    $i++;
  }
  print json_encode($array, JSON_UNESCAPED_UNICODE);
}
elseif($opcao == -3){

  $bi = (isset($_POST['bi'])) ? $_POST['bi'] : ''; 
  $ano = (isset($_POST['ano'])) ? $_POST['ano'] : '';  
  $curso = (isset($_POST['curso'])) ? $_POST['curso'] : '';
  $periodo = (isset($_POST['periodo'])) ? $_POST['periodo'] : '';  

  $nota = new Nota();
  $resultado = $nota::Excluir2($bi,$ano,$curso,$periodo); 
  $array = array();
  $array[0] = $resultado;
  print json_encode($array, JSON_UNESCAPED_UNICODE);
}
elseif($opcao == -4){

  $bi = (isset($_POST['bi'])) ? $_POST['bi'] : ''; 
  $ano = (isset($_POST['ano'])) ? $_POST['ano'] : '';  
  $curso = (isset($_POST['curso'])) ? $_POST['curso'] : '';
  $periodo = (isset($_POST['periodo'])) ? $_POST['periodo'] : '';
  $nota1 = (isset($_POST['nota'])) ? $_POST['nota'] : ''; 

  $usurioaux = $_SESSION['Usuario']; 
  $userid = $usurioaux['idusuario'];

  $nota = new Nota();
  $resultado = $nota::Alterar2($bi,$ano,$curso,$periodo,$nota1,$userid); 
  $array = array();
  $array[0] = $resultado;
  print json_encode($array, JSON_UNESCAPED_UNICODE);
}
elseif($opcao == -5){

  $bi = (isset($_POST['bi'])) ? $_POST['bi'] : ''; 
  $ano = (isset($_POST['ano'])) ? $_POST['ano'] : '';  
  $curso = (isset($_POST['curso'])) ? $_POST['curso'] : '';
  $periodo = (isset($_POST['periodo'])) ? $_POST['periodo'] : ''; 
   

  $nota = new Nota();
  $resultado = $nota::ProcurarPorBI2($ano,$curso,$periodo,$bi); 
  $array = array();
  $i = 0;
  while ($f = mysqli_fetch_array($resultado)) 
  {
    $array[$i] =$f;
    $i++;
  }
  print json_encode($array, JSON_UNESCAPED_UNICODE);
}
elseif($opcao == -6){

  
  $ano = (isset($_POST['ano'])) ? $_POST['ano'] : '';  
  $curso = (isset($_POST['curso'])) ? $_POST['curso'] : '';
  $periodo = (isset($_POST['periodo'])) ? $_POST['periodo'] : '';  

  $nota = new Nota();
  $resultado = $nota::AnoCursoPeriodoPublicar2($ano,$curso,$periodo); 


  $array = array();
  $i = 0;
  
         
  while ($f = mysqli_fetch_array($resultado)) 
  {
      $apto = "Apto";
      if($f['nota2']< 10){
        $apto = "Não Apto";
      }
      $arrayAux= array('no' =>$i + 1,'bi'=>$f['bi'],'nomecompleto'=>$f['nomecompleto'],'nota2'=>$f['nota2'],'admitido'=>$f['admitido'],'apto'=>$apto);
      $array[$i] = $arrayAux;
      $i++;            
  }
  print json_encode($array, JSON_UNESCAPED_UNICODE); 
}
elseif($opcao == -7){

  $bi = (isset($_POST['bi'])) ? $_POST['bi'] : ''; 
  $ano = (isset($_POST['ano'])) ? $_POST['ano'] : '';  
  $curso = (isset($_POST['curso'])) ? $_POST['curso'] : '';
  $periodo = (isset($_POST['periodo'])) ? $_POST['periodo'] : ''; 
  $valor = (isset($_POST['valor'])) ? $_POST['valor'] : '';  

  $nota = new Nota();
  $resultado = $nota::Admitir($bi,$valor,$ano,$curso,$periodo); 
  $array = array();
  $array[0] = $resultado;
  print json_encode($array, JSON_UNESCAPED_UNICODE);
}
elseif($opcao == -8){

  
  $ano = (isset($_POST['ano'])) ? $_POST['ano'] : '';  
  $curso = (isset($_POST['curso'])) ? $_POST['curso'] : '';
  $periodo = (isset($_POST['periodo'])) ? $_POST['periodo'] : '';  

  $nota = new Nota();
  $resultado = $nota::AnoCursoPeriodoPublicarAdmitidos($ano,$curso,$periodo); 


  $array = array();
  $i = 0;
  
         
  while ($f = mysqli_fetch_array($resultado)) 
  {
      $arrayAux= array('no' =>$i + 1,'bi'=>$f['bi'],'nomecompleto'=>$f['nomecompleto'],'notafinal'=>$f['notafinal'],'convocatoria'=>$f['convocatoria']);
      $array[$i] = $arrayAux;
      $i++;            
  }
  print json_encode($array, JSON_UNESCAPED_UNICODE); 
}
elseif($opcao == -9){

  
  $ano = (isset($_POST['ano'])) ? $_POST['ano'] : '';  
  $curso = (isset($_POST['curso'])) ? $_POST['curso'] : '';
  $periodo = (isset($_POST['periodo'])) ? $_POST['periodo'] : '';  

  $nota = new Nota();
  $resultado = $nota::AnoCursoPeriodoPublicarPautaGeral($ano,$curso,$periodo); 


  $array = array();
  $i = 0;
  
         
  while ($f = mysqli_fetch_array($resultado)) 
  {
      $arrayAux= array('no' =>$i + 1,'bi'=>$f['bi'],'nomecompleto'=>$f['nomecompleto'],'notafinal'=>$f['notafinal'],'convocatoria'=>$f['convocatoria'],'admitido'=>$f['admitido']);
      $array[$i] = $arrayAux;
      $i++;            
  }
  print json_encode($array, JSON_UNESCAPED_UNICODE); 
}
else{
// opcion 4
  $ano = (isset($_POST['ano'])) ? $_POST['ano'] : '';  
  $curso = (isset($_POST['curso'])) ? $_POST['curso'] : '';
  $periodo = (isset($_POST['periodo'])) ? $_POST['periodo'] : '';

  $usurioaux = $_SESSION['Usuario']; 
  $userid = $usurioaux['idusuario']; 

	$nota = new Nota();

  $resultado = $nota::AnoCursoPeriodo($ano,$curso,$periodo,$userid); 
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