<?php 
include_once 'conexao.php';

class Cursomedio {

    function __construct() {            
        
    }
    public static function todos() {
        $objeto = new Conexao();
        $conexao = $objeto->Conectar(); 
        $query = "SELECT * FROM cursomedio";                            
        try{
            $listaBancos = mysqli_query($conexao, $query); 
            mysqli_close($conexao);
            return $listaBancos;
        }
        catch (Exception $e){
            return "O error de Conexão é: ". $e->getMessage();
        }                        
    }        
    public static function Cadastrar($nome) {
        $objeto = new Conexao();
        $conexao = $objeto->Conectar();  
        $query = "INSERT INTO cursomedio(nome) VALUES('$nome') ";                           
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
    public static function Excluir($nome) {
        $objeto = new Conexao();
        $conexao = $objeto->Conectar();  
        $query = "DELETE FROM cursomedio WHERE nome='$nome'";                       
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
    public static function Alterar($nomea, $nomenew){
        $objeto = new Conexao();
        $conexao = $objeto->Conectar();  
        $query = "UPDATE cursomedio SET nome='$nomenew' WHERE nome='$nomea'";                           
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