<?php 
    session_start();
    if(!isset($_SESSION['Usuario'])){
        exit();                                 
    }
    else{
      $usurio = $_SESSION['Usuario'];
    }      
?>
<!DOCTYPE html>
<html lang="pt">

<head>

  <?php include  'common_header.php';?>

</head>

      <body id="page-top">

        <!-- Page Wrapper -->
          <div id="wrapper">

              <?php include  'menuesquerdo_e_top.php';?>         

              <!-- Begin Page Content -->
              <div class="container-fluid" id="trocarsenha">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-center">
                  <h1 class="h3 mb-0 text-gray-800 text-uppercase text-center">Trocar Senha</h1>       
                </div>
                
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                  <p></p><p></p>
                  <div class="row">
                    <div class="col-3">
                        
                    </div>
                    <div class="col-5">
                      <form>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Nome completo:</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" value="<?php echo($usurio['idnome']) ?>"  disabled>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Nome de usuário:</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="idusertrocar" value="<?php echo($usurio['idusuario']) ?>" disabled>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Senha anterior:</label>
                            <div class="col-sm-8">
                              <input type="password" class="form-control" id="senhausertrocar">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Nova Senha:</label>
                            <div class="col-sm-8">
                              <input type="password" class="form-control" id="novasenhatrocar" placeholder="mais de 5 caracteres">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Repetir nova Senha:</label>
                            <div class="col-sm-8">
                              <input type="password" class="form-control" id="repnovasenhatrocar" placeholder="igual a anterior">
                            </div>
                          </div>
                          <button type="reset" class="btn btn-secondary">Cancelar</button>
                          <button type="button" class="btn btn-primary float-right" @click="TrocarSenha">Trocar senha</button>                
                          <p></p>                                                     
                        </form>                                                   
                    </div>

                    <div class="col-3">
                        
                    </div>
                  </div>      
                </div>         
              </div>
            </div>
        <!-- End of Main Content -->  
        <?php include  'footer.php';?>
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
          <i class="fas fa-angle-up"></i>
        </a>
        <!-- Logout Modal-->
        <?php include  'common_foot.php';?>
      </body>

</html>