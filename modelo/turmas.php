<?php 
    include_once 'conexao.php';
    
    class Turma {
        function __construct() {            
            
        }
        public static function Turma($curso,$ano,$pos,$quant,$perido) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT aluno.bi,aluno.nomecompleto FROM aluno INNER JOIN inscricaocurso ON (aluno.bi=inscricaocurso.bi) INNER JOIN inscricao ON(inscricaocurso.bi=inscricao.bi) WHERE inscricaocurso.ano='$ano' AND inscricaocurso.curso='$curso' AND inscricaocurso.perido = '$perido' AND inscricao.valores!='-1' ORDER BY aluno.nomecompleto LIMIT $pos,$quant";

            try{
                $listaAlunos = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listaAlunos;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
        }
        public static function Turma2($curso,$ano,$pos,$quant,$perido) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT aluno.bi,aluno.nomecompleto FROM aluno INNER JOIN inscricaocurso ON (aluno.bi=inscricaocurso.bi) INNER JOIN inscricao ON(inscricaocurso.bi=inscricao.bi) WHERE inscricaocurso.ano='$ano' AND inscricaocurso.curso='$curso' AND inscricaocurso.perido = '$perido' AND inscricaocurso.convocatoria = '2'  AND inscricao.valores!='-1' ORDER BY aluno.nomecompleto LIMIT $pos,$quant";

            try{
                $listaAlunos = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listaAlunos;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
        }
        public static function QuantPorCurso($curso,$ano,$perido) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 

            $query = "SELECT COUNT(DISTINCT inscricaocurso.bi) as quantidade FROM inscricaocurso INNER JOIN inscricao ON(inscricaocurso.bi=inscricao.bi) WHERE inscricaocurso.curso = '$curso' AND inscricaocurso.ano='$ano' AND inscricaocurso.perido='$perido' AND inscricao.valores!='-1'";              
            try{
                $resultado = mysqli_query($conexao, $query); 
                $f = mysqli_fetch_array($resultado);
                mysqli_close($conexao);
                return $f['quantidade'];
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
        }
        public static function QuantPorCurso2($curso,$ano,$perido) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 

            $query = "SELECT COUNT(DISTINCT inscricaocurso.bi) as quantidade FROM inscricaocurso INNER JOIN inscricao ON(inscricaocurso.bi=inscricao.bi) WHERE inscricaocurso.curso = '$curso' AND inscricaocurso.ano='$ano' AND inscricaocurso.perido='$perido' AND inscricao.valores!='-1' AND inscricaocurso.convocatoria = '2'";              
            try{
                $resultado = mysqli_query($conexao, $query); 
                $f = mysqli_fetch_array($resultado);
                mysqli_close($conexao);
                return $f['quantidade'];
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
        }
        public static function CursoCompleto($curso,$ano,$perido) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT aluno.bi,aluno.nomecompleto FROM aluno INNER JOIN inscricaocurso ON (aluno.bi=inscricaocurso.bi) INNER JOIN inscricao ON(inscricaocurso.bi=inscricao.bi) WHERE inscricaocurso.ano='$ano' AND inscricaocurso.curso='$curso' AND inscricaocurso.perido = '$perido' AND inscricao.valores!='-1' ORDER BY aluno.nomecompleto";

            try{
                $listaAlunos = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listaAlunos;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
        }
         public static function CursoCompleto2($curso,$ano,$perido) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT aluno.bi,aluno.nomecompleto FROM aluno INNER JOIN inscricaocurso ON (aluno.bi=inscricaocurso.bi) INNER JOIN inscricao ON(inscricaocurso.bi=inscricao.bi) WHERE inscricaocurso.ano='$ano' AND inscricaocurso.curso='$curso' AND inscricaocurso.perido = '$perido' AND inscricao.valores!='-1'   AND inscricaocurso.convocatoria = '2' ORDER BY aluno.nomecompleto";

            try{
                $listaAlunos = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listaAlunos;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
        }
       
    }
?>