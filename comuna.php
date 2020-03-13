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
        <div class="container-fluid" id="comuna">

          <!-- Page Heading -->
          
            <div class="row">
              <div class="col-3"><button  class="btn btn-primary fa-1x float-left btn-circle" data-toggle="modal" data-target="#inserircomunaModal" title="Nova Comuna"><i class="fa fa-plus-circle" ></i></button></div>
              <div class="col-3">
                <h1 class="h3 mb-0 text-gray-800 text-uppercase text-center float-center">Lista de Comunas</h1>
              </div>
              <div class="col-3">
                <div class="form-group row">
                    <label for="Províncias" class="col-sm-3 col-form-label">Províncias:</label>                    
                    <div class="col-sm-9">
                        <select id="inputState" class="form-control" v-model="nomeprovincia" v-on:change="listarMunicipiosProv(nomeprovincia)">
                            <option v-for="item1 in provincias">{{item1.nome}}</option>                
                        </select>
                    </div>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group row"> 
                    <label for="Províncias" class="col-sm-3 col-form-label">Municípios:</label>                    
                    <div class="col-sm-9">
                        <select id="nomemunicipioselect" class="form-control" v-model="nomemunicipio" v-on:change="listarComunasPorMunicipioseProv(nomeprovincia,nomemunicipio)">
                            <option v-for="item2 in municipiosProv">{{item2.nomem}}</option>                
                        </select>
                    </div>
                </div>
              </div>
            </div>         
                
          <!-- DataTales Example -->
          <div class="card shadow mb-4">            
            <div class="row">
              <div class="col">
                  <table class="table table-bordered table-hover">
                      <thead class="bg-gradient-primary">
                          <tr>
                              <th scope="col" class="text-center text-gray-100">Província</th>
                              <th scope="col" class="text-center text-gray-100">Município</th>
                              <th scope="col" class="text-center text-gray-100">Comuna</th>
                              <th scope="col" class="text-center text-gray-100">Aleterar</th>
                              <th scope="col" class="text-center text-gray-100">Excluir</th>                              
                          </tr>
                      </thead>
                      <tbody>                                
                          <tr v-for="item3 in comunasporMunicipioseProv">
                              <td class="text-center">{{item3.nomep}}</td>
                              <td class="text-center">{{item3.nomem}}</td>
                              <td class="text-center">{{item3.nomecomuna}}</td>                     
                              <td class="text-center"><button class="btn btn-outline-secondary btn-circle" title="Alterar" data-toggle="modal" data-target="#alterarcomunaModal" @click="btnAlterarC(item3.nomecomuna)"><i class="fa fa-pencil-alt fa-1x"></i></button></td>
                              <td class="text-center"><button class="btn btn-danger btn-circle" title="Excluir" data-toggle="modal" data-target="#excluirComunaModal"@click="btnExcluirC(item3.nomep,item3.nomem,item3.nomecomuna)"><i class="fa fa-trash-alt fa-1x"></i></button></td>                                                
                          </tr>                          
                      </tbody>
                  </table>

              </div>
            </div>            
            
          </div> <!-- DataTales Example -->
         <!-- Modal Inserir-->

                  <div class="modal fade" id="inserircomunaModal" tabindex="-1" role="dialog" aria-labelledby="InserirComuna" aria-hidden="true">
                      <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title text-uppercase">Nova Comuna</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <div class="form-group row">
                                  <label class="col-sm-5 col-form-label">Nome da Província:</label>
                                  <div class="col-sm-7"><input id="nomeprovinciac" v-bind:value="nomeprovincia" type="text" class="form-control" disabled></div>
                              </div> 
                              <div class="form-group row">
                                  <label class="col-sm-5 col-form-label">Nome do Município:</label>
                                  <div class="col-sm-7"><input id="nomemunicipioc" v-bind:value="nomemunicipio" type="text" class="form-control" disabled></div>
                              </div> 
                              <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Nome da Comuna:</label>
                                <div class="col-sm-7"><input autofocus id="nomecomuna" type="text" class="form-control"></div>
                            </div>                
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" @click="btnInserirC">Inserir</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Fim Modal Inserir-->
                    <!-- Modal Alterar-->
                    <div class="modal fade" id="alterarcomunaModal" tabindex="-1" role="dialog" aria-labelledby="AleterarComuna" aria-hidden="true">
                          <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title text-uppercase">ALTERAR Comuna</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                  <div class="form-group row">
                                      <label class="col-sm-5 col-form-label">Nome província:</label>
                                      <div class="col-sm-7"> 
                                        <select id="nomeprovinciacm" class="form-control" v-model="nomeprovinciam" v-on:change="listarMunicipiosProvM(nomeprovinciam)">
                                          <option v-for="item4 in provincias">{{item4.nome}}</option>                
                                        </select>
                                      </div>
                                  </div>  
                                  <div class="form-group row">
                                      <label class="col-sm-5 col-form-label">Nome município:</label>
                                      <div class="col-sm-7"> 
                                        <select id="nomemunicipiocm" class="form-control" v-model="nomemunicipiom">
                                          <option v-for="item5 in municipiosProvM">{{item5.nomem}}</option>                
                                        </select>
                                      </div>
                                  </div>  
                                  <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Nome Comuna:</label>
                                    <div class="col-sm-7"><input id="nomecomunam" type="text" class="form-control"></div>
                                  </div>                
                              </div>                              
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary" @click="alterarC">Alterar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Fim Modal Alterar-->
                        <!-- Modal Excluir-->
                        <div class="modal fade" id="excluirComunaModal" tabindex="-1" role="dialog" aria-labelledby="ExcluirUsuario" aria-hidden="true">
                          <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title text-uppercase">EXCLUIR Comuna</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                  <div class="form-group row">
                                      <label class="col-sm-12 col-form-label">Está seguro de eliminar esta Comuna?<br> Esta ação é irreversível, e eliminará todos os alunos que pertencem a ela</label>                                 
                                  </div>                                    
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                  <button type="button" class="btn btn-danger" @click="excluirC">Excluir</button>
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