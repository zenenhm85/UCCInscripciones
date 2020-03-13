<?php 
include_once 'conexao.php';


class Banco {

    function __construct() {            
        
    }
    public static function todos() {
        $objeto = new Conexao();
        $conexao = $objeto->Conectar(); 
        $query = "SELECT * FROM banco";                            
        try{
            $listaBancos = mysqli_query($conexao, $query); 
            mysqli_close($conexao);
            return $listaBancos;
        }
        catch (Exception $e){
            return "O error de Conexão é: ". $e->getMessage();
        }                        
    }        
    public static function Cadastrar($nome,$descricao) {
        $objeto = new Conexao();
        $conexao = $objeto->Conectar();  
        $query = "INSERT INTO banco(nome,descricao) VALUES('$nome', '$descricao') ";                           
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
        $query = "DELETE FROM banco WHERE nome='$nome'";                       
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
    public static function Alterar($nomea, $nomenew, $descricao){
        $objeto = new Conexao();
        $conexao = $objeto->Conectar();  
        $query = "UPDATE banco SET nome='$nomenew', descricao='$descricao' WHERE nome='$nomea'";                           
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