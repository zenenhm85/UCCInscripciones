<?php 
    session_start();
    include_once '../modelo/usuario.php';

    $_POST = json_decode(file_get_contents("php://input"), true);

    $opcao = (isset($_POST['opcao'])) ? $_POST['opcao'] : '';

    if($opcao == 1){
        $id = (isset($_POST['userid'])) ? $_POST['userid'] : '';
        $senha = (isset($_POST['senha'])) ? $_POST['senha'] : '';
        $usuario = new Usuario();
        $resultado = $usuario::inicio($id,$senha);        
        $array = array();

        if($resultado == "1"){
            $otrosdatos = $usuario::NomeporID($id);
            $usuario2 = array('idnome' => $otrosdatos['nome'],'idusuario' => $_POST['userid'] ,'tipo'=>$otrosdatos['tipo']);
            $_SESSION['Usuario'] = $usuario2;
            $array[0] = "1";
        }
        else{
          $array[0] = $resultado;
        }        
        print json_encode($array, JSON_UNESCAPED_UNICODE);        
    } 
    elseif ($opcao == 2) {
          $id = (isset($_POST['id'])) ? $_POST['id'] : '';
          $habilitado = (isset($_POST['habilitado'])) ? $_POST['habilitado'] : '';
          $usuario = new Usuario();
          $resultado = $usuario::HabilitarD($id,$habilitado);
          $array = array();
          $array[0] = $resultado;
          print json_encode($array, JSON_UNESCAPED_UNICODE);  
       }   
       elseif($opcao == 3){
          $nome = (isset($_POST['nome'])) ? $_POST['nome'] : '';
          $email = (isset($_POST['email'])) ? $_POST['email'] : '';
          $telefone = (isset($_POST['telefone'])) ? $_POST['telefone'] : '';
          $idusuario = (isset($_POST['idusuario'])) ? $_POST['idusuario'] : '';         
          $senha = (isset($_POST['senha'])) ? $_POST['senha'] : '';
          $tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
          
          $usuario = new Usuario();
          $resultado = $usuario::Cadastrar($nome,$email,$telefone,$idusuario,$senha,$tipo);
          $array = array();
          $array[0] = $resultado;
          print json_encode($array, JSON_UNESCAPED_UNICODE);
       }
       elseif ($opcao == 5) {
          $idusuario = (isset($_POST['idusuario'])) ? $_POST['idusuario'] : '';  
          $usuario = new Usuario();
          $resultado = $usuario::Excluir($idusuario);
          $array = array();
          $array[0] = $resultado;
          print json_encode($array, JSON_UNESCAPED_UNICODE);         
       }
       elseif($opcao == 6){
        $id = (isset($_POST['userid'])) ? $_POST['userid'] : '';
        $senhaanterior = (isset($_POST['senhaa'])) ? $_POST['senhaa'] : '';
        $senhanova = (isset($_POST['senhan'])) ? $_POST['senhan'] : '';
        $usuario = new Usuario();
        $resultado = $usuario::TrocarSenha($id,$senhaanterior, $senhanova);        
        $array = array();
        $array[0] = $resultado;        
        print json_encode($array, JSON_UNESCAPED_UNICODE);        
    }    
    elseif($opcao == 7){
        $ida = (isset($_POST['ida'])) ? $_POST['ida'] : '';
        $idusernew = (isset($_POST['iduser'])) ? $_POST['iduser'] : '';
        $nome = (isset($_POST['nome'])) ? $_POST['nome'] : '';
        $tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
        $email = (isset($_POST['email'])) ? $_POST['email'] : '';
        $telefone = (isset($_POST['telefone'])) ? $_POST['telefone'] : '';
        $senha = (isset($_POST['senha'])) ? $_POST['senha'] : '';
        
        $usuario = new Usuario();
        $resultado = $usuario::Alterar($ida, $idusernew, $nome, $tipo, $email, $telefone,$senha);        
        $array = array();
        $array[0] = $resultado;        
        print json_encode($array, JSON_UNESCAPED_UNICODE);        
    } 
    elseif($opcao == -1){
        $id = (isset($_POST['id'])) ? $_POST['id'] : '';       
        $usuario = new Usuario();
        $resultado = $usuario::NomeporID($id);        
        $array = array();
        $array[0] = $resultado['nome'];        
        print json_encode($array, JSON_UNESCAPED_UNICODE);        
    } 
    else{
        $usuario = new Usuario();
        $resultado = $usuario::todos(); 
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