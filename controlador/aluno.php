 <?php 
    session_start();
    include_once '../modelo/aluno.php';

    $_POST = json_decode(file_get_contents("php://input"), true);

    $opcao = (isset($_POST['opcao'])) ? $_POST['opcao'] : '';

    if($opcao == 1){
        
        $bi = (isset($_POST['bi'])) ? $_POST['bi'] : '';
        $datanasc = (isset($_POST['datanasc'])) ? $_POST['datanasc'] : '';
        $nomecompleto = (isset($_POST['nomecompleto'])) ? $_POST['nomecompleto'] : '';
        $comuna = (isset($_POST['comuna'])) ? $_POST['comuna'] : '';
        $municipio = (isset($_POST['municipio'])) ? $_POST['municipio'] : '';
        $provincia = (isset($_POST['provincia'])) ? $_POST['provincia'] : '';
        $endereco = (isset($_POST['endereco'])) ? $_POST['endereco'] : '';
        $sexo = (isset($_POST['sexo'])) ? $_POST['sexo'] : '';
        $telefone = (isset($_POST['telefone'])) ? $_POST['telefone'] : '';
        $email = (isset($_POST['email'])) ? $_POST['email'] : '';
        $obs = (isset($_POST['obs'])) ? $_POST['obs'] : ''; 
        $procedencia = (isset($_POST['procedencia'])) ? $_POST['procedencia'] : '';
        $cursomedio = (isset($_POST['cursomedio'])) ? $_POST['cursomedio'] : ''; 
        $trabalhador = (isset($_POST['trabalhador'])) ? $_POST['trabalhador'] : ''; 
        $cc = (isset($_POST['cc'])) ? $_POST['cc'] : ''; 

        $usurioaux = $_SESSION['Usuario']; 
        $userid = $usurioaux['idusuario'];      

        $aluno = new Aluno();
        $resultado = $aluno::Cadastrar($bi,$datanasc,$nomecompleto,$comuna,$municipio,$provincia,$endereco,$sexo,$telefone,$email,$obs,$procedencia,$cursomedio,$trabalhador,$userid,$cc);   
        $array = array();
        $array[0] = $resultado;
        print json_encode($array, JSON_UNESCAPED_UNICODE);

   }
   elseif($opcao == 2){
        
        $bia = (isset($_POST['bia'])) ? $_POST['bia'] : '';
        $bi = (isset($_POST['bi'])) ? $_POST['bi'] : '';
        $datanasc = (isset($_POST['datanasc'])) ? $_POST['datanasc'] : '';
        $nome = (isset($_POST['nome'])) ? $_POST['nome'] : '';
        $comuna = (isset($_POST['comuna'])) ? $_POST['comuna'] : '';
        $municipio = (isset($_POST['municipio'])) ? $_POST['municipio'] : '';
        $provincia = (isset($_POST['provincia'])) ? $_POST['provincia'] : '';
        $endereco = (isset($_POST['endereco'])) ? $_POST['endereco'] : '';
        $sexo = (isset($_POST['sexo'])) ? $_POST['sexo'] : '';
        $telefone = (isset($_POST['telefone'])) ? $_POST['telefone'] : '';
        $email = (isset($_POST['email'])) ? $_POST['email'] : '';
        $obs = (isset($_POST['obs'])) ? $_POST['obs'] : '';   
        $procedencia = (isset($_POST['procedencia'])) ? $_POST['procedencia'] : '';
        $cursomedio = (isset($_POST['cursomedio'])) ? $_POST['cursomedio'] : ''; 
        $trabalhador = (isset($_POST['trabalhador'])) ? $_POST['trabalhador'] : ''; 
        $ccm = (isset($_POST['ccm'])) ? $_POST['ccm'] : ''; 

        $usurioaux = $_SESSION['Usuario']; 
        $userid = $usurioaux['idusuario'];      

        $aluno = new Aluno();
        $resultado = $aluno::Alterar($bia,$bi,$datanasc,$nome,$comuna,$municipio,$provincia,$endereco,$sexo,$telefone,$email,$obs,$procedencia,$cursomedio,$trabalhador,$userid,$ccm);   
        $array = array();
        $array[0] = $resultado;
        print json_encode($array, JSON_UNESCAPED_UNICODE); 
    }
    elseif($opcao == 3){
        
        $bi = (isset($_POST['bi'])) ? $_POST['bi'] : '';
        $aluno = new Aluno();
        $resultado = $aluno::Excluir($bi);   
        $array = array();
        $array[0] = $resultado;
        print json_encode($array, JSON_UNESCAPED_UNICODE);    
    }    
    elseif($opcao == 5){
        $nomep = (isset($_POST['nomeprov'])) ? $_POST['nomeprov'] : '';
        $municipio = new Municipio();
        $resultado = $municipio::todos2($nomep);    
        $array = array();
        $i = 0;
        while ($f = mysqli_fetch_array($resultado)) 
        {
            $array[$i] = $f;
            $i++;

        }
        print json_encode($array, JSON_UNESCAPED_UNICODE);        
    }    
    elseif($opcao == 6){
        $nomep = (isset($_POST['nomep'])) ? $_POST['nomep'] : '';
        $nomem = (isset($_POST['nomem'])) ? $_POST['nomem'] : '';
        $comuna = new Comuna();
        $resultado = $comuna::todasporMunicipioeProv($nomep,$nomem);    
        $array = array();
        $i = 0;
        while ($f = mysqli_fetch_array($resultado)) 
        {
            $array[$i] = $f;
            $i++;

        }
        print json_encode($array, JSON_UNESCAPED_UNICODE);        
    }    
    elseif($opcao == -1){    
        $usurioaux = $_SESSION['Usuario']; 
        $userid = $usurioaux['idusuario'];   
        
        $aluno = new Aluno();
        $resultado = $aluno::listarUltimos25($userid);    
        $array = array();
        $i = 0;
        while ($f = mysqli_fetch_array($resultado)) 
        {
            $array[$i] = $f;
            $i++;
        }
        print json_encode($array, JSON_UNESCAPED_UNICODE);        
    } 
    elseif ($opcao == -2) {
        $bi = (isset($_POST['bi'])) ? $_POST['bi'] : '';
        $aluno = new Aluno();
        $resultado = $aluno::listarPorBI($bi);    
        $array = array();
        $i = 0;
        while ($f = mysqli_fetch_array($resultado)) 
        {
            $array[$i] = $f;
            $i++;
        }
        print json_encode($array, JSON_UNESCAPED_UNICODE);  
    }   
    else{
        $municipio = new Municipio();
        $resultado = $municipio::todos();    
        $array = array();
        $i = 0;
        while ($f = mysqli_fetch_array($resultado)) 
        {
            $array[$i] = $f;
            $i++;

        }
        print json_encode($array, JSON_UNESCAPED_UNICODE);
    }
?>