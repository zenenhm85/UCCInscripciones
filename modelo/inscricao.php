<?php 
include_once 'conexao.php';

class Inscricao {

    function __construct() {            
        
    }
    public static function todos($userid) {
        $objeto = new Conexao();
        $conexao = $objeto->Conectar();
         
        $query = "SELECT * FROM inscricao WHERE userid ='$userid' ORDER BY data DESC LIMIT 25";                            
        try{
            $listaAlunos = mysqli_query($conexao, $query); 
            mysqli_close($conexao);
            return $listaAlunos;
        }
        catch (Exception $e){
            return "O error de Conexão é: ". $e->getMessage();
        }       
    }
    public static function todos2($userid) {
        $objeto = new Conexao();
        $conexao = $objeto->Conectar();
         
        $query = "SELECT * FROM inscricao WHERE userid2 ='$userid' AND convocatoria='2' ORDER BY data DESC LIMIT 25";                            
        try{
            $listaAlunos = mysqli_query($conexao, $query); 
            mysqli_close($conexao);
            return $listaAlunos;
        }
        catch (Exception $e){
            return "O error de Conexão é: ". $e->getMessage();
        }       
    }        
    public static function compagamento($useridpaga) {
        $objeto = new Conexao();
        $conexao = $objeto->Conectar(); 
        $query = "SELECT * FROM inscricao WHERE valores!='-1' AND useridpaga = '$useridpaga' ORDER BY data DESC LIMIT 25";                            
        try{
            $listaAlunos = mysqli_query($conexao, $query); 
            mysqli_close($conexao);
            return $listaAlunos;
        }
        catch (Exception $e){
            return "O error de Conexão é: ". $e->getMessage();
        }       
    }        
    public static function todosbiano($bi,$ano,$perido) {
        $objeto = new Conexao();
        $conexao = $objeto->Conectar(); 
        $query = "SELECT * FROM inscricaocurso WHERE bi='$bi' AND ano='$ano' AND perido='$perido'";                            
        try{
            $listaCursos = mysqli_query($conexao, $query); 
            mysqli_close($conexao);
            return $listaCursos;
        }
        catch (Exception $e){
            return "O error de Conexão é: ". $e->getMessage();
        }       
    }
    public static function todosbiano2($bi,$ano,$perido) {
        $objeto = new Conexao();
        $conexao = $objeto->Conectar(); 
        $query = "SELECT * FROM inscricaocurso WHERE bi='$bi' AND ano='$ano' AND perido='$perido' AND convocatoria='2'";                            
        try{
            $listaCursos = mysqli_query($conexao, $query); 
            mysqli_close($conexao);
            return $listaCursos;
        }
        catch (Exception $e){
            return "O error de Conexão é: ". $e->getMessage();
        }       
    }
    public static function listarPorBI($bi) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT * FROM inscricao WHERE bi LIKE '$bi%' LIMIT 5";                            
            try{
                $listaAlunos = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listaAlunos;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
    } 
    public static function listarPorBI2($bi) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT * FROM inscricao WHERE bi LIKE '$bi%' AND convocatoria='2' LIMIT 5";                            
            try{
                $listaAlunos = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listaAlunos;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
    } 
    public static function listarPorBIPago($bi) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT * FROM inscricao WHERE bi LIKE '$bi%' AND valores!='-1'  LIMIT 5";                            
            try{
                $listaAlunos = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listaAlunos;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
    } 
    public static function dadosbi($bi) {
        $objeto = new Conexao();
        $conexao = $objeto->Conectar(); 
        $query = "SELECT nomecompleto FROM aluno WHERE bi='$bi' LIMIT 1";                            
        try{
            $listaAlunos = mysqli_query($conexao, $query); 
            $resultado = "";
            while ($f = mysqli_fetch_array($listaAlunos)) 
            {
                $resultado =$f['nomecompleto'];                
            }
            mysqli_close($conexao);
            return $resultado;
        }
        catch (Exception $e){
            return "O error de Conexão é: ". $e->getMessage();
        }       
    }                 
    public static function Cadastrar($bi,$ano,$cursosDiurno,$cursosPos,$userid) {
        $objeto = new Conexao();
        $conexao = $objeto->Conectar(); 

        $query = "INSERT INTO inscricao(bi,ano,userid) VALUES('$bi','$ano','$userid')";                           
        if(mysqli_query($conexao, $query))
        {
            foreach ($cursosDiurno as $curso) 
            {
                $query2 = "INSERT INTO inscricaocurso(bi,ano,curso,perido) VALUES('$bi','$ano','$curso','Regular')"; 
                if(!mysqli_query($conexao, $query2))
                {
                    $error = mysqli_error($conexao);
                    mysqli_close($conexao);
                    return 'Engano: ' . $error;
                }
                
            }
            foreach ($cursosPos as $curso) 
            {
                $query3 = "INSERT INTO inscricaocurso(bi,ano,curso,perido) VALUES('$bi','$ano','$curso','Pos Laboral')"; 
                if(!mysqli_query($conexao, $query3))
                {
                    $error = mysqli_error($conexao);
                    mysqli_close($conexao);
                    return 'Engano: ' . $error;
                }
                
            }
            mysqli_close($conexao);
            return "1";
        }
        else{
            $error = mysqli_error($conexao);
            mysqli_close($conexao);
            return 'Engano: ' . $error;
        }                   
    }
    public static function Cadastrar2($bi,$ano,$cursosDiurno,$cursosPos,$userid) {
        $objeto = new Conexao();
        $conexao = $objeto->Conectar();

        $query = "SELECT * FROM inscricao WHERE bi='$bi' AND ano='$ano' LIMIT 1";
        try{
            $listaAlunos = mysqli_query($conexao, $query); 
            if($listaAlunos->num_rows == 0){
                mysqli_close($conexao);
                return "0";
            }
            else{
                $query4 = "UPDATE inscricao SET convocatoria='2',userid2='$userid' WHERE bi='$bi' AND ano='$ano'"; 
                if(!mysqli_query($conexao, $query4))
                {
                    $error = mysqli_error($conexao);
                    mysqli_close($conexao);
                    return 'Engano: ' . $error;
                }
                else{
                    foreach ($cursosDiurno as $curso) 
                    {
                        $query2 = "UPDATE inscricaocurso SET convocatoria='2' WHERE bi='$bi' AND ano='$ano' AND perido='Regular' AND curso='$curso'"; 
                        if(!mysqli_query($conexao, $query2))
                        {
                            $error = mysqli_error($conexao);
                            mysqli_close($conexao);
                            return 'Engano: ' . $error;
                        }
                        
                    }
                    foreach ($cursosPos as $curso) 
                    {
                       $query3 = "UPDATE inscricaocurso SET convocatoria='2' WHERE bi='$bi' AND ano='$ano' AND perido='Pos Laboral' AND curso='$curso'";
                        if(!mysqli_query($conexao, $query3))
                        {
                            $error = mysqli_error($conexao);
                            mysqli_close($conexao);
                            return 'Engano: ' . $error;
                        }
                        
                    }
                    mysqli_close($conexao);
                    return "1";

                }
                

            }

        }
        catch (Exception $e){
            return "O error de Conexão é: ". $e->getMessage();
        }       
    }
    public static function Excluir($bi,$ano) {
        $objeto = new Conexao();
        $conexao = $objeto->Conectar();  
        $query = "DELETE FROM inscricao WHERE bi='$bi' AND ano='$ano'";                       
        if(mysqli_query($conexao, $query))
        {
            $query2 = "DELETE FROM inscricaocurso WHERE bi='$bi' AND ano='$ano'"; 
            if(!mysqli_query($conexao, $query2))
            {
                $error = mysqli_error($conexao);
                mysqli_close($conexao);
                return 'Engano: ' . $error;
            }
            mysqli_close($conexao);
            return "1";
        }
        else{
            $error = mysqli_error($conexao);
            mysqli_close($conexao);
            return 'Engano: ' . $error;
        }                   
    }
    public static function Excluir2($bi,$ano) {
        $objeto = new Conexao();
        $conexao = $objeto->Conectar();  
        $query = "UPDATE inscricao SET convocatoria='1',userid2='' WHERE bi='$bi' AND ano='$ano'";                       
        if(mysqli_query($conexao, $query))
        {
            $query2 = "UPDATE inscricaocurso SET convocatoria='1' WHERE bi='$bi' AND ano='$ano' AND convocatoria='2'"; 
            if(!mysqli_query($conexao, $query2))
            {
                $error = mysqli_error($conexao);
                mysqli_close($conexao);
                return 'Engano: ' . $error;
            }
            mysqli_close($conexao);
            return "1";
        }
        else{
            $error = mysqli_error($conexao);
            mysqli_close($conexao);
            return 'Engano: ' . $error;
        }                   
    }
    public static function Pagar($bi,$ano,$banco,$valor,$codigo,$useridpaga){
        $objeto = new Conexao();
        $conexao = $objeto->Conectar();  

        $query2 = "SELECT * FROM inscricao WHERE bi='$bi' AND ano = '$ano' AND valores='-1' LIMIT 1";                            
        try{
            $listaAlunos = mysqli_query($conexao, $query2); 
            if($listaAlunos->num_rows == 0){
                mysqli_close($conexao);
                return "0";
            }
            else{
                
                $data = date("Y-m-d H:i:s");
        
                $query = "UPDATE inscricao SET valores='$valor', banco='$banco',codreferencia='$codigo',data='$data',useridpaga='$useridpaga' WHERE bi='$bi' AND ano='$ano'";                
                if(mysqli_query($conexao, $query))
                {
                    mysqli_close($conexao);
                    return "1";
                }
                else{
                    $error = mysqli_error($conexao);
                    mysqli_close($conexao);
                    return 'Engano: ' . $error;
                }              

            }           
            
        }
        catch (Exception $e){
            return "O error de Conexão é: ". $e->getMessage();
        }       

             
    }
    public static function ExcluirPago($bi,$ano){
        $objeto = new Conexao();
        $conexao = $objeto->Conectar();       
        $query = "UPDATE inscricao SET valores='-1', banco='',codreferencia='',useridpaga='' WHERE bi='$bi' AND ano='$ano'";                
        if(mysqli_query($conexao, $query))
        {
            mysqli_close($conexao);
            return "1";
        }
        else{
            $error = mysqli_error($conexao);
            mysqli_close($conexao);
            return 'Engano: ' . $error;
        }                   
    }

}
?>