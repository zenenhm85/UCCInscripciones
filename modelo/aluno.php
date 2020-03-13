<?php 
   
    include_once 'conexao.php';
    
    class Aluno {
        function __construct() {            
            
        }
        public static function todos() {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT * FROM aluno";                            
            try{
                $listaAlunos = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listaAlunos;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
        }
        public static function listarUltimos25($userid) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT * FROM aluno WHERE userid='$userid' ORDER BY codigo DESC LIMIT 25";                            
            try{
                $listaAlunos = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listaAlunos;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
        }
        public static function listarPorBI($bi) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT * FROM aluno WHERE bi LIKE '$bi%' ORDER BY codigo DESC LIMIT 5";                            
            try{
                $listaAlunos = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listaAlunos;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
        }
        public static function todosporMunicipioeProv($nomep,$nomem) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT * FROM aluno WHERE provincia='$nomep' AND municipio='$nomem'";                            
            try{
                $listaAlunos = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listaAlunos;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
        }
        public static function todosporProvincias($nomep) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT * FROM aluno WHERE provincia='$nomep'";                            
            try{
                $listaAlunos = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listaAlunos;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
        }
         public static function todosporComunas($nomep,$nomem,$nomecomuna) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT * FROM aluno WHERE provincia='$nomep' AND municipio='$nomem' AND comuna='$nomecomuna'";                            
            try{
                $listaAlunos = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listaAlunos;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
        }
        public static function listarNM($indice,$quant) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT * FROM aluno LIMIT $indice,$quant";                            
            try{
                $listaAlunos = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listaAlunos;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
        }        
        public static function Cadastrar($bi,$datanasc,$nomecompleto,$comuna,$municipio,$provincia,$endereco,$sexo,$telefone,$email,$obs,$procedencia,$cursomedio,$trabalhador,$userid) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();           

            $query = "INSERT INTO aluno(bi,datanasc,nomecompleto,comuna,municipio,provincia,endereco,sexo,telefone,email,obs,procedencia,cursomedio,trabalhador,userid) VALUES('$bi','$datanasc','$nomecompleto','$comuna','$municipio','$provincia','$endereco','$sexo','$telefone','$email','$obs','$procedencia','$cursomedio','$trabalhador','$userid')";                           
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
        public static function Alterar($bia,$bi,$datanasc,$nomecompleto,$comuna,$municipio,$provincia,$endereco,$sexo,$telefone,$email,$obs,$procedencia,$cursomedio,$trabalhador,$userid) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();  
            $query = "UPDATE aluno SET bi='$bi',datanasc='$datanasc',nomecompleto='$nomecompleto',comuna='$comuna',municipio='$municipio',provincia='$provincia',endereco='$endereco',sexo='$sexo',telefone='$telefone',email='$email', obs='$obs',procedencia='$procedencia',cursomedio='$cursomedio',trabalhador='$trabalhador',userid='$userid'  WHERE bi='$bia'";                           
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
        public static function Excluir($bi) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();  
            $query = "DELETE FROM aluno WHERE bi='$bi'";              
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