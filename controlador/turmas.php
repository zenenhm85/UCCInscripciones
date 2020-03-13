<?php 
    session_start();
    include_once '../modelo/turmas.php';

    $_POST = json_decode(file_get_contents("php://input"), true);

    $opcao = (isset($_POST['opcao'])) ? $_POST['opcao'] : '';

    if($opcao == 1){
        $quantidade = (isset($_POST['quantidade'])) ? $_POST['quantidade'] : '';
        $curso = (isset($_POST['curso'])) ? $_POST['curso'] : '';
        $ano = (isset($_POST['ano'])) ? $_POST['ano'] : '';
        $periodo = (isset($_POST['periodo'])) ? $_POST['periodo'] : '';
        $pos = (isset($_POST['pos'])) ? $_POST['pos'] : '';
        $turma = new Turma();
        $resultado = $turma::Turma($curso,$ano,$pos,$quantidade,$periodo); 

        $array = array();
        $i = 0;
        $numero = $pos+1;
               
        while ($f = mysqli_fetch_array($resultado)) 
        {
            $arrayAux= array('no' =>$numero,'bi'=>$f['bi'],'nomecompleto'=>$f['nomecompleto']);
            $array[$i] = $arrayAux;
            $i++;
            $numero++;
        }
        print json_encode($array, JSON_UNESCAPED_UNICODE);             
    } 
    elseif ($opcao == 2) {

        $curso = (isset($_POST['curso'])) ? $_POST['curso'] : '';
        $ano = (isset($_POST['ano'])) ? $_POST['ano'] : '';
        $periodo = (isset($_POST['periodo'])) ? $_POST['periodo'] : '';
        
        $turma = new Turma();
        $resultado = $turma::QuantPorCurso($curso,$ano,$periodo); 

        $array = array();
        $array[0] = $resultado;
        print json_encode($array, JSON_UNESCAPED_UNICODE);     

    }   
   elseif($opcao == -1){
        $quantidade = (isset($_POST['quantidade'])) ? $_POST['quantidade'] : '';
        $curso = (isset($_POST['curso'])) ? $_POST['curso'] : '';
        $ano = (isset($_POST['ano'])) ? $_POST['ano'] : '';
        $periodo = (isset($_POST['periodo'])) ? $_POST['periodo'] : '';
        $pos = (isset($_POST['pos'])) ? $_POST['pos'] : '';
        $turma = new Turma();
        $resultado = $turma::Turma2($curso,$ano,$pos,$quantidade,$periodo); 

        $array = array();
        $i = 0;
        $numero = $pos+1;
               
        while ($f = mysqli_fetch_array($resultado)) 
        {
            $arrayAux= array('no' =>$numero,'bi'=>$f['bi'],'nomecompleto'=>$f['nomecompleto']);
            $array[$i] = $arrayAux;
            $i++;
            $numero++;
        }
        print json_encode($array, JSON_UNESCAPED_UNICODE);             
    } 
    elseif ($opcao == -2) {

        $curso = (isset($_POST['curso'])) ? $_POST['curso'] : '';
        $ano = (isset($_POST['ano'])) ? $_POST['ano'] : '';
        $periodo = (isset($_POST['periodo'])) ? $_POST['periodo'] : '';
        
        $turma = new Turma();
        $resultado = $turma::QuantPorCurso2($curso,$ano,$periodo); 

        $array = array();
        $array[0] = $resultado;
        print json_encode($array, JSON_UNESCAPED_UNICODE);     

    }   
    elseif ($opcao == -3) {

        $quantidade = (isset($_POST['quantidade'])) ? $_POST['quantidade'] : '';
        $curso = (isset($_POST['curso'])) ? $_POST['curso'] : '';
        $ano = (isset($_POST['ano'])) ? $_POST['ano'] : '';
        $periodo = (isset($_POST['periodo'])) ? $_POST['periodo'] : '';
        $pos = (isset($_POST['pos'])) ? $_POST['pos'] : '';
        $turma = new Turma();
        $resultado = $turma::CursoCompleto2($curso,$ano,$periodo); 

        $array = array();
        $i = 0;
        
               
        while ($f = mysqli_fetch_array($resultado)) 
        {
            $arrayAux= array('no' =>$i + 1,'bi'=>$f['bi'],'nomecompleto'=>$f['nomecompleto']);
            $array[$i] = $arrayAux;
            $i++;            
        }
        print json_encode($array, JSON_UNESCAPED_UNICODE);     

    }   
    else{
        $quantidade = (isset($_POST['quantidade'])) ? $_POST['quantidade'] : '';
        $curso = (isset($_POST['curso'])) ? $_POST['curso'] : '';
        $ano = (isset($_POST['ano'])) ? $_POST['ano'] : '';
        $periodo = (isset($_POST['periodo'])) ? $_POST['periodo'] : '';
        $pos = (isset($_POST['pos'])) ? $_POST['pos'] : '';
        $turma = new Turma();
        $resultado = $turma::CursoCompleto($curso,$ano,$periodo); 

        $array = array();
        $i = 0;        
               
        while ($f = mysqli_fetch_array($resultado)) 
        {
            $arrayAux= array('no' =>$i + 1,'bi'=>$f['bi'],'nomecompleto'=>$f['nomecompleto']);
            $array[$i] = $arrayAux;
            $i++;            
        }
        print json_encode($array, JSON_UNESCAPED_UNICODE);  
    }



?>