<?php 
    session_start();
    if(!isset($_SESSION['Usuario'])){
        exit();                                 
    }
    else{
      $usurio = $_SESSION['Usuario'];

      if($usurio['tipo']!= 1 && $usurio['tipo']!= 3){
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
        <div class="container-fluid" id="pagamento">

          <!-- Page Heading -->
          <div class="row">
            <div class="col-2"><button  class="btn btn-primary fa-1x btn-circle" data-toggle="modal" data-target="#inserirpagoModal" title="Novo Pagamento"><i class="fa fa-plus-circle" ></i></button></div>
            <div class="col-8"><h1 class="h3 mb-0 text-gray-800 text-uppercase text-center float-center">Lista de Pagamentos</h1></div>
            <div class="col-2">
              <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                  <input type="text" class="form-control bg-light border-0 small border-left-primary" placeholder="Procurar pelo BI..." aria-label="Search" aria-describedby="basic-addon2" maxlength="14" id="procurarbipago" v-model="procurarbipago" @keyup="procurarAluno"  onkeydown="pulsar(event)">       
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
                              <th scope="col" class="text-center text-gray-100" style="width: 50%;">Nome Completo</th>       
                              <th scope="col" class="text-center text-gray-100" style="width: 15%;">Excluir</th>
                              <th scope="col" class="text-center text-gray-100" style="width: 15%;">Informação</th>                   
                          </tr>
                      </thead>
                      <tbody>                                
                          <tr v-for="item in inscricoescompagamento">
                            <td class="text-center">{{item.bi}}</td>
                            <td class="text-center">{{item.nomecompleto}}</td>                                                       
                            <td class="text-center"><button class="btn btn-danger btn-circle" title="Excluir" data-toggle="modal" data-target="#excluirPagamentoModal" @click="Eliminar(item.bi,item.ano)"><i class="fa fa-trash-alt fa-1x"></i></button></td>
                            <td class="text-center"><button class="btn btn-info btn-circle" title="Informação completa" data-toggle="modal" data-target="#infoPagamentoModal" @click="info(item.bi,item.ano,item.valores,item.banco,item.codreferencia,item.useridpaga,item.data)"><i class="fa fa-info-circle fa-1x"></i></button></td>
                          </tr>                          
                      </tbody>
                  </table>

              </div>
            </div>            
            
          </div> <!-- DataTales Example -->
          <!-- Modal Inserir-->
                <div class="modal fade" id="inserirpagoModal" tabindex="-1" role="dialog" aria-labelledby="InserirCurso" aria-hidden="true">
                  <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-uppercase">Novo Pagamento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">BI:</label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control" id="bialunopagar" maxlength="14" @keyup="infoCursos" onkeydown="pulsar(event)">
                            </div>
                            <div class="col-sm-1" v-if="correcto">
                              <a class="btn btn-info btn-circle" title="Informação cursos" @click="MostrarInfo"><i class="fa fa-info-circle fa-1x"></i></a>
                            </div>
                          </div> 
                          <div class="form-group row" v-if="mostrar">
                            <label for="inputEmail3" class="col-sm-6 col-form-label"><b>Regular({{quantD}}):  </b><span v-for="item14 in cursosinscribidos">{{item14.curso}}, </span></label>
                            <label for="inputEmail3" class="col-sm-6 col-form-label"><b>Pos Laboral({{quantP}}):  </b><span v-for="item15 in cursosinscribidosp">{{item15.curso}}, </span></label>            
                          </div>                 
                          <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Ano:</label>
                              <div class="col-sm-8"> 
                                <select id="anopagar" class="form-control" v-model="ano">
                                  <option v-for="item2 in anos">{{item2.ano}}</option>                
                                </select>
                              </div>
                          </div>                       
                          <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Bancos:</label>
                              <div class="col-sm-8"> 
                                <select id="bancopago" class="form-control" v-model="banco">
                                  <option v-for="item3 in bancos">{{item3.nome}}</option>                
                                </select>
                              </div>
                          </div> 
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Valor pago:</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="valorpago" onkeypress='return (event.charCode >= 48 && event.charCode <=57) || (event.charCode==46)'>
                            </div>
                          </div>  
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Código referência:</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="codreferencia">
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
                <div class="modal fade" id="excluirPagamentoModal" tabindex="-1" role="dialog" aria-labelledby="InserirCurso" aria-hidden="true">
                  <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-uppercase">EXCLUIR Pagamento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>Realmente deseja eliminar este Pagamento?</p>
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
                <div class="modal fade" id="infoPagamentoModal" tabindex="-1" role="dialog" aria-labelledby="InformaçãoInscrição" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-uppercase">Informação completa do Pagamento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">                         
                          <div class="col-12">
                            <table id="recibopagamento">
                                <tbody>
                                    <tr>
                                      <td colspan="2" class="text-uppercase" >
                                        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="img/ucclogo.png"></span>
                                      </td>                                      
                                    </tr>
                                    <tr>
                                      <td colspan="2" class="text-uppercase" >
                                        <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UNIVERSIDADE CUITO CUANAVALE</b>
                                      </td>                                        
                                    </tr>
                                    <tr>
                                      <td colspan="2">
                                        <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Recibo de Pagamento de Inscrição Para Exame de Acesso <?php echo date("Y");?> </b>
                                      </td>                                      
                                    </tr>
                                    <tr>
                                      <td style="width: 50%"><b>Bilhete de identidade: </b>{{bii}}</td>
                                      <td style="width: 50%"><b>Ano: </b>{{anoi}}</td>
                                    </tr>
                                    <tr>
                                      <td style="width: 50%"><b>Nome completo: </b>{{nomei}}</td>
                                      <td style="width: 50%"><b>Valor Pago: </b>{{valori}} </td>
                                    </tr> 
                                    <tr> 
                                      <td style="width: 50%"><b>Regular: </b>({{quantD}}) <span v-for="item4 in cursosinscribidos">{{item4.curso}}, </span> </td>
                                      <td style="width: 50%"><b>Banco: </b>{{bancoi}}</td>
                                    </tr> 
                                    <tr>
                                      <td style="width: 50%"><b>Pos Laboral: </b>({{quantP}})<span v-for="item5 in cursosinscribidosp">{{item5.curso}}, </span></td>
                                      <td style="width: 50%"><b>Código: </b>{{codigoi}}</td>
                                    </tr>
                                    <tr>
                                      <td style="width: 50%"><b>Data: </b>{{data}}</td>
                                      <td style="width: 50%"><b>Funcionário: </b>{{nomeidpago}} ({{useridpgai}})</td>
                                    </tr>   

                                    <!-- Outro Recibo --> 
                                    <tr>
                                      <td colspan="2" class="text-center">
                                        <b style="font-size: 18px;">---------------------------------------------------------------------------------------------------</b>
                                      </td>                                      
                                     <tr>
                                      <td colspan="2" class="text-uppercase" >
                                        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="img/ucclogo.png"></span>
                                      </td>                                      
                                    </tr>
                                    <tr>
                                      <td colspan="2" class="text-uppercase" >
                                        <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UNIVERSIDADE CUITO CUANAVALE</b>
                                      </td>                                        
                                    </tr>
                                    <tr>
                                      <td colspan="2">
                                        <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Recibo de Pagamento de Inscrição Para Exame de Acesso <?php echo date("Y");?> </b>
                                      </td>                                    
                                    </tr>                      
                                    <tr>
                                      <td style="width: 50%"><b>Bilhete de identidade: </b>{{bii}}</td>
                                      <td style="width: 50%"><b>Ano: </b>{{anoi}}</td>
                                    </tr>
                                    <tr>
                                      <td style="width: 50%"><b>Nome completo: </b>{{nomei}}</td>
                                      <td style="width: 50%"><b>Valor Pago: </b>{{valori}} </td>
                                    </tr> 
                                    <tr> 
                                      <td style="width: 50%"><b>Regular: </b> ({{quantD}})<span v-for="item6 in cursosinscribidos">{{item6.curso}}, </span></td>
                                      <td style="width: 50%"><b>Banco: </b>{{bancoi}}</td>
                                    </tr> 
                                    <tr>
                                      <td style="width: 50%"><b>Pos Laboral: </b>({{quantP}})<span v-for="item7 in cursosinscribidosp">{{item7.curso}}, </span></td>
                                      <td style="width: 50%"><b>Código: </b>{{codigoi}}</td>
                                    </tr>
                                    <tr>
                                      <td style="width: 50%"><b>Data: </b>{{data}}</td>
                                      <td style="width: 50%"><b>Funcionário: </b>{{nomeidpago}} ({{useridpgai}})</td>
                                    </tr>                          
                                </tbody>
                            </table>
                          </div>                                                      
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                        <button class="btn btn-success imprimir" title="Imprimir" @click="imprimirrecibor"><i class="fa fa-print fa-1x"></i></button>                       
                      </div>
                    </div>
                  </div>
                </div>                     
              </div><!-- Fim Modal Info--> 
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