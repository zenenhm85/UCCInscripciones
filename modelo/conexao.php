<?php
    header('Content-Type: text/html; charset=UTF-8');
    class Conexao{
        public static function Conectar(){
            $servidor = 'localhost';
            $usuario = 'root';
            $password = '';
            $nome_bd = 'ucc';          

            $conexao = mysqli_connect($servidor, $usuario, $password,$nome_bd);
            mysqli_query($conexao,"SET NAMES 'utf8'");
            mysqli_query($conexao,"SET character_set_connection=utf8");
            mysqli_query($conexao,"SET character_set_client=utf8");
            mysqli_query($conexao,"SET character_set_results=utf8");

            return $conexao;
        }
    }
?>