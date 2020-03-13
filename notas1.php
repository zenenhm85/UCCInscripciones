<?php 
    session_start();
    if(!isset($_SESSION['Usuario'])){
        exit();                                 
    }
    else{
      $usuario = $_SESSION['Usuario'];

      if($usuario['tipo']!=4 && $usuario['tipo']!=1){
        exit();
      }
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
        <div class="container-fluid" id="notas1">
          <!-- Page Heading -->
          <div class="row">
            <div class="col-1">
              <div class="form-group row">                
                <div class="col-sm-12"> 
                  <select id="anoturmanota" class="form-control" v-model="ano" @change="listarNotas">
                    <option v-for="item in anos">{{item.ano}}</option>                
                  </select>
                </div>
              </div>    
            </div> 
            <div class="col-2">              
              <div class="form-group row">
                <div class="col-sm-12"> 
                  <select id="periodoturmanota" class="form-control" v-model="periodo" @change="listarNotas">
                    <option value="Regular" selected>Regular</option> 
                    <option value="Pos Laboral">Pos Laboral</option>               
                  </select>
                </div>
              </div>    
            </div>      
            <div class="col-6">
              <h1 class="h3 mb-0 text-gray-800 text-uppercase text-center float-center">Inserir Notas</h1>
            </div>
            <div class="col-3">              
              <div class="form-group row">                
                <div class="col-sm-12"> 
                  <select id="cursoturmanota" class="form-control" v-model="curso" @change="listarNotas">
                    <option v-for="item in cursos">{{item.nome}}</option>                
                  </select>
                </div>
              </div>   
            </div>                   
          </div>
          <div class="row">
            <div class="col-6">
              <button  class="btn btn-primary fa-1x btn-circle" data-toggle="modal" data-target="#inserirNotaModal" title="Nova Nota" style="position: absolute;"><i class="fa fa-plus-circle" ></i></button>
            </div>
            <div class="col-6">
              <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search float-right">
                <div class="input-group">
                  <input type="text" class="form-control bg-light border-0 small border-left-primary" placeholder="Procurar pelo BI..." aria-label="Search" aria-describedby="basic-addon2" maxlength="14" id="procurarbinota1" v-model="procurarbi" onkeydown="pulsar(event)" @keyup="procurarAluno">       
                </div>
              </form>              
            </div>            
          </div>               
          <p></p>   
          <!-- DataTales Example -->
          <div class="card shadow mb-4">            
            <div class="row">
              <div class="col">
                  <table class="table table-bordered table-hover">
                      <thead class="bg-gradient-primary">
                        <tr>
                          <th scope="col" class="text-center text-gray-100" style="width: 60%;">Bilhete de identidade</th> 
                          <th scope="col" class="text-center text-gray-100" style="width: 10%;">Nota</th>
                          <th scope="col" class="text-center text-gray-100" style="width: 10%;">Alterar</th> 
                          <th scope="col" class="text-center text-gray-100" style="width: 10%;">Excluir</th>  
                        </tr>
                      </thead>
                      <tbody>                                
                        <tr v-for="item in listanotas">
                          <td class="text-center">{{item.bi}}</td> 
                          <td class="text-center">{{item.nota1}}</td>
                          <td class="text-center"><button class="btn btn-outline-secondary btn-circle" title="Alterar" data-toggle="modal" data-target="#alterarnotaModal" @click="brnAlterar(item.bi,item.nota1)"><i class="fa fa-pencil-alt fa-1x"></i></button></td> 
                          <td class="text-center"><button class="btn btn-danger btn-circle" title="Excluir" data-toggle="modal" data-target="#excluirnota1Modal" @click="btnEliminar(item.bi)"><i class="fa fa-trash-alt fa-1x"></i></button></td>                                         
                        </tr>                          
                      </tbody>
                  </table>
              </div>
            </div>      
          </div> <!-- DataTales Example -->
          <!-- Modal Inserir-->
                <div class="modal fade" id="inserirNotaModal" tabindex="-1" role="dialog" aria-labelledby="InserirCurso" aria-hidden="true">
                  <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-uppercase">Nova Nota</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">BI:</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="bialunonota1" onkeydown="pulsar(event)" autofocus>
                            </div>
                          </div> 
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Nota:</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="notaconv1" v-on:keyup.enter="Inserir">
                            </div>
                          </div>        
                                                                        
                        </form>    
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" @click="Inserir">Inserir</button>
                      </div>
                    </div>
                  </div>
                </div>
                  <!-- Fim Modal Inserir--> 

                  <!-- Modal Excluir-->
                <div class="modal fade" id="excluirnota1Modal" tabindex="-1" role="dialog" aria-labelledby="InserirCurso" aria-hidden="true">
                  <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-uppercase">EXCLUIR Nota</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>Realmente deseja eliminar esta Nota?</p>
                        <p>Esta ação é irreversível!!!</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" @click="Eliminar">Excluir</button>
                      </div>                      
                    </div>
                  </div>
                </div>
                  <!-- Fim Modal Excluir-->  
                  <!-- Modal Alterar-->
                <div class="modal fade" id="alterarnotaModal" tabindex="-1" role="dialog" aria-labelledby="InserirCurso" aria-hidden="true">
                  <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-uppercase">Alterar Nota</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">BI:</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="bialunonota1a" onkeydown="pulsar(event)" disabled v-model="bia">
                            </div>
                          </div> 
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Nota:</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="notaconv1a" v-on:keyup.enter="Alterar" v-model="notaa">
                            </div>
                          </div>                                                                     
                        </form>    
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" @click="Alterar">Alterar</button>
                      </div>                      
                    </div>
                  </div>
                </div>
                  <!-- Fim Modal Alterar-->  
        </div><!-- Fim  Fluid-->
            
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