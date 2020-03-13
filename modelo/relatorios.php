<?php 
   
    include_once 'conexao.php';
    
    class Relatorios {
        function __construct() {            
            
        }
        public static function InscsimPagar($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();
            

            $query = "SELECT aluno.bi,aluno.nomecompleto,aluno.telefone,aluno.email  FROM aluno INNER JOIN inscricao ON(aluno.bi=inscricao.bi) WHERE valores='-1' AND ano='$ano'";                         
            try{
                $resultado = mysqli_query($conexao, $query);                 
                mysqli_close($conexao);
                return $resultado;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                        
        } 
        public static function TotalDinheiro($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();

            $query = "SELECT SUM(valores) as quant  FROM  inscricao WHERE valores!='-1' AND ano='$ano'";                         
            try{
                $resultado = mysqli_query($conexao, $query); 
                $f = mysqli_fetch_array($resultado);
                mysqli_close($conexao);
                return $f['quant'];
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                        
        } 
        public static function inscricaoporProvincias($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();
          

            $query = "SELECT COUNT(inscricao.bi) as quant,aluno.provincia  FROM  inscricao INNER JOIN aluno ON (inscricao.bi=aluno.bi)   WHERE valores!='-1' AND ano='$ano' GROUP BY aluno.provincia ORDER BY quant DESC";                         
            try{
                $resultado = mysqli_query($conexao, $query); 
                
                mysqli_close($conexao);
                return $resultado;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                        
        } 
        public static function inscricaoporCursos($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();             

            $query = "SELECT COUNT(inscricaocurso.bi) as quant,curso,perido  FROM  inscricaocurso INNER JOIN inscricao ON(inscricaocurso.bi=inscricao.bi) WHERE inscricaocurso.ano = '$ano' AND inscricao.valores!='-1' GROUP BY inscricaocurso.curso, inscricaocurso.perido ORDER BY quant DESC";                         
            try{
                $resultado = mysqli_query($conexao, $query); 
                
                mysqli_close($conexao);
                return $resultado;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                        
        }
        public static function inscricaoporCursosII($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();             

            $query = "SELECT COUNT(inscricaocurso.bi) as quant,curso,perido  FROM  inscricaocurso INNER JOIN inscricao ON(inscricaocurso.bi=inscricao.bi) WHERE inscricaocurso.ano = '$ano' AND inscricaocurso.convocatoria='2' AND inscricao.valores!='-1' GROUP BY inscricaocurso.curso, inscricaocurso.perido ORDER BY quant DESC";                         
            try{
                $resultado = mysqli_query($conexao, $query); 
                
                mysqli_close($conexao);
                return $resultado;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                        
        }
        public static function QuantInscricoesPorUser($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();

            

            $query = "SELECT usuario.nome,usuario.idusuario, COUNT(usuario.idusuario) as quant FROM  usuario INNER JOIN inscricao ON (usuario.idusuario=inscricao.userid) WHERE inscricao.ano = '$ano'  GROUP BY usuario.idusuario ORDER BY quant DESC";                         
            try{
                $lista = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $lista;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                        
        }
        public static function QuantInscricoesPorUserII($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();

            

            $query = "SELECT usuario.nome,usuario.idusuario, COUNT(usuario.idusuario) as quant FROM  usuario INNER JOIN inscricao ON (usuario.idusuario=inscricao.userid2) WHERE inscricao.ano = '$ano'  GROUP BY usuario.idusuario ORDER BY quant DESC";                         
            try{
                $lista = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $lista;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                        
        }  
        public static function QuantCentroProcedencia($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();

           

            $query = "SELECT COUNT(aluno.bi) as quant,aluno.procedencia FROM  aluno INNER JOIN inscricao ON (aluno.bi=inscricao.bi) WHERE inscricao.ano = '$ano' GROUP BY aluno.procedencia ORDER BY quant DESC";                         
            try{
                $lista = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $lista;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                        
        } 
        public static function QuantEnsinoMedio($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();

           

            $query = "SELECT COUNT(aluno.bi) as quant,aluno.cursomedio FROM  aluno INNER JOIN inscricao ON (aluno.bi=inscricao.bi) WHERE inscricao.ano = '$ano' GROUP BY aluno.cursomedio ORDER BY quant DESC";                         
            try{
                $lista = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $lista;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                        
        } 
        public static function QuantInscricoesPorUserporData($data) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();             

            $query = "SELECT usuario.nome,usuario.idusuario, COUNT(usuario.idusuario) as quant FROM  usuario INNER JOIN inscricao ON (usuario.idusuario=inscricao.userid) WHERE CAST(inscricao.data AS date)='$data'  GROUP BY usuario.idusuario ORDER BY quant DESC";                         
            try{
                $lista = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $lista;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                        
        } 
        public static function QuantPagamentosPorUser($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();

            

            $query = "SELECT usuario.nome,usuario.idusuario, COUNT(usuario.idusuario) as quant FROM  usuario INNER JOIN inscricao ON (usuario.idusuario=inscricao.useridpaga) WHERE inscricao.ano = '$ano' AND inscricao.valores!='-1'  GROUP BY usuario.idusuario ORDER BY quant DESC";                         
            try{
                $lista = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $lista;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                        
        }  
        public static function QuantPagamentosInsc($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();

          

            $query1 = "SELECT * FROM inscricao  WHERE inscricao.ano = '$ano' AND inscricao.valores!='-1'";   

            $query2 = "SELECT * FROM  inscricao WHERE inscricao.ano = '$ano'";      

            try{
                $listainsc = mysqli_query($conexao, $query2);
                $listapaga = mysqli_query($conexao, $query1); 

                $quantinsc = $listainsc->num_rows;
                $quantpaga = $listapaga->num_rows;

                $arrayAux= array('quantinsc' =>$quantinsc,'quantpaga'=>$quantpaga);


                mysqli_close($conexao);
                return $arrayAux;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                        
        } 
        public static function QuantPagamentosInscporData($data) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();          

             

            $query2 = "SELECT * FROM  inscricao WHERE CAST(inscricao.data AS date)='$data' ";      

            try{
                $listainsc = mysqli_query($conexao, $query2);
                $quantinsc = $listainsc->num_rows;

                mysqli_close($conexao);
                return $quantinsc;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                        
        } 
        public static function Sexo($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();
            

            $query1 = "SELECT COUNT(inscricao.bi) as masculino FROM inscricao INNER JOIN aluno ON(inscricao.bi = aluno.bi) WHERE aluno.sexo='Masculino' AND ano='$ano'";

            $query2 = "SELECT COUNT(inscricao.bi) as femenino FROM inscricao INNER JOIN aluno ON(inscricao.bi = aluno.bi) WHERE aluno.sexo='Feminino' AND ano='$ano'";    

                

            try{
                $masculino = mysqli_query($conexao, $query1);
                $f = mysqli_fetch_array($masculino);

                $femenino = mysqli_query($conexao, $query2);
                $f2 = mysqli_fetch_array($femenino);

                $total= $f['masculino'] + $f2['femenino'];
                $pormasculino = round(($f['masculino'] * 100 )/$total,2);
                $porfemenino = round(($f2['femenino'] * 100 )/$total,2);           

                $arrayAux= array('masculino' =>$f['masculino'],'femenino'=>$f2['femenino'],'pormasculino' =>$pormasculino,'porfemenino'=>$porfemenino);


                mysqli_close($conexao);
                return $arrayAux;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                                   
        } 
        public static function Trabalhador($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();
           

            $query1 = "SELECT COUNT(inscricao.bi) as sim FROM inscricao INNER JOIN aluno ON(inscricao.bi = aluno.bi) WHERE aluno.trabalhador='Sim' AND ano='$ano'";

            $query2 = "SELECT COUNT(inscricao.bi) as nao FROM inscricao INNER JOIN aluno ON(inscricao.bi = aluno.bi) WHERE aluno.trabalhador='Não' AND ano='$ano'";              

            try{
                $sim = mysqli_query($conexao, $query1);
                $f = mysqli_fetch_array($sim);

                $nao = mysqli_query($conexao, $query2);
                $f2 = mysqli_fetch_array($nao);

                $total= $f['sim'] + $f2['nao'];
                $porsim = round(($f['sim'] * 100 )/$total,2);
                $pornao = round(($f2['nao'] * 100 )/$total,2);           

                $arrayAux= array('sim' =>$f['sim'],'nao'=>$f2['nao'],'porsim' =>$porsim,'pornao'=>$pornao);


                mysqli_close($conexao);
                return $arrayAux;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                                   
        }   
        public static function ResultadosI($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();
           

            $query1 = "SELECT COUNT(bi) as aprovados FROM inscricaocurso WHERE nota1 >= 10 AND ano='$ano'";

            $query2 = "SELECT COUNT(bi) as reprovados FROM inscricaocurso WHERE nota1 !='-1'  AND nota1  < 10 AND ano='$ano'";             

            try{
                $aprovados = mysqli_query($conexao, $query1);
                $f = mysqli_fetch_array($aprovados);

                $reprovados = mysqli_query($conexao, $query2);
                $f2 = mysqli_fetch_array($reprovados);

                $total= $f['aprovados'] + $f2['reprovados'];
                $poraprovados = round(($f['aprovados'] * 100 )/$total,2);
                $porreprovados = round(($f2['reprovados'] * 100 )/$total,2);           

                $arrayAux= array('aprovados' =>$f['aprovados'],'reprovados'=>$f2['reprovados'],'poraprovados' =>$poraprovados,'porreprovados'=>$porreprovados);


                mysqli_close($conexao);
                return $arrayAux;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                                   
        } 
        public static function ResultadosProcedenciaI($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();

            $query3 = "SELECT * FROM escolar";

            $procedenciaescolar = mysqli_query($conexao, $query3);                                

            try{
                $array = array();
                $i = 0;

                 while ($f3 = mysqli_fetch_array($procedenciaescolar)) 
                {
                    $procedencia = $f3['nome'];

                    $query1 = "SELECT COUNT(inscricaocurso.bi) as aprovados,aluno.procedencia FROM inscricaocurso INNER JOIN aluno ON(aluno.bi=inscricaocurso.bi) WHERE inscricaocurso.nota1 >= 10 AND ano='$ano' AND aluno.procedencia='$procedencia'" ;

                    $aprovados = mysqli_query($conexao, $query1);

                    $query2 = "SELECT COUNT(inscricaocurso.bi) as reprovados FROM inscricaocurso INNER JOIN aluno ON(aluno.bi=inscricaocurso.bi) WHERE inscricaocurso.nota1 < 10 AND inscricaocurso.nota1!= '-1' AND ano='$ano' AND aluno.procedencia='$procedencia'"; 
                    
                    $reprovados = mysqli_query($conexao, $query2); 

                    $f = mysqli_fetch_array($aprovados);                    
                    $f2 = mysqli_fetch_array($reprovados);

                    if($f['aprovados'] > 0 || $f2['reprovados'] > 0){
                        $arrayAux= array('procedencia' =>$procedencia,'aprovados'=>$f['aprovados'],'reprovados' =>$f2['reprovados'],'poraprovados'=>round(($f['aprovados']*100)/($f['aprovados']+$f2['reprovados']),2),'porreprovados'=>round(($f2['reprovados']*100)/($f['aprovados']+$f2['reprovados']),2));

                        $array[$i] = $arrayAux;
                        $i++;
                    }
                    
                }
                mysqli_close($conexao);
                return $array;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                                   
        } 
        public static function ResultadosProcedenciaII($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();
           

            $query1 = "SELECT COUNT(inscricaocurso.bi) as aprovados,aluno.procedencia FROM inscricaocurso INNER JOIN aluno ON(aluno.bi=inscricaocurso.bi) WHERE inscricaocurso.convocatoria='2' AND inscricaocurso.nota2 >= 10 AND ano='$ano' GROUP BY aluno.procedencia" ;

            $aprovados = mysqli_query($conexao, $query1);                    

            try{
                $array = array();
                $i = 0;

                 while ($f = mysqli_fetch_array($aprovados)) 
                {
                    $procedencia = $f['procedencia'];

                    $query2 = "SELECT COUNT(inscricaocurso.bi) as reprovados FROM inscricaocurso INNER JOIN aluno ON(aluno.bi=inscricaocurso.bi) WHERE inscricaocurso.convocatoria='2' AND inscricaocurso.nota2 < 10 AND inscricaocurso.nota2!= '-1' AND ano='$ano' AND aluno.procedencia='$procedencia'"; 
                    
                    $reprovados = mysqli_query($conexao, $query2); 
                    
                    $f2 = mysqli_fetch_array($reprovados);

                    if($f['aprovados'] > 0 || $f2['reprovados'] > 0){
                        $arrayAux= array('procedencia' =>$procedencia,'aprovados'=>$f['aprovados'],'reprovados' =>$f2['reprovados'],'poraprovados'=>round(($f['aprovados']*100)/($f['aprovados']+$f2['reprovados']),2),'porreprovados'=>round(($f2['reprovados']*100)/($f['aprovados']+$f2['reprovados']),2));

                        $array[$i] = $arrayAux;
                        $i++;
                    }
                    
                }
                mysqli_close($conexao);
                return $array;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                                   
        } 
        public static function ResultadosProcedenciaCursoI($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();

            $query3 = "SELECT * FROM cursomedio";

            $procedenciaescolar = mysqli_query($conexao, $query3);                                

            try{
                $array = array();
                $i = 0;

                 while ($f3 = mysqli_fetch_array($procedenciaescolar)) 
                {
                    $procedencia = $f3['nome'];

                    $query1 = "SELECT COUNT(inscricaocurso.bi) as aprovados FROM inscricaocurso INNER JOIN aluno ON(aluno.bi=inscricaocurso.bi) WHERE inscricaocurso.nota1 >= 10 AND ano='$ano' AND aluno.cursomedio='$procedencia'" ;

                    $aprovados = mysqli_query($conexao, $query1);

                    $query2 = "SELECT COUNT(inscricaocurso.bi) as reprovados FROM inscricaocurso INNER JOIN aluno ON(aluno.bi=inscricaocurso.bi) WHERE inscricaocurso.nota1 < 10 AND inscricaocurso.nota1!= '-1' AND ano='$ano' AND aluno.cursomedio='$procedencia'"; 
                    
                    $reprovados = mysqli_query($conexao, $query2); 

                    $f = mysqli_fetch_array($aprovados);                    
                    $f2 = mysqli_fetch_array($reprovados);

                    if($f['aprovados'] > 0 || $f2['reprovados'] > 0){
                        $arrayAux= array('procedencia' =>$procedencia,'aprovados'=>$f['aprovados'],'reprovados' =>$f2['reprovados'],'poraprovados'=>round(($f['aprovados']*100)/($f['aprovados']+$f2['reprovados']),2),'porreprovados'=>round(($f2['reprovados']*100)/($f['aprovados']+$f2['reprovados']),2));

                        $array[$i] = $arrayAux;
                        $i++;
                    }
                    
                }
                mysqli_close($conexao);
                return $array;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                                   
        }
        public static function ResultadosProcedenciaProvinciaI($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();

            $query3 = "SELECT * FROM provincia";

            $procedenciaescolar = mysqli_query($conexao, $query3);                                

            try{
                $array = array();
                $i = 0;

                 while ($f3 = mysqli_fetch_array($procedenciaescolar)) 
                {
                    $procedencia = $f3['nome'];

                    $query1 = "SELECT COUNT(inscricaocurso.bi) as aprovados FROM inscricaocurso INNER JOIN aluno ON(aluno.bi=inscricaocurso.bi) WHERE inscricaocurso.nota1 >= 10 AND ano='$ano' AND aluno.provincia='$procedencia'" ;

                    $aprovados = mysqli_query($conexao, $query1);

                    $query2 = "SELECT COUNT(inscricaocurso.bi) as reprovados FROM inscricaocurso INNER JOIN aluno ON(aluno.bi=inscricaocurso.bi) WHERE inscricaocurso.nota1 < 10 AND inscricaocurso.nota1!= '-1' AND ano='$ano' AND aluno.provincia='$procedencia'"; 
                    
                    $reprovados = mysqli_query($conexao, $query2); 

                    $f = mysqli_fetch_array($aprovados);                    
                    $f2 = mysqli_fetch_array($reprovados);

                    if($f['aprovados'] > 0 || $f2['reprovados'] > 0){
                        $arrayAux= array('provincia' =>$procedencia,'aprovados'=>$f['aprovados'],'reprovados' =>$f2['reprovados'],'poraprovados'=>round(($f['aprovados']*100)/($f['aprovados']+$f2['reprovados']),2),'porreprovados'=>round(($f2['reprovados']*100)/($f['aprovados']+$f2['reprovados']),2));

                        $array[$i] = $arrayAux;
                        $i++;
                    }
                    
                }
                mysqli_close($conexao);
                return $array;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                                   
        }
        public static function ResultadosProcedenciaProvinciaII($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();

            $query3 = "SELECT * FROM provincia";

            $procedenciaescolar = mysqli_query($conexao, $query3);                                

            try{
                $array = array();
                $i = 0;

                 while ($f3 = mysqli_fetch_array($procedenciaescolar)) 
                {
                    $procedencia = $f3['nome'];

                    $query1 = "SELECT COUNT(inscricaocurso.bi) as aprovados FROM inscricaocurso INNER JOIN aluno ON(aluno.bi=inscricaocurso.bi) WHERE inscricaocurso.nota2 >= 10 AND inscricaocurso.convocatoria='2' AND ano='$ano' AND aluno.provincia='$procedencia'" ;

                    $aprovados = mysqli_query($conexao, $query1);

                    $query2 = "SELECT COUNT(inscricaocurso.bi) as reprovados FROM inscricaocurso INNER JOIN aluno ON(aluno.bi=inscricaocurso.bi) WHERE inscricaocurso.nota1 < 10 AND inscricaocurso.nota1!= '-1' AND ano='$ano' AND inscricaocurso.convocatoria='2' AND aluno.provincia='$procedencia'"; 
                    
                    $reprovados = mysqli_query($conexao, $query2); 

                    $f = mysqli_fetch_array($aprovados);                    
                    $f2 = mysqli_fetch_array($reprovados);

                    if($f['aprovados'] > 0 || $f2['reprovados'] > 0){
                        $arrayAux= array('provincia' =>$procedencia,'aprovados'=>$f['aprovados'],'reprovados' =>$f2['reprovados'],'poraprovados'=>round(($f['aprovados']*100)/($f['aprovados']+$f2['reprovados']),2),'porreprovados'=>round(($f2['reprovados']*100)/($f['aprovados']+$f2['reprovados']),2));

                        $array[$i] = $arrayAux;
                        $i++;
                    }
                    
                }
                mysqli_close($conexao);
                return $array;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                                   
        }
        public static function ResultadosProcedenciaCursoII($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();

            $query3 = "SELECT * FROM cursomedio";

            $procedenciaescolar = mysqli_query($conexao, $query3);                                

            try{
                $array = array();
                $i = 0;

                 while ($f3 = mysqli_fetch_array($procedenciaescolar)) 
                {
                    $procedencia = $f3['nome'];

                    $query1 = "SELECT COUNT(inscricaocurso.bi) as aprovados FROM inscricaocurso INNER JOIN aluno ON(aluno.bi=inscricaocurso.bi) WHERE inscricaocurso.nota2 >= 10 AND inscricaocurso.convocatoria='2' AND ano='$ano' AND aluno.cursomedio='$procedencia'" ;

                    $aprovados = mysqli_query($conexao, $query1);

                    $query2 = "SELECT COUNT(inscricaocurso.bi) as reprovados FROM inscricaocurso INNER JOIN aluno ON(aluno.bi=inscricaocurso.bi) WHERE inscricaocurso.nota2 < 10 AND inscricaocurso.nota2!= '-1' AND ano='$ano' AND inscricaocurso.convocatoria='2' AND aluno.cursomedio='$procedencia'"; 
                    
                    $reprovados = mysqli_query($conexao, $query2); 

                    $f = mysqli_fetch_array($aprovados);                    
                    $f2 = mysqli_fetch_array($reprovados);

                    if($f['aprovados'] > 0 || $f2['reprovados'] > 0){
                        $arrayAux= array('procedencia' =>$procedencia,'aprovados'=>$f['aprovados'],'reprovados' =>$f2['reprovados'],'poraprovados'=>round(($f['aprovados']*100)/($f['aprovados']+$f2['reprovados']),2),'porreprovados'=>round(($f2['reprovados']*100)/($f['aprovados']+$f2['reprovados']),2));

                        $array[$i] = $arrayAux;
                        $i++;
                    }
                    
                }
                mysqli_close($conexao);
                return $array;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                                   
        } 
        public static function ResultadosII($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();
           

            $query1 = "SELECT COUNT(bi) as aprovados FROM inscricaocurso WHERE nota2 >= 10 AND ano='$ano'";

            $query2 = "SELECT COUNT(bi) as reprovados FROM inscricaocurso WHERE nota2 !='-1'  AND nota2  < 10 AND ano='$ano'";             

            try{
                $aprovados = mysqli_query($conexao, $query1);
                $f = mysqli_fetch_array($aprovados);

                $reprovados = mysqli_query($conexao, $query2);
                $f2 = mysqli_fetch_array($reprovados);

                $total= $f['aprovados'] + $f2['reprovados'];
                $poraprovados = round(($f['aprovados'] * 100 )/$total,2);
                $porreprovados = round(($f2['reprovados'] * 100 )/$total,2);           

                $arrayAux= array('aprovados' =>$f['aprovados'],'reprovados'=>$f2['reprovados'],'poraprovados' =>$poraprovados,'porreprovados'=>$porreprovados);


                mysqli_close($conexao);
                return $arrayAux;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                                   
        } 
        public static function ResultadosCentroProcedenciaAVG($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();

           

            $query = "SELECT ROUND(AVG(inscricaocurso.nota1),2)  as media,aluno.procedencia FROM  aluno INNER JOIN inscricaocurso ON (aluno.bi=inscricaocurso.bi) WHERE inscricaocurso.ano = '$ano' AND inscricaocurso.nota1!='-1' GROUP BY aluno.procedencia ORDER BY media DESC";                         
            try{
                $lista = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $lista;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                                      
        }           
        public static function ResultadosCentroProcedenciaAVGII($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();

           

            $query = "SELECT ROUND(AVG(inscricaocurso.nota2),2)  as media,aluno.procedencia FROM  aluno INNER JOIN inscricaocurso ON (aluno.bi=inscricaocurso.bi) WHERE inscricaocurso.ano = '$ano' AND inscricaocurso.nota2!='-1' GROUP BY aluno.procedencia ORDER BY media DESC";                         
            try{
                $lista = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $lista;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                                      
        }
        public static function ResultadosporCursosdeProcedenciaAVG($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();           

            $query = "SELECT ROUND(AVG(inscricaocurso.nota1),2)  as media,aluno.cursomedio FROM  aluno INNER JOIN inscricaocurso ON (aluno.bi=inscricaocurso.bi) WHERE inscricaocurso.ano = '$ano' AND inscricaocurso.nota1!='-1' GROUP BY aluno.cursomedio ORDER BY media DESC";                         
            try{
                $lista = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $lista;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                                      
        }        
        public static function ResultadosporCursosdeProcedenciaAVGII($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();           

            $query = "SELECT ROUND(AVG(inscricaocurso.nota2),2)  as media,aluno.cursomedio FROM  aluno INNER JOIN inscricaocurso ON (aluno.bi=inscricaocurso.bi) WHERE inscricaocurso.ano = '$ano' AND inscricaocurso.nota2!='-1' AND inscricaocurso.convocatoria='2' GROUP BY aluno.cursomedio ORDER BY media DESC";                         
            try{
                $lista = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $lista;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                                      
        }  
        public static function ResultadosProvinciasAVG($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();          

            $query = "SELECT ROUND(AVG(inscricaocurso.nota1),2)  as media,aluno.provincia FROM  aluno INNER JOIN inscricaocurso ON (aluno.bi=inscricaocurso.bi) WHERE inscricaocurso.ano = '$ano' AND inscricaocurso.nota1!='-1' GROUP BY aluno.provincia ORDER BY media DESC";                         
            try{
                $lista = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $lista;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                                      
        }
        public static function ResultadosProvinciasAVGII($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();          

            $query = "SELECT ROUND(AVG(inscricaocurso.nota2),2)  as media,aluno.provincia FROM  aluno INNER JOIN inscricaocurso ON (aluno.bi=inscricaocurso.bi) WHERE inscricaocurso.ano = '$ano' AND inscricaocurso.convocatoria='2' AND inscricaocurso.nota2!='-1' GROUP BY aluno.provincia ORDER BY media DESC";                         
            try{
                $lista = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $lista;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                                      
        }                     
        public static function SexoPorCursos($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();

            $array = array();
            $i = 0;

            $query = "SELECT * FROM curso";                            
            try{
                $listacursos = mysqli_query($conexao, $query); 
                
                while ($f = mysqli_fetch_array($listacursos)) 
                {
                    $cursoaux = $f['nome'];
                    $query2 = "SELECT COUNT(inscricaocurso.bi) as quant FROM  aluno INNER JOIN inscricaocurso ON (aluno.bi=inscricaocurso.bi) WHERE inscricaocurso.ano = '$ano' AND aluno.sexo='Masculino' AND  inscricaocurso.curso='$cursoaux'"; 

                    $query3 = "SELECT COUNT(inscricaocurso.bi) as quant FROM  aluno INNER JOIN inscricaocurso ON (aluno.bi=inscricaocurso.bi) WHERE inscricaocurso.ano = '$ano' AND aluno.sexo='Feminino' AND  inscricaocurso.curso='$cursoaux'";
                    
                    $quantmasculimo = mysqli_query($conexao, $query2); 
                    $quantfeminino= mysqli_query($conexao, $query3); 
                    $f2 = mysqli_fetch_array($quantmasculimo);
                    $f3 = mysqli_fetch_array($quantfeminino);

                    if($f2['quant'] > 0 || $f3['quant'] > 0){
                        $arrayAux= array('curso' =>$f['nome'],'masculino'=>$f2['quant'],'feminino' =>$f3['quant'],'pormasculino'=>round(($f2['quant']*100)/($f2['quant']+$f3['quant']),2),'porfemenino'=>round(($f3['quant']*100)/($f2['quant']+$f3['quant']),2));

                        $array[$i] = $arrayAux;
                        $i++;
                    }

                    
                }
                return $array;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                                                         
        }
        public static function AprovadosPorCursos($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();

            $array = array();
            $i = 0;

            $query = "SELECT * FROM curso";                            
            try{
                $listacursos = mysqli_query($conexao, $query); 
                
                while ($f = mysqli_fetch_array($listacursos)) 
                {
                    $cursoaux = $f['nome'];
                    $query2 = "SELECT COUNT(bi) as quant FROM inscricaocurso  WHERE inscricaocurso.ano = '$ano' AND inscricaocurso.nota1 >= 10 AND  inscricaocurso.curso='$cursoaux'"; 

                    $query3 = "SELECT COUNT(bi) as quant FROM inscricaocurso  WHERE inscricaocurso.ano = '$ano' AND inscricaocurso.nota1 < 10 AND inscricaocurso.nota1 >=0 AND  inscricaocurso.curso='$cursoaux'"; 
                    
                    $quantaprovado = mysqli_query($conexao, $query2); 
                    $quantreprovados= mysqli_query($conexao, $query3); 
                    $f2 = mysqli_fetch_array($quantaprovado);
                    $f3 = mysqli_fetch_array($quantreprovados);

                    if($f2['quant'] > 0 || $f3['quant'] > 0){
                        $arrayAux= array('curso' =>$cursoaux,'aprovados'=>$f2['quant'],'reprovados' =>$f3['quant'],'poraprovados'=>round(($f2['quant']*100)/($f2['quant']+$f3['quant']),2),'porreprovados'=>round(($f3['quant']*100)/($f2['quant']+$f3['quant']),2));

                        $array[$i] = $arrayAux;
                        $i++;
                    }

                    
                }
                return $array;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                                                         
        } 
        public static function AprovadosPorCursosII($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();

            $array = array();
            $i = 0;

            $query = "SELECT * FROM curso";                            
            try{
                $listacursos = mysqli_query($conexao, $query); 
                
                while ($f = mysqli_fetch_array($listacursos)) 
                {
                    $cursoaux = $f['nome'];
                    $query2 = "SELECT COUNT(bi) as quant FROM inscricaocurso  WHERE inscricaocurso.ano = '$ano' AND inscricaocurso.nota2 >= 10 AND inscricaocurso.convocatoria='2' AND  inscricaocurso.curso='$cursoaux'"; 

                    $query3 = "SELECT COUNT(bi) as quant FROM inscricaocurso  WHERE inscricaocurso.ano = '$ano' AND inscricaocurso.nota2 < 10 AND inscricaocurso.nota2 >=0 AND inscricaocurso.convocatoria='2' AND  inscricaocurso.curso='$cursoaux'"; 
                    
                    $quantaprovado = mysqli_query($conexao, $query2); 
                    $quantreprovados= mysqli_query($conexao, $query3); 
                    $f2 = mysqli_fetch_array($quantaprovado);
                    $f3 = mysqli_fetch_array($quantreprovados);

                    if($f2['quant'] > 0 || $f3['quant'] > 0){
                        $arrayAux= array('curso' =>$cursoaux,'aprovados'=>$f2['quant'],'reprovados' =>$f3['quant'],'poraprovados'=>round(($f2['quant']*100)/($f2['quant']+$f3['quant']),2),'porreprovados'=>round(($f3['quant']*100)/($f2['quant']+$f3['quant']),2));

                        $array[$i] = $arrayAux;
                        $i++;
                    }

                    
                }
                return $array;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                                                         
        } 
        public static function ResultadosporCursoAVG($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();           

            $query = "SELECT ROUND(AVG(inscricaocurso.nota1),2)  as media,inscricaocurso.curso FROM  inscricaocurso  WHERE inscricaocurso.ano = '$ano' AND inscricaocurso.nota1!='-1' GROUP BY inscricaocurso.curso ORDER BY media DESC";                         
            try{
                $lista = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $lista;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                                      
        }          
        public static function ResultadosporCursoAVGII($ano) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();           

            $query = "SELECT ROUND(AVG(inscricaocurso.nota2),2)  as media,inscricaocurso.curso FROM  inscricaocurso  WHERE inscricaocurso.ano = '$ano' AND inscricaocurso.nota2!='-1' GROUP BY inscricaocurso.curso ORDER BY media DESC";                         
            try{
                $lista = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $lista;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                                      
        }                                                    
        
    }
?>