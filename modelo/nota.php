<?php 
    include_once 'conexao.php';
    
    class Nota {
        function __construct() {            
            
        }
        public static function Cadastrar1($bi,$ano,$curso,$perido,$nota1,$usernota1) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 

            $query2 = "SELECT * FROM inscricaocurso WHERE ano='$ano' AND curso='$curso' AND perido='$perido' AND bi ='$bi'";

            try{
                $lista = mysqli_query($conexao, $query2);
                if($lista->num_rows == 0){
                    mysqli_close($conexao);
                    return "0";                    
                }
                else{
                    $f = mysqli_fetch_array($lista);
                    if($f['nota1'] !="-1"){
                        mysqli_close($conexao);
                        return "2";                        
                    }
                    else{
                        $query = "UPDATE inscricaocurso SET nota1='$nota1',notafinal='$nota1',usernota1='$usernota1' WHERE ano='$ano' AND curso='$curso' AND perido='$perido' AND bi='$bi'"; 

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
                   
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }   
        }
        public static function Cadastrar2($bi,$ano,$curso,$perido,$nota2,$usernota2) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 

            $query2 = "SELECT * FROM inscricaocurso WHERE convocatoria ='2' AND ano='$ano' AND curso='$curso' AND perido='$perido' AND bi ='$bi'";

            try{
                $lista = mysqli_query($conexao, $query2);
                if($lista->num_rows == 0){
                    mysqli_close($conexao);
                    return "0";                    
                }
                else{
                    $f = mysqli_fetch_array($lista);
                    if($f['nota2'] !="-1"){
                        mysqli_close($conexao);
                        return "2";                        
                    }
                    else{
                        $query = "UPDATE inscricaocurso SET nota2='$nota2',notafinal='$nota2',usernota2='$usernota2' WHERE ano='$ano' AND curso='$curso' AND perido='$perido' AND bi='$bi'"; 

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
                   
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }   
        }
        public static function Alterar($bi,$ano,$curso,$perido,$nota1,$usernota1) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();

            $query = "UPDATE inscricaocurso SET nota1='$nota1',notafinal='$nota1',usernota1='$usernota1' WHERE ano='$ano' AND curso='$curso' AND perido='$perido' AND bi='$bi'"; 

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
        public static function Alterar2($bi,$ano,$curso,$perido,$nota2,$usernota2) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();

            $query = "UPDATE inscricaocurso SET nota2='$nota2',notafinal='$nota2',usernota2='$usernota2' WHERE ano='$ano' AND curso='$curso' AND perido='$perido' AND bi='$bi'"; 

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
        public static function Excluir($bi,$ano,$curso,$perido) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();  
            
            $query = "UPDATE inscricaocurso SET nota1='-1',notafinal='-1',usernota1='' WHERE ano='$ano' AND curso='$curso' AND perido='$perido' AND bi='$bi'"; 

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
        public static function Excluir2($bi,$ano,$curso,$perido) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();  
            
            $query = "UPDATE inscricaocurso SET nota2='-1',notafinal=nota1,usernota2='' WHERE ano='$ano' AND curso='$curso' AND perido='$perido' AND bi='$bi'"; 

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
        public static function todos($ano,$curso,$perido,$usernota1) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT inscricaocurso.bi,inscricaocurso.nota,inscricaocurso.usernota1,aluno.nomecompleto FROM inscricaocurso INNER JOIN aluno ON(inscricaocurso.bi=aluno.bi) WHERE  inscricaocurso.ano='$ano' AND inscricaocurso.curso='$curso' AND inscricaocurso.perido='$perido' AND inscricaocurso.usernota1='$usernota1' AND inscricaocurso.nota!='-1'";                            
            try{
                $listanotas = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listanotas;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
        }
        public static function AnoCursoPeriodo($ano,$curso,$perido,$usernota1) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT * FROM inscricaocurso WHERE  ano='$ano' AND curso='$curso' AND perido='$perido' AND usernota1='$usernota1' AND nota1 !='-1' LIMIT 25";                            
            try{
                $listanotas = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listanotas;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
        }
        public static function AnoCursoPeriodo2($ano,$curso,$perido,$usernota2) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT * FROM inscricaocurso WHERE  ano='$ano' AND curso='$curso' AND perido='$perido' AND usernota2='$usernota2' AND nota2 !='-1' AND convocatoria='2' LIMIT 25";                            
            try{
                $listanotas = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listanotas;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
        }
        public static function AnoCursoPeriodoPublicar($ano,$curso,$perido) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT aluno.bi, inscricaocurso.nota1,aluno.nomecompleto,inscricaocurso.admitido FROM inscricaocurso INNER JOIN aluno ON(aluno.bi=inscricaocurso.bi) WHERE nota1!='-1' AND ano='$ano' AND curso='$curso' AND perido='$perido' ORDER BY inscricaocurso.nota1 DESC";                            
            try{
                $listanotas = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listanotas;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
        }
        public static function AnoCursoPeriodoPublicar2($ano,$curso,$perido) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT aluno.bi, inscricaocurso.nota2,aluno.nomecompleto,inscricaocurso.admitido FROM inscricaocurso INNER JOIN aluno ON(aluno.bi=inscricaocurso.bi) WHERE nota2!='-1' AND ano='$ano' AND curso='$curso' AND perido='$perido' ORDER BY inscricaocurso.nota2 DESC";                            
            try{
                $listanotas = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listanotas;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
        }
        public static function AnoCursoPeriodoPublicarAdmitidos($ano,$curso,$perido) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT aluno.bi, inscricaocurso.notafinal,aluno.nomecompleto,inscricaocurso.admitido,inscricaocurso.convocatoria FROM inscricaocurso INNER JOIN aluno ON(aluno.bi=inscricaocurso.bi) WHERE inscricaocurso.admitido='1' AND ano='$ano' AND curso='$curso' AND perido='$perido' ORDER BY inscricaocurso.notafinal DESC";                           
            try{
                $listanotas = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listanotas;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
        }
        public static function AnoCursoPeriodoPublicarPautaGeral($ano,$curso,$perido) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT aluno.bi, inscricaocurso.notafinal,aluno.nomecompleto,inscricaocurso.admitido,inscricaocurso.convocatoria FROM inscricaocurso INNER JOIN aluno ON(aluno.bi=inscricaocurso.bi) WHERE ano='$ano' AND curso='$curso' AND perido='$perido' AND inscricaocurso.notafinal>=0 ORDER BY inscricaocurso.notafinal DESC";                           
            try{
                $listanotas = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listanotas;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
        }
        public static function Admitir($bi,$valor,$ano,$curso,$perido) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();  
            
            $query = "UPDATE inscricaocurso SET admitido='$valor' WHERE ano='$ano' AND curso='$curso' AND perido='$perido' AND bi='$bi'"; 

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
        public static function ProcurarPorBI($ano,$curso,$perido,$bi) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT * FROM inscricaocurso WHERE  ano='$ano' AND curso='$curso' AND perido='$perido' AND bi LIKE '$bi%' ORDER BY nota1 DESC LIMIT 5";                            
            try{
                $listanotas = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listanotas;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
        }
        public static function ProcurarPorBI2($ano,$curso,$perido,$bi) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT * FROM inscricaocurso WHERE convocatoria ='2' AND ano='$ano' AND curso='$curso' AND perido='$perido' AND bi LIKE '$bi%' ORDER BY nota2 DESC LIMIT 5";                            
            try{
                $listanotas = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listanotas;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
        }
       
    }
?>