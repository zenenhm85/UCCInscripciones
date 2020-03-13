<?php 
include_once 'conexao.php';

class Processo {

    function __construct() {            
        
    }
    public static function todos() {
        $objeto = new Conexao();
        $conexao = $objeto->Conectar(); 
        $query = "SELECT * FROM processo";                            
        try{
            $listaBancos = mysqli_query($conexao, $query); 
            mysqli_close($conexao);
            return $listaBancos;
        }
        catch (Exception $e){
            return "O error de Conexão é: ". $e->getMessage();
        }                        
    }        
    public static function Cadastrar($ano) {
        $objeto = new Conexao();
        $conexao = $objeto->Conectar();  
        $query = "INSERT INTO processo(ano) VALUES('$ano') ";                           
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
    public static function Excluir($ano) {
        $objeto = new Conexao();
        $conexao = $objeto->Conectar();  
        $query = "DELETE FROM processo WHERE ano='$ano'";                       
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