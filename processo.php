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
        <div class="container-fluid" id="processo">

          <!-- Page Heading -->
          <div >
            <button  class="btn btn-primary fa-1x float-left btn-circle" data-toggle="modal" data-target="#inserirprocessoModal" title="Novo Processo" style="position: absolute;"><i class="fa fa-plus-circle" ></i></button>
            <h1 class="h3 mb-0 text-gray-800 text-uppercase text-center float-center">Lista de Processos</h1>       
          </div>
          <p></p>   
          <!-- DataTales Example -->
          <div class="card shadow mb-4">            
            <div class="row">
              <div class="col">
                  <table class="table table-bordered table-hover">
                      <thead class="bg-gradient-primary">
                          <tr>
                              <th scope="col" class="text-center text-gray-100">Ano</th>                     
                              <th scope="col" class="text-center text-gray-100">Excluir</th>                              
                          </tr>
                      </thead>
                      <tbody>                                
                          <tr v-for="item in processos">
                              <td class="text-center">{{item.ano}}</td>                             
                              <td class="text-center"><button class="btn btn-danger btn-circle" title="Excluir" data-toggle="modal" data-target="#excluirprocessoModal" @click="Eliminar(item.ano)"><i class="fa fa-trash-alt fa-1x"></i></button></td>
                          </tr>                          
                      </tbody>
                  </table>

              </div>
            </div>            
            
          </div> <!-- DataTales Example -->
          <!-- Modal Inserir-->
                <div class="modal fade" id="inserirprocessoModal" tabindex="-1" role="dialog" aria-labelledby="InserirProcesso" aria-hidden="true">
                  <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-uppercase">Novo Processo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Ano:</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <=57' id="anoprocesso" maxlength="4">
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
                                   
                  <!-- Modal Excluir-->
                <div class="modal fade" id="excluirprocessoModal" tabindex="-1" role="dialog" aria-labelledby="ExcluirProcesso" aria-hidden="true">
                  <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-uppercase">Excluir Processo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>Realmente deseja eliminar este Processo?</p>
                        <p>Esta ação é irreversível, e eliminará todas as inscrições deste processo!!!</p>
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