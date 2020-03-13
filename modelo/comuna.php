<?php 
    include_once 'conexao.php';
    
    class Comuna {
        function __construct() {            
            
        }
        public static function todas() {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT * FROM comuna";                            
            try{
                $listaComunas = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listaComunas;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
        }
        public static function todasporMunicipioeProv($nomep,$nomem) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT * FROM comuna WHERE nomep='$nomep' AND nomem='$nomem'";                            
            try{
                $listaComunas = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listaComunas;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
        }
        public static function Cadastrar($nomep,$nomem,$nomecomuna) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();  
            $query = "INSERT INTO comuna(nomep,nomem,nomecomuna) VALUES('$nomep','$nomem','$nomecomuna')";                           
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
        public static function Alterar($nomepa,$nomema,$nomecomunaa,$nomep,$nomem,$nomecomuna) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();  
            $query = "UPDATE comuna SET nomecomuna='$nomecomuna',nomem='$nomem',nomep='$nomep' WHERE nomep='$nomepa' AND nomem='$nomema' AND nomecomuna='$nomecomunaa'";                           
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
        public static function Excluir($nomep,$nomem,$nomecomuna) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();  
            $query = "DELETE FROM comuna WHERE nomep='$nomep' AND nomem='$nomem' AND nomecomuna='$nomecomuna'";              
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