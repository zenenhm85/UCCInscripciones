<?php 
    include_once 'conexao.php';
    
    class Provincia {
        function __construct() {            
            
        }
        public static function todos() {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT * FROM provincia";                            
            try{
                $listaUsuarios = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listaUsuarios;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
        }
        public static function Cadastrar($nome) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();  
            $query = "INSERT INTO provincia(nome) VALUES('$nome')";                           
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
        public static function Alterar($nomea,$nome) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();  
            $query = "UPDATE provincia SET nome='$nome' WHERE nome='$nomea'";                           
            if(mysqli_query($conexao, $query))
            {
                $query2 = "UPDATE municipio SET nomep='$nome' WHERE nomep='$nomea'"; 
                if(!mysqli_query($conexao, $query2)){
                    $error = mysqli_error($conexao);
                    mysqli_close($conexao);
                    mysqli_close($conexao);
                    return 'Engano: ' . $error;
                }                
                $query3 = "UPDATE comuna SET nomep='$nome' WHERE nomep='$nomea'"; 
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
        public static function Excluir($nome) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();  
            $query = "DELETE FROM provincia WHERE nome='$nome'";                       
            if(mysqli_query($conexao, $query))
            {
                $query2 = "DELETE FROM municipio WHERE nomep='$nome'";  
                if(!mysqli_query($conexao, $query2)){
                    $error = mysqli_error($conexao);
                    mysqli_close($conexao);
                    return 'Engano: ' . $error;                   
                }                
                $query3 = "DELETE FROM comuna WHERE nomep='$nome'";  
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