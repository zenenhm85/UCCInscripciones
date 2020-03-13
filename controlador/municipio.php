<?php 
    include_once '../modelo/municipio.php';

    $_POST = json_decode(file_get_contents("php://input"), true);

    $opcao = (isset($_POST['opcao'])) ? $_POST['opcao'] : '';

    if($opcao == 1){
        
        $nomep = (isset($_POST['nomep'])) ? $_POST['nomep'] : '';  
        $nomem = (isset($_POST['nomem'])) ? $_POST['nomem'] : '';        
        $municipio = new Municipio();
        $resultado = $municipio::Cadastrar($nomep,$nomem);
        $array = array();
        $array[0] = $resultado;
        print json_encode($array, JSON_UNESCAPED_UNICODE);

   }
   elseif($opcao == 2){

        $nomema = (isset($_POST['nomema'])) ? $_POST['nomema'] : '';
        $nomepa = (isset($_POST['nomepa'])) ? $_POST['nomepa'] : '';               
        $nomem = (isset($_POST['nomem'])) ? $_POST['nomem'] : '';
        $nomep = (isset($_POST['nomep'])) ? $_POST['nomep'] : '';       

        $municipio = new Municipio();
        $resultado = $municipio::Alterar($nomepa,$nomema,$nomep,$nomem);
        $array = array();
        $array[0] = $resultado;
        print json_encode($array, JSON_UNESCAPED_UNICODE);
    }
    elseif($opcao == 3){
        $nomem = (isset($_POST['nomem'])) ? $_POST['nomem'] : '';
        $nomep = (isset($_POST['nomep'])) ? $_POST['nomep'] : '';    
        $municipio = new Municipio();
        $resultado = $municipio::Excluir($nomep,$nomem);
        $array = array();
        $array[0] = $resultado;
        print json_encode($array, JSON_UNESCAPED_UNICODE);        
    }    
    elseif($opcao == 5){
        $nomep = (isset($_POST['nomeprov'])) ? $_POST['nomeprov'] : '';
        $municipio = new Municipio();
        $resultado = $municipio::todos2($nomep);    
        $array = array();
        $i = 0;
        while ($f = mysqli_fetch_array($resultado)) 
        {
            $array[$i] = $f;
            $i++;

        }
        print json_encode($array, JSON_UNESCAPED_UNICODE);        
    }    
    else{
        $municipio = new Municipio();
        $resultado = $municipio::todos();    
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