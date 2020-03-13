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
        <div class="container-fluid" id="inscricao">

          <!-- Page Heading -->
          <div class="row">
            <div class="col-2"> <button  class="btn btn-primary fa-1x btn-circle" data-toggle="modal" data-target="#inseririnscricaoModal" title="Nova Inscrição"><i class="fa fa-plus-circle" ></i></button></div>
            <div class="col-8"><h1 class="h3 mb-0 text-gray-800 text-uppercase text-center float-center">Lista de Inscrições</h1></div>
            <div class="col-2">
              <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                  <input type="text" class="form-control bg-light border-0 small border-left-primary" placeholder="Procurar pelo BI..." aria-label="Search" aria-describedby="basic-addon2" maxlength="14" id="procurarbiincrivir" v-model="procurarbiincrivir" @keyup="procurarAluno"  onkeydown="pulsar(event)">                 
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
                              <th scope="col" class="text-center text-gray-100">Bilhete de identidade</th>        
                              <th scope="col" class="text-center text-gray-100">Excluir</th>
                              <th scope="col" class="text-center text-gray-100">Informação</th>                                
                          </tr>
                      </thead>
                      <tbody>                                
                          <tr v-for="item in inscricoes">
                              <td class="text-center">{{item.bi}}</td>                                           
                              <td class="text-center"><button class="btn btn-danger btn-circle" title="Excluir" data-toggle="modal" data-target="#excluirinscricaoModal" @click="Eliminar(item.bi,item.ano)"><i class="fa fa-trash-alt fa-1x"></i></button></td>
                              <td class="text-center"><button class="btn btn-info btn-circle" title="Informação completa" data-toggle="modal" data-target="#infoinscricaoModal" @click="info(item.bi,item.ano,item.userid)"><i class="fa fa-info-circle fa-1x"></i></button></td>

                          </tr>                          
                      </tbody>
                  </table>

              </div>
            </div>            
            
          </div> <!-- DataTales Example -->
          <!-- Modal Inserir-->
                <div class="modal fade" id="inseririnscricaoModal" tabindex="-1" role="dialog" aria-labelledby="InserirCurso" aria-hidden="true">
                  <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-uppercase">Nova Inscrição</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">BI:</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="bialunoinscrever">
                            </div>
                          </div> 
                          <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Ano:</label>
                              <div class="col-sm-9"> 
                                <select id="anoinscricao" class="form-control" v-model="ano">
                                  <option v-for="item2 in anos">{{item2.ano}}</option>                
                                </select>
                              </div>
                          </div>                     
                          <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Regular:</label>
                              <div class="col-sm-9"> 
                                <select id="cursosinscricao" class="form-control" multiple="multiple">
                                  <option v-for="item3 in cursos">{{item3.nome}}</option>                
                                </select>
                              </div>
                          </div>   
                          <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Pos Laboral:</label>
                              <div class="col-sm-9"> 
                                <select id="cursosinscricaop" class="form-control" multiple="multiple">
                                  <option v-for="item3 in cursos">{{item3.nome}}</option>                
                                </select>
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
                <div class="modal fade" id="excluirinscricaoModal" tabindex="-1" role="dialog" aria-labelledby="InserirCurso" aria-hidden="true">
                  <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-uppercase">EXCLUIR Inscrição</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>Realmente deseja eliminar esta Inscrição?</p>
                        <p>Esta ação é irreversível!!!</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" @click="btnEliminar">Excluir</button>
                      </div>                      
                    </div>
                  </div>
                </div>
                  <!-- Fim Modal Excluir-->
                  <!-- Modal Info-->
                <div class="modal fade" id="infoinscricaoModal" tabindex="-1" role="dialog" aria-labelledby="InformaçãoInscrição" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-uppercase">Informação completa da Inscrição</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-1"></div>
                          <div class="col-6">                            
                            
                            <p><b>Nome completo: </b>{{nomei}}</p>
                            <p><b>Regular: </b> <span v-for="item4 in cursosinscribidos">{{item4.curso}}, </span></p>
                            <p><b>Pos Laboral: </b> <span v-for="item5 in cursosinscribidosp">{{item5.curso}}, </span></p>
                          </div>
                          <div class="col-5">  
                            <p><b>BI: </b>{{bii}}</p>                          
                            <p><b>Ano: </b>{{anoi}}</p>  
                            <p><b>Usuário: </b>{{useridincribir}}</p>                                                          
                          </div>                          
                        </div>
                                                                
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>                        
                      </div>
                    </div>
                  </div>
                </div>
                  <!-- Fim Modal Info-->                 
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