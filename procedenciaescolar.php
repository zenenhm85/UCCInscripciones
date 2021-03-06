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
        <div class="container-fluid" id="procedencias">

          <!-- Page Heading -->
          <div >
            <button  class="btn btn-primary fa-1x float-left btn-circle" data-toggle="modal" data-target="#inserirprocedenciaModal" title="Nova Procedência" style="position: absolute;"><i class="fa fa-plus-circle" ></i></button>
            <h1 class="h3 mb-0 text-gray-800 text-uppercase text-center float-center">Procedência Escolar de Ensino Médio</h1>       
          </div>
          <p></p>   
          <!-- DataTales Example -->
          <div class="card shadow mb-4">            
            <div class="row">
              <div class="col">
                  <table class="table table-bordered table-hover">
                      <thead class="bg-gradient-primary">
                          <tr>
                            <th scope="col" class="text-center text-gray-100">Nome</th>                              
                            <th scope="col" class="text-center text-gray-100">Aleterar</th>
                            <th scope="col" class="text-center text-gray-100">Excluir</th>                              
                          </tr>
                      </thead>
                      <tbody>                                
                          <tr v-for="item in procedencias">
                              <td class="text-center">{{item.nome}}</td>
                              <td class="text-center"><button class="btn btn-outline-secondary btn-circle" title="Alterar" data-toggle="modal" data-target="#alterarprocedenciaModal" @click="Alterar(item.nome)"><i class="fa fa-pencil-alt fa-1x"></i></button></td>
                              <td class="text-center"><button class="btn btn-danger btn-circle" title="Excluir" data-toggle="modal" data-target="#excluirprocedenciaModal" @click="Eliminar(item.nome)"><i class="fa fa-trash-alt fa-1x"></i></button></td>                                                
                          </tr>                          
                      </tbody>
                  </table>

              </div>
            </div>            
            
          </div> <!-- DataTales Example -->
          <!-- Modal Inserir-->
                <div class="modal fade" id="inserirprocedenciaModal" tabindex="-1" role="dialog" aria-labelledby="InserirProcedencia" aria-hidden="true">
                  <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-uppercase">Nova Procedência Escolar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nome:</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="nomeprocedencia">
                            </div>
                          </div>                                                
                        </form>    
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" @click="btnInserir">Inserir</button>
                      </div>
                    </div>
                  </div>
                </div>
                  <!-- Fim Modal Inserir-->
                  <!-- Modal Alterar-->
                <div class="modal fade" id="alterarprocedenciaModal" tabindex="-1" role="dialog" aria-labelledby="AlterarProcedencia" aria-hidden="true">
                  <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-uppercase">ALTERAR Procedência Escolar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nome:</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="nomeprocedenciaa">
                            </div>
                          </div>                                         
                        </form>    
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" @click="btnAlterar">Alterar</button>
                      </div>
                    </div>
                  </div>
                </div>
                  <!-- Fim Modal Alterar-->                  
                  <!-- Modal Excluir-->
                <div class="modal fade" id="excluirprocedenciaModal" tabindex="-1" role="dialog" aria-labelledby="ExcluirProcedencia" aria-hidden="true">
                  <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-uppercase">EXCLUIR Procedência Escolar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>Realmente deseja eliminar esta procedência Escolar de Ensino Médio?</p>
                        <p>Esta ação é irreversível, e eliminará todos os alunos desta procedência escolar!!!</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" @click="btnEliminar">Excluir</button>
                      </div>                      
                    </div>
                  </div>
                </div>
                  <!-- Fim Modal Excluir-->
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