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
        <div class="container-fluid" id="usuarios">

          <!-- Page Heading -->
         <div >
            <button  class="btn btn-primary fa-1x float-left btn-circle" data-toggle="modal" data-target="#inseriruserModal" title="Nova Provincia" style="position: absolute;"><i class="fa fa-plus-circle" ></i></button>
            <h1 class="h3 mb-0 text-gray-800 text-uppercase text-center float-center">Lista de Usuários</h1>       
          </div>
          <p></p>
          
          <!-- DataTales Example -->
          <div class="card shadow mb-4">            
            <div class="row">
              <div class="col">
                  <table class="table table-bordered table-hover">
                      <thead class="bg-gradient-primary">
                          <tr>
                              <th scope="col" class="text-center text-gray-100">Nome completo</th>
                              <th scope="col" class="text-center text-gray-100">Nome de usuário</th>
                              <th scope="col" class="text-center text-gray-100">Telefone</th>
                              <th scope="col" class="text-center text-gray-100">Habilitado</th>
                              <th scope="col" class="text-center text-gray-100">Aleterar</th>
                              <th scope="col" class="text-center text-gray-100">Excluir</th>
                              <th scope="col" class="text-center text-gray-100">Perfil</th>
                          </tr>
                      </thead>
                      <tbody>                                
                          <tr v-for="item in usuarios">
                              <td class="text-center">{{item.nome}}</td>
                              <td class="text-center">{{item.idusuario}}</td>
                              <td class="text-center">{{item.telefone}}</td>
                              <td class="text-center" v-if="item.habilitado == 1">
                                <button type="button" class="btn btn-primary btn-sm" >Sim</button>
                                <button type="button" class="btn btn-secondary btn-sm" @click="habilitarUser(item.idusuario,0)">Não</button>
                              </td>
                              <td class="text-center" v-if="item.habilitado == 0">
                                <button type="button" class="btn btn-secondary btn-sm" @click="habilitarUser(item.idusuario,1)">Sim</button>
                                <button type="button" class="btn btn-primary btn-sm">Não</button>
                              </td>
                              <td class="text-center"><button class="btn btn-outline-secondary btn-circle" title="Alterar" data-toggle="modal" data-target="#alteraruserModal" @click="Alterar(item.nome,item.idusuario,item.telefone,item.email,item.tipo)"><i class="fa fa-pencil-alt fa-1x"></i></button></td>
                              <td class="text-center"><button class="btn btn-danger btn-circle" title="Excluir" data-toggle="modal" data-target="#excluiruserModal" @click="Eliminar(item.idusuario)"><i class="fa fa-trash-alt fa-1x"></i></button></td>   
                              <td class="text-center"><button class="btn btn-info btn-circle" title="Perfil de usuário" data-toggle="modal" data-target="#perfilModal" @click="Info(item.nome,item.idusuario,item.email,item.telefone,item.tipo,item.habilitado)"><i class="fa fa-info-circle fa-1x"></i></button></td>                  
                          </tr>                          
                      </tbody>
                  </table>

              </div>
            </div>            
            
          </div> <!-- DataTales Example -->
          <!-- Modal Inserir-->

                <div class="modal fade" id="inseriruserModal" tabindex="-1" role="dialog" aria-labelledby="InserirUsuario" aria-hidden="true">
                  <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">NOVO USUÁRIO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Nome completo:</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="nomeuser">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Nome de usuário:</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="iduser" placeholder="identificador do usuário para login">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Senha:</label>
                            <div class="col-sm-8">
                              <input type="password" class="form-control" id="senhauser" placeholder="mais de 5 caracteres">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Repetir Senha:</label>
                            <div class="col-sm-8">
                              <input type="password" class="form-control" id="repsenhauser" placeholder="deve ser igual à anterior">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Email:</label>
                            <div class="col-sm-8">
                              <input type="email" class="form-control" id="email" placeholder="um ou vários separados por vírgula">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Telefone:</label>
                            <div class="col-sm-8">
                              <input type="telephone" class="form-control" id="telefone" placeholder="um ou vários separados por vírgula">
                            </div>
                          </div>          
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tipo de usuário:</label>
                              <div class="col-sm-8">
                                  <select class="form-control" id="tipouser">
                                      <option value="1" selected>Administrador</option>                      
                                      <option value="2">Inscrições</option>
                                      <option value="3">Finanças</option>
                                      <option value="4">Nota</option>
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
                  <!-- Modal Alterar-->

                <div class="modal fade" id="alteraruserModal" tabindex="-1" role="dialog" aria-labelledby="AlterarUsuario" aria-hidden="true">
                  <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">ALTERAR USUÁRIO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Nome completo:</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="nomeusera">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Nome de usuário:</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="idusera" placeholder="identificador do usuário para login">
                            </div>
                          </div>  
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Senha:</label>
                            <div class="col-sm-8">
                              <input type="password" class="form-control" id="senhausera">
                            </div>
                          </div>                         
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Email:</label>
                            <div class="col-sm-8">
                              <input type="email" class="form-control" id="emaila" placeholder="um ou vários separados por vírgula">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Telefone:</label>
                            <div class="col-sm-8">
                              <input type="telephone" class="form-control" id="telefonea" placeholder="um ou vários separados por vírgula">
                            </div>
                          </div>          
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tipo de usuário:</label>
                              <div class="col-sm-8">
                                  <select class="form-control" id="tipousera">
                                      <option value="1" selected>Administrador</option>                      
                                      <option value="2">Inscrições</option>
                                      <option value="3">Finanças</option>
                                      <option value="4">Nota</option>
                                  </select>
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
                   <!-- Modal Perfil-->

                <div class="modal fade" id="perfilModal" tabindex="-1" role="dialog" aria-labelledby="InserirUsuario" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Perfil de usuário</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-1"></div>
                          <div class="col-6">
                            <p><b>Nome completo: </b>{{nome}}</p>
                            <p><b>Nome de usuário: </b>{{iduser}}</p>
                            <p><b>Email: </b>{{email}}</p>
                          </div>
                          <div class="col-1"></div>
                          <div class="col-4">
                            <p><b>Telefone: </b>{{telefone}}</p>
                            <p><b>Tipo: </b>{{tipo}}</p>
                            <p><b>Habilitado: </b>{{habilitado}}</p>                            
                          </div>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </div>
                  <!-- Fim Modal Perfil-->
                  <!-- Modal Excluir-->

                <div class="modal fade" id="excluiruserModal" tabindex="-1" role="dialog" aria-labelledby="InserirUsuario" aria-hidden="true">
                  <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Excluir usuário</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>Realmente deseja eliminar este usuário?</p>
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