<?php 
    include_once 'conexao.php';


    class Usuario {

        function __construct() {            
            
        }
        public static function todos() {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT * FROM usuario";                            
            try{
                $listaUsuarios = mysqli_query($conexao, $query); 
                mysqli_close($conexao);
                return $listaUsuarios;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                        
        }
        public static function inicio($idusuario, $senha) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();
            $contador = 0; 
            
            $query = "SELECT * FROM usuario WHERE idusuario='$idusuario'";                            
            try{
                $listaUsuarios = mysqli_query($conexao, $query);
                if($listaUsuarios->num_rows == 0){
                    mysqli_close($conexao);
                    return "0";                    
                }
                else{
                    $f = mysqli_fetch_array($listaUsuarios);
                    if($f['habilitado'] =="1"){
                        if(password_verify($senha, $f['senha'])){
                            mysqli_close($conexao);
                            return "1";
                        }
                        else{
                            mysqli_close($conexao);
                            return "3";
                        }
                    }
                    else{
                        mysqli_close($conexao);
                        return "2";
                    }                    

                }            
                   
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                      
        }
        public static function NomeporID($idusuario){
            $objeto = new Conexao();
            $conexao = $objeto->Conectar(); 
            $query = "SELECT * FROM usuario WHERE idusuario='$idusuario'";                           
            try{
                $listaUsuarios = mysqli_query($conexao, $query);
                $f = mysqli_fetch_array($listaUsuarios); 
                return $f;
            }
            catch (Exception $e){
                return "O error de Conexão é: ". $e->getMessage();
            }                        
        }
        public static function HabilitarD($idusuario,$habilitado) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();  
            $query = "UPDATE usuario SET habilitado='$habilitado' WHERE idusuario='$idusuario'";                           
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
        public static function Cadastrar($nome,$email,$telefone,$idusuario,$senha,$tipo) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();  

            $senhacifrada = password_hash($senha, PASSWORD_DEFAULT,array('cost' => 12));

            $query = "INSERT INTO usuario(nome,email,telefone,idusuario,senha,tipo) VALUES('$nome', '$email', '$telefone', '$idusuario','$senhacifrada', '$tipo') ";                           
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
        public static function Excluir($idusuario) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();  
            $query = "DELETE FROM usuario WHERE idusuario='$idusuario'";                       
            if(mysqli_query($conexao, $query))
            {
                $usurio = $_SESSION['Usuario'];
                if($usurio["idusuario"] == $idusuario){
                    unset($_SESSION['Usuario']);
                    mysqli_close($conexao);
                    return "2";
                }
                mysqli_close($conexao);
                return "1";
            }
            else{
                $error = mysqli_error($conexao);
                mysqli_close($conexao);
                return 'Engano: ' . $error;
            }                   
        }
        public static function TrocarSenha($idusuario,$senhaanterior,$novasenha) {
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();  
            $query2 = "SELECT * FROM usuario WHERE idusuario='$idusuario'";

            $lista = mysqli_query($conexao, $query2);
            
            if($lista->num_rows > 0){
                $f=mysqli_fetch_array($lista);
                
                if(password_verify($senhaanterior, $f['senha']))
                {
                    $hashnovasenha = password_hash($novasenha, PASSWORD_DEFAULT,array('cost' => 12));
                    
                    $query = "UPDATE usuario SET senha='$hashnovasenha' WHERE idusuario='$idusuario'";                         
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
                else{
                    mysqli_close($conexao);
                    return "0";
                }      
                    
            }
            else{
                $error = mysqli_error($conexao);
                mysqli_close($conexao);
                return "2";
            }                     
        }
        public static function Alterar($ida, $idusernew, $nome, $tipo, $email, $telefone,$senha){
            $objeto = new Conexao();
            $conexao = $objeto->Conectar();  
            $query = "";

            if(strlen($senha) > 0)
            {
                $hashnovasenha = password_hash($senha, PASSWORD_DEFAULT,array('cost' => 12));
                $query = "UPDATE usuario SET nome='$nome', email='$email',telefone='$telefone',idusuario='$idusernew',tipo='$tipo',senha='$hashnovasenha' WHERE idusuario='$ida'"; 
            }
            else
            {
                $query = "UPDATE usuario SET nome='$nome', email='$email',telefone='$telefone',idusuario='$idusernew',tipo='$tipo' WHERE idusuario='$ida'"; 
            }
                                      
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