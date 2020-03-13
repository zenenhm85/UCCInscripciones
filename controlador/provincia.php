<?php 
    include_once '../modelo/provincia.php';

    $_POST = json_decode(file_get_contents("php://input"), true);

    $opcao = (isset($_POST['opcao'])) ? $_POST['opcao'] : '';

    if($opcao == 1){
        
        $nome = (isset($_POST['nome'])) ? $_POST['nome'] : '';        
        $provincia = new Provincia();
        $resultado = $provincia::Cadastrar($nome);
        $array = array();
        $array[0] = $resultado;
        print json_encode($array, JSON_UNESCAPED_UNICODE);

   }
   elseif($opcao == 2){
               
        $nome = (isset($_POST['nome'])) ? $_POST['nome'] : '';
        $nomea = (isset($_POST['nomea'])) ? $_POST['nomea'] : '';
        $provincia = new Provincia();
        $resultado = $provincia::Alterar($nomea,$nome);
        $array = array();
        $array[0] = $resultado;
        print json_encode($array, JSON_UNESCAPED_UNICODE);

    }
    elseif($opcao == 3){
        $nome = (isset($_POST['nome'])) ? $_POST['nome'] : '';
        $provincia = new Provincia();
        $resultado = $provincia::Excluir($nome);
        $array = array();
        $array[0] = $resultado;
        print json_encode($array, JSON_UNESCAPED_UNICODE);        
    }    
    else{
        $provincia = new Provincia();
        $resultado = $provincia::todos();    
        $array = array();
        $i = 0;
        while ($f = mysqli_fetch_array($resultado)) 
        {
            $array[$i] = $f;
            $i++;

        }
        print json_encode($array, JSON_UNESCAPED_UNICODE);
    }
?>