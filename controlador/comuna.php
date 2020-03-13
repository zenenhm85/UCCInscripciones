<?php 
    include_once '../modelo/comuna.php';

    $_POST = json_decode(file_get_contents("php://input"), true);

    $opcao = (isset($_POST['opcao'])) ? $_POST['opcao'] : '';

    if($opcao == 1){
        
        $nomep = (isset($_POST['nomep'])) ? $_POST['nomep'] : '';
        $nomem = (isset($_POST['nomem'])) ? $_POST['nomem'] : '';
        $nomec = (isset($_POST['nomec'])) ? $_POST['nomec'] : '';

        $comuna = new Comuna();
        $resultado = $comuna::Cadastrar($nomep,$nomem,$nomec);   
        $array = array();
        $array[0] = $resultado;
        print json_encode($array, JSON_UNESCAPED_UNICODE);

   }
   elseif($opcao == 2){
        
        $nomep = (isset($_POST['nomep'])) ? $_POST['nomep'] : '';
        $nomem = (isset($_POST['nomem'])) ? $_POST['nomem'] : '';
        $nomec = (isset($_POST['nomec'])) ? $_POST['nomec'] : '';

        $nomepa = (isset($_POST['nomepa'])) ? $_POST['nomepa'] : '';
        $nomema = (isset($_POST['nomema'])) ? $_POST['nomema'] : '';
        $nomeca = (isset($_POST['nomeca'])) ? $_POST['nomeca'] : '';

        $comuna = new Comuna();
        $resultado = $comuna::Alterar($nomepa,$nomema,$nomeca,$nomep,$nomem,$nomec);   
        $array = array();
        $array[0] = $resultado;
        print json_encode($array, JSON_UNESCAPED_UNICODE);
    }
    elseif($opcao == 3){
        $nomep = (isset($_POST['nomep'])) ? $_POST['nomep'] : '';
        $nomem = (isset($_POST['nomem'])) ? $_POST['nomem'] : '';
        $nomec = (isset($_POST['nomec'])) ? $_POST['nomec'] : '';

        $comuna = new Comuna();
        $resultado = $comuna::Excluir($nomep,$nomem,$nomec);   
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
    elseif($opcao == 6){
        $nomep = (isset($_POST['nomep'])) ? $_POST['nomep'] : '';
        $nomem = (isset($_POST['nomem'])) ? $_POST['nomem'] : '';
        $comuna = new Comuna();
        $resultado = $comuna::todasporMunicipioeProv($nomep,$nomem);    
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