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
        <div class="container-fluid" id="alunos">

          <!-- Page Heading -->
           <div class="row">
            <div class="col-2"> <button  class="btn btn-primary fa-1x btn-circle" data-toggle="modal" data-target="#inserirAlunoModal" title="Novo Aluno" style="position: absolute;"><i class="fa fa-plus-circle" ></i></button></div>
            <div class="col-8"><h1 class="h3 mb-0 text-gray-800 text-uppercase text-center float-center">Lista de Alunos</h1></div>
            <div class="col-2">
              <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                  <input type="text" class="form-control bg-light border-0 small border-left-primary" placeholder="Procurar pelo BI..." aria-label="Search" aria-describedby="basic-addon2" maxlength="14" id="procurar"@keyup="procurarAluno" v-model="procuraralunobi"  onkeydown="pulsar(event)">                 
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
                            <th scope="col" class="text-center text-gray-100" style="width: 20%;">Bilhete de identidade</th>
                            <th scope="col" class="text-center text-gray-100" style="width: 35%;">Nome completo</th> 
                            <th scope="col" class="text-center text-gray-100" style="width: 15%;">Sexo</th>                     
                            <th scope="col" class="text-center text-gray-100" style="width: 10%;">Aleterar</th>
                            <th scope="col" class="text-center text-gray-100" style="width: 10%;">Excluir</th>
                            <th scope="col" class="text-center text-gray-100" style="width: 10%;">Informação</th>                
                        </tr>
                    </thead>
                    <tbody>                                
                      <tr v-for="item in alunos">
                        <td class="text-center">{{item.bi}}</td>
                        <td class="text-center">{{item.nomecompleto}}</td>
                        <td class="text-center">{{item.sexo}}</td>
                        <td class="text-center"><button class="btn btn-outline-secondary btn-circle" title="Alterar" data-toggle="modal" data-target="#alterarAlunoModal" @click="btnAlterar(item.bi,item.datanasc,item.nomecompleto,item.comuna,item.municipio,item.provincia,item.endereco,item.sexo,item.telefone,item.email,item.obs,item.procedencia,item.cursomedio,item.trabalhador,item.cc)"><i class="fa fa-pencil-alt fa-1x"></i></button></td>
                        <td class="text-center"><button class="btn btn-danger btn-circle" title="Excluir" data-toggle="modal" data-target="#excluiAlunoModal" @click="btnEliminar(item.bi)"><i class="fa fa-trash-alt fa-1x"></i></button></td> 
                        <td class="text-center"><button class="btn btn-info btn-circle" title="Informação completa" data-toggle="modal" data-target="#infoAlunoModal" @click="info(item.bi,item.datanasc,item.nomecompleto,item.comuna,item.municipio,item.provincia,item.endereco,item.sexo,item.telefone,item.email,item.obs,item.procedencia,item.cursomedio,item.trabalhador,item.userid,item.cc)"><i class="fa fa-info-circle fa-1x"></i></button></td>
                      </tr>                          
                    </tbody>
                </table>
              </div>
            </div>            
            
          </div> <!-- DataTales Example -->
          <!-- Modal Inserir-->
                <div class="modal fade" id="inserirAlunoModal" tabindex="-1" role="dialog" aria-labelledby="InserirCurso" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">NOVO ALUNO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-7">
                            <form>
                              <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Nome:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="nomealuno" placeholder="Nome Completo">
                                </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-4 col-form-label">Província:</label>
                                  <div class="col-sm-8"> 
                                    <select id="provinciaaluno" class="form-control" v-model="nomeprovincia" v-on:change="listarMunicipiosProv(nomeprovincia)">
                                      <option v-for="item4 in provincias">{{item4.nome}}</option>                
                                    </select>
                                  </div>
                              </div>  
                              <div class="form-group row">
                                  <label class="col-sm-4 col-form-label">Município:</label>
                                  <div class="col-sm-8"> 
                                    <select id="municipioaluno" class="form-control" v-model="nomemunicipio" v-on:change="listarComunasPorMunicipioseProv(nomeprovincia,nomemunicipio)">
                                      <option v-for="item5 in municipios">{{item5.nomem}}</option>                
                                    </select>
                                  </div>
                              </div>  
                              <div class="form-group row">
                                  <label class="col-sm-4 col-form-label">Comuna:</label>
                                  <div class="col-sm-8"> 
                                    <select id="comunaaluno" class="form-control" v-model="nomecomuna">
                                      <option v-for="item6 in comunas">{{item6.nomecomuna}}</option>                
                                    </select>
                                  </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Procedência(CC?):</label>
                                <div class="col-sm-7"> 
                                  <select id="procedenciaaluno" class="form-control" v-model="procedencia">
                                    <option v-for="item7 in procedencias">{{item7.nome}}</option>                
                                  </select>
                                </div>
                                <div class="col-sm-1">
                                  <input type="checkbox" class="form-control" id="cc" checked> 
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Curso Médio:</label>
                                <div class="col-sm-8"> 
                                  <select id="cursomedioaluno" class="form-control" v-model="cursomedio">
                                    <option v-for="item8 in cursosmedio">{{item8.nome}}</option>                
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Endereço:</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="enderecoaluno">
                                </div>
                              </div>                                                                                 
                            </form>                         
                          </div>
                          <div class="col-5">
                            <form>
                              <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">BI:</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="bialuno" maxlength="14">
                                </div>
                              </div> 
                              <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Data:</label>
                                <div class="col-sm-8">
                                  <input type="date" class="form-control" id="dataaluno">
                                </div>
                              </div>   
                              <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Telefone:</label>
                                <div class="col-sm-8">
                                  <input type="telephone" class="form-control" id="telefonealuno" maxlength="9">
                                </div>
                              </div>   
                              <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Email:</label>
                                <div class="col-sm-8">
                                  <input type="email" class="form-control" id="emailaluno">
                                </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-4 col-form-label">Sexo:</label>
                                  <div class="col-sm-8"> 
                                    <select id="sexoaluno" class="form-control">
                                      <option value="Masculino" selected>Masculino</option> 
                                      <option value="Feminino">Feminino</option>               
                                    </select>
                                  </div>
                              </div> 
                              <div class="form-group row">
                                  <label class="col-sm-4 col-form-label">Trabalhador:</label>
                                  <div class="col-sm-8"> 
                                    <select id="trablhador" class="form-control">
                                      <option value="Não" selected>Não</option> 
                                      <option value="Sim">Sim</option>               
                                    </select>
                                  </div>
                              </div>                                                        
                              <div class="form-group row">
                                  <label class="col-sm-4 col-form-label">Observação:</label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control" id="obsaluno">
                                </div>
                              </div>       
                            </form>                    
                          </div>
                        </div>                                      
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" @click="InserirAluno">Inserir</button>
                      </div>
                    </div>
                  </div>
                </div>
                  <!-- Fim Modal Inserir-->
                  <!-- Modal Alterar-->
                <div class="modal fade" id="alterarAlunoModal" tabindex="-1" role="dialog" aria-labelledby="AlterarCurso" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">ALTERAR ALUNO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-7">
                            <form>
                              <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Nome:</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="nomealunom" placeholder="Nome Completo">
                                </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-4 col-form-label">Província:</label>
                                  <div class="col-sm-8"> 
                                    <select id="provinciaalunom" class="form-control" v-model="nomeprovinciam" v-on:change="listarMunicipiosProv(nomeprovinciam)">
                                      <option v-for="item4 in provincias">{{item4.nome}}</option>                
                                    </select>
                                  </div>
                              </div>  
                              <div class="form-group row">
                                  <label class="col-sm-4 col-form-label">Município:</label>
                                  <div class="col-sm-8"> 
                                    <select id="municipioalunom" class="form-control" v-model="nomemunicipiom" v-on:change="listarComunasPorMunicipioseProv(nomeprovinciam,nomemunicipiom)">
                                      <option v-for="item5 in municipios">{{item5.nomem}}</option>                
                                    </select>
                                  </div>
                              </div>  
                              <div class="form-group row">
                                  <label class="col-sm-4 col-form-label">Comuna:</label>
                                  <div class="col-sm-8"> 
                                    <select id="comunaalunom" class="form-control" v-model="nomecomunam">
                                      <option v-for="item6 in comunas">{{item6.nomecomuna}}</option>                
                                    </select>
                                  </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Procedência(CC?):</label>
                                <div class="col-sm-7"> 
                                  <select id="procedenciaalunom" class="form-control" v-model="procedenciam">
                                    <option v-for="item7 in procedencias">{{item7.nome}}</option>                
                                  </select>
                                </div>
                                <div class="col-sm-1">
                                  <input type="checkbox" class="form-control" id="ccm" v-model="ccm"> 
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Curso Médio:</label>
                                <div class="col-sm-8"> 
                                  <select id="cursomedioalunom" class="form-control" v-model="cursomediom">
                                    <option v-for="item8 in cursosmedio">{{item8.nome}}</option>                
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Endereço:</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="enderecoalunom">
                                </div>
                              </div>                                                                                 
                            </form>                         
                          </div>
                          <div class="col-5">
                            <form>
                              <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">BI:</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="bialunom" maxlength="14">
                                </div>
                              </div> 
                              <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Data:</label>
                                <div class="col-sm-8">
                                  <input type="date" class="form-control" id="dataalunom">
                                </div>
                              </div>   
                              <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Telefone:</label>
                                <div class="col-sm-8">
                                  <input type="telephone" class="form-control" id="telefonealunom" maxlength="9">
                                </div>
                              </div>   
                              <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Email:</label>
                                <div class="col-sm-8">
                                  <input type="email" class="form-control" id="emailalunom">
                                </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-4 col-form-label">Sexo:</label>
                                  <div class="col-sm-8"> 
                                    <select id="sexoalunom" class="form-control">
                                      <option value="Masculino">Masculino</option> 
                                      <option value="Feminino">Feminino</option>               
                                    </select>
                                  </div>
                              </div>
                               <div class="form-group row">
                                  <label class="col-sm-4 col-form-label">Trabalhador:</label>
                                  <div class="col-sm-8"> 
                                    <select id="trabalhadorm" class="form-control" v-model="trabalhadorm">
                                      <option value="Não" selected>Não</option> 
                                      <option value="Sim">Sim</option>               
                                    </select>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-4 col-form-label">Observação:</label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control" id="obsalunom">
                                </div>
                              </div>                                                     
                            </form>                    
                          </div>
                        </div>                                             
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" @click="Alterar">Alterar</button>
                      </div>
                    </div>
                  </div>
                </div>
                  <!-- Fim Modal Alterar-->                  
                  <!-- Modal Excluir-->
                <div class="modal fade" id="excluiAlunoModal" tabindex="-1" role="dialog" aria-labelledby="InserirCurso" aria-hidden="true">
                  <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">EXCLUIR ALUNO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>Realmente deseja eliminar este Aluno?</p>
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
                  <!-- Modal Info-->
                <div class="modal fade" id="infoAlunoModal" tabindex="-1" role="dialog" aria-labelledby="InformaçãoAluno" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-uppercase">Informação completa do aluno</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-1"></div>
                          <div class="col-6">
                            <p><b>Nome completo: </b>{{nomecompletoi}}</p>
                            <p><b>Bilhete de identidade: </b>{{bii}}</p>
                            <p><b>Data de nascimento: </b>{{datanasci}}</p>
                            <p><b>Telefone: </b>{{telefonei}}</p>
                            <p><b>Email: </b>{{emaili}}</p>
                            <p><b>Procedência Escolar: </b>{{procedenciai}}</p>
                            <p><b>Ensino médio em CC?: </b>{{cci}}</p>
                            <p><b>Curso do Ensino Médio: </b>{{cursomedioi}}</p>
                          </div>
                          <div class="col-5">
                            <p><b>Província: </b>{{provinciai}}</p>
                            <p><b>Município: </b>{{municipioi}}</p>
                            <p><b>Comuna: </b>{{comunai}}</p>
                            <p><b>Endereço: </b>{{enderecoi}}</p>
                            <p><b>Sexo: </b>{{sexoi}}</p> 
                            <p><b>Trabalhador: </b>{{trabalhadori}}</p>
                            <p><b>Observações: </b>{{obsi}}</p> 
                            <p><b>Usuário: </b>{{useri}}</p>                                     
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