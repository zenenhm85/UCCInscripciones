<?php 
    include_once 'conexao.php';
    
    class Municipio {
        function __construct() {            
            
        }
        public static function todos() {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT * FROM municipio";                            
            try{
                $listaUsuarios = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listaUsuarios;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
        }
        public static function todos2($nomep) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT * FROM municipio WHERE nomep='$nomep'";                            
            try{
                $listaUsuarios = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listaUsuarios;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
        }
        public static function Cadastrar($nomep,$nomem) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();  
            $query = "INSERT INTO municipio(nomep,nomem) VALUES('$nomep','$nomem')";                           
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
        public static function Alterar($nomepa,$nomema,$nomep,$nomem) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();  
            $query = "UPDATE municipio SET nomep='$nomep',nomem='$nomem' WHERE nomep='$nomepa' AND nomem='$nomema'";                           
            if(mysqli_query($conexao, $query))
            {
                $query3 = "UPDATE comuna SET nomep='$nomep',nomem='$nomem' WHERE nomep='$nomepa' AND nomem='$nomema'"; 
                if(!mysqli_query($conexao, $query3)){
                    $error = mysqli_error($conexao);
                    mysqli_close($conexao);
                    return 'Engano: ' . $error;                                        
                }       
                return "1";
            }
            else{
                $error = mysqli_error($conexao);
                mysqli_close($conexao);
                return 'Engano: ' . $error;
            }                   
        }
        public static function Excluir($nomep,$nomem) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();  
            $query = "DELETE FROM municipio WHERE nomep='$nomep' AND nomem='$nomem'";                       
            if(mysqli_query($conexao, $query))
            {
                $query3 = "DELETE FROM comuna WHERE nomep='$nomep' AND nomem='$nomem'";  
                if(!mysqli_query($conexao, $query3)){
                    $error = mysqli_error($conexao);
                    mysqli_close($conexao);
                    return 'Engano: ' . $error;                    
                }                
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