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
        <div class="container-fluid" id="turmas2">

          <!-- Page Heading -->
          <div class="row">
            <div class="col-2">
              <div class="form-group row">
                <label class="col-sm-6 col-form-label">Quantidade:</label>
                <div class="col-sm-6">
                  <input type="number" class="form-control" id="quantidade" value="25" v-model="quantidade" min="1">
                </div>
              </div>              
            </div>
            <div class="col-1">
              <button class="btn btn-primary" @click="FormarTurmas">Aceitar</button> 
            </div>
            <div class="col-3"><h1 class="h3 mb-0 text-gray-800 text-uppercase text-center float-center">Turmas II</h1></div>
            <div class="col-1">
              <div class="form-group row">                
                <div class="col-sm-10"> 
                  <select id="anoturma" class="form-control" v-model="ano">
                    <option v-for="item in anos">{{item.ano}}</option>                
                  </select>
                </div>
              </div>    
            </div>
            <div class="col-3">              
              <div class="form-group row">                
                <div class="col-sm-10"> 
                  <select id="cursoturma" class="form-control" v-model="curso">
                    <option v-for="item in cursos">{{item.nome}}</option>                
                  </select>
                </div>
              </div>   
            </div>
            <div class="col-2">              
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Periodo:</label>
                <div class="col-sm-8"> 
                  <select id="periodoturma" class="form-control" v-model="periodo">
                    <option value="Regular" selected>Regular</option> 
                    <option value="Pos Laboral">Pos Laboral</option>               
                  </select>
                </div>
              </div>    
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
                              <th scope="col" class="text-center text-gray-100" style="width: 10%;">No</th>        
                              <th scope="col" class="text-center text-gray-100" style="width: 55%;">Nome Completo</th>
                               <th scope="col" class="text-center text-gray-100" style="width: 30%;">Bilhete de identidade</th>  
                              <th scope="col" class="text-center text-gray-100" style="width: 5%;">Imprimir</th>                
                          </tr>
                      </thead>
                      <tbody>                                
                          <tr v-for="item in lista">
                            <td class="text-center">{{item.no}}</td>                            
                            <td class="text-center">{{item.nomecompleto}}</td>  
                            <td class="text-center">{{item.bi}}</td>
                            <td class="text-center"><button class="btn btn-primary btn-circle" title="Imprimir" @click="Imprimir(item.nomecompleto,item.bi,item.no)"><i class="fa fa-print fa-1x"></i></button></td>                
                          </tr>                          
                      </tbody>
                  </table>
              </div>
            </div>      
          </div> <!-- DataTales Example -->
          
            <div class="row" v-if="pronto">
              <div class="col-1"></div>
              <div class="col-1"></div>
              <div class="col-1 text-center">
                <p class="text-center">Turma(No)</p>
                <p class="text-center">{{turmaX}} de {{turmas}}</p>                
              </div>
              <div class="col-1 text-center">   
                <p class="text-center">Alunos</p>    
                <p class="text-center">{{total}}</p> 
              </div>
              <div class="col-1 text-center">
                <p class="text-center">Anterior</p>  
                <button class="btn bg-gradient-primary btn-md text-gray-100" title="Turma Anterior" @click="TurmaAnterior"><i class="fa fa-arrow-circle-left fa-1x"></i></button>  
              </div> 
              <div class="col-1 text-center">    
                <p class="text-center">Seguinte</p> 
                <button class="btn bg-gradient-primary btn-md text-gray-100" title="Turma Seguinte" @click="TurmaSiguinte"><i class="fa fa-arrow-circle-right fa-1x"></i></button>
              </div>                                  
              <div class="col-1 text-center">
                <p class="text-center">Turma</p> 
                <button class="btn bg-gradient-primary btn-md text-gray-100" title="Exportar(Turma)" data-toggle="modal" data-target="#infoTurmaExportar11111" @click="ExportarTurma"><i class="fa fa-angle-double-up fa-1x" ></i></button>
              </div>
              <div class="col-1 text-center"> 
                 <p class="text-center">Tudo</p>     
                 <button class="btn bg-gradient-success btn-md text-gray-100" title="Exportar(Todo)" @click="ExportarCurso"><i class="fa fa-arrow-circle-up  fa-1x"></i></button>
              </div>
              <div class="col-1 text-center">  
                <p class="text-center">Códigos</p>    
                <button class="btn bg-gradient-primary btn-md text-gray-100" title="Imprimir folha de prova" @click="ImprimirTudo"><i class="fa fa-barcode fa-1x" ></i></button>
              </div>
              <div class="col-1"></div>
              <div class="col-1"></div>
            </div>          
         
          <!-- Formando Turma -->
        
            <div class="row" v-if="pronto">
              
              <div class="col-3">
                 <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Data:</label>
                  <div class="col-sm-7">
                    <input type="date" class="form-control" id="dataturma" v-model="dataaluno">
                  </div>
                </div>               
              </div>
              <div class="col-2">       
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-5 col-form-label">Horas:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="horaturma" value="9h" v-model="horaaluno">
                  </div>
                </div> 
              </div>
              <div class="col-1">
                    
              </div> 
              <div class="col-2">       
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-5 col-form-label">Duração:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="duracaoturma" value="120 min" v-model="duracao">
                  </div>
                </div> 
              </div> 
              <div class="col-2">     
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-6 col-form-label">Turma:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="nometurma" v-model="turmaaluno">
                  </div>
                </div> 
              </div> 
              <div class="col-2">
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-5 col-form-label">Sala:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="nomesala" v-model="salaaluno">
                  </div>
                </div>       
              </div>  
              
            </div>


            <!-- Inicio Modal Info--> 

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
                            <table id="informacaoaluno">
                                <tbody>
                                    <tr>
                                      <td colspan="2" class="text-uppercase" >
                                        <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;INFORMAÇÃO DO ALUNO (<?php echo date("Y");?>)</b>
                                      </td>                                      
                                    </tr>
                                    <tr>
                                      <td><b>Bilhete de identidade: </b>{{bialuno}}</td>
                                      <td><b>Ano: </b>{{anoaluno}}</td>
                                    </tr>
                                    <tr>
                                      <td ><b>Nome completo: </b>{{nomealuno}}</td>
                                      <td ><b>No: </b>{{noaluno}} </td>
                                    </tr> 
                                    <tr> 
                                      <td ><b>Período: </b>{{periodoaluno}} </td>
                                      <td ><b>Curso: </b>{{cursoaluno}}</td>
                                    </tr>                        
                                    <tr> 
                                      <td ><b>Data: </b>{{dataaluno}} </td>
                                      <td ><b>Hora: </b>{{horaaluno}}</td>
                                    </tr>  
                                    <tr> 
                                      <td ><b>Sala: </b>{{salaaluno}} </td>
                                      <td ><b>Turma: </b>{{turmaaluno}}</td>
                                    </tr>
                                                <!-- Outro Recibo --> 
                                    <tr>
                                      <td colspan="2" class="text-center text-uppercase">
                                        <b>------------------------------------------------------------------------------------------------------------</b>
                                      </td>                                      
                                    </tr> 
                                    <tr>
                                      <td colspan="2" class="text-center text-uppercase">
                                        <b>------------------------------------------------------------------------------------------------------------</b>
                                      </td>                                      
                                    </tr> 
                                     <tr>
                                      <td colspan="2" class="text-uppercase" >
                                        <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;INFORMAÇÃO DO ALUNO (<?php echo date("Y");?>)</b>
                                      </td>                                      
                                    </tr>                                    
                                    <tr>
                                      <td>
                                          <svg id="barcode">
                                      </td>   
                                      <td></td>    
                                    </tr>                                                                    
                                    <tr class="text-center">
                                      <td></td>  
                                      <td>
                                          <svg id="barcode2">
                                      </td>                                       
                                    </tr>                                                                       
                                </tbody>
                            </table>
                          </div>                                                      
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>            
                      </div>
                    </div>
                  </div>
                </div>                     
              </div><!-- Fim Modal Info-->

              <!-- Inicio Modal Info Tudo Folha de prova--> 
             <div class="modal fade" id="infobarcode" tabindex="-1" role="dialog" aria-labelledby="InformaçãoInscrição" aria-hidden="true">
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
                            <table id="infobarcodetudo">
                                <tbody v-for="item5 in lista">
                                    <tr >
                                      <td colspan="2" class="text-uppercase" >
                                        <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;INFORMAÇÃO DO ALUNO (<?php echo date("Y");?>)</b>
                                      </td>                                      
                                    </tr>
                                    <tr>
                                      <td><b>Bilhete de identidade: </b>{{item5.bi}}</td>
                                      <td><b>Ano: </b>{{ano}}</td>
                                    </tr>
                                    <tr>
                                      <td ><b>Nome completo: </b>{{item5.nomecompleto}}</td>
                                      <td ><b>No: </b>{{item5.no}} </td>
                                    </tr> 
                                    <tr> 
                                      <td ><b>Período: </b>{{periodo}} </td>
                                      <td ><b>Curso: </b>{{curso}}</td>
                                    </tr>                        
                                    <tr> 
                                      <td ><b>Data: </b>{{dataaluno}} </td>
                                      <td ><b>Hora: </b>{{horaaluno}}</td>
                                    </tr>  
                                    <tr> 
                                      <td ><b>Sala: </b>{{salaaluno}} </td>
                                      <td ><b>Turma: </b>{{turmaaluno}}</td>
                                    </tr>
                                                <!-- Outro Recibo --> 
                                    <tr>
                                      <td colspan="2" class="text-center text-uppercase">
                                        <b>------------------------------------------------------------------------------------------------------------</b>
                                      </td>                                      
                                    </tr>                                     
                                     <tr>
                                      <td colspan="2" class="text-uppercase" >
                                        <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;INFORMAÇÃO DO ALUNO (<?php echo date("Y");?>)</b>
                                      </td>                                      
                                    </tr>                                    
                                    <tr>
                                      <td>
                                          <svg v-bind:id="item5.bi" class="muebarcode"> </svg>
                                      </td>   
                                      <td></td>    
                                    </tr>                                                                    
                                    <tr class="text-center">
                                      <td></td>  
                                      <td>
                                          <svg v-bind:id="item5.bi+1" v-bind:data="item5.bi" class="muebarcode2"></svg>
                                      </td>                                       
                                    </tr>  
                                    <tr>
                                      <td colspan="2" class="text-center text-uppercase">
                                        <b>------------------------------------------------------------------------------------------------------------</b>
                                      </td>                                      
                                    </tr>   
                                    <tr>
                                      <td colspan="2" class="text-center text-uppercase">
                                        <b>------------------------------------------------------------------------------------------------------------</b>
                                      </td>                                      
                                    </tr>                                                                          
                                </tbody>
                            </table>
                          </div>                                                      
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>            
                      </div>
                    </div>
                  </div>
                </div>                     
              </div><!-- Fim Modal Info Tudo Folha de prova--> 

              <!-- Inicio Modal Exportar Turma--> 

             <div class="modal fade" id="infoTurmaExportar" tabindex="-1" role="dialog" aria-labelledby="InformaçãoInscrição" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-uppercase">Informação completa da Turma</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">                         
                          <div class="col-12">
                            <table border="1"  id="exportarexcelturma" class="table  table-bordered" cellspacing="0" width="100%">
                                <tr>
                                  <td colspan="3" class="text-center text-uppercase">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CONSTITUIÇÃO DAS TURMAS</td>
                                </tr> 
                                <tr>
                                  <td colspan="3" class="text-center"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Exame de Acesso {{ano}}</b></td>
                                </tr>  
                                <tr>
                                  
                                  <td colspan="2">Data: {{dataaluno}} Horas: {{horaaluno}}</td>                                  
                                  <td>Duração: {{duracao}}</td>
                                </tr>   
                                <tr>
                                  
                                  <td colspan="2">Turma: {{turmaaluno}}</td>
                                  <td>Sala: {{salaaluno}}</td>
                                                                    
                                </tr>
                                <tr>
                                  
                                  <td colspan="2">Curso: {{curso}}</td>
                                  <td>Período: {{periodo}}</td>              
                                  
                                </tr>
                            
                                <tr>
                                    <td scope="col" class="text-center" style="width: 5%;"><b>No</b></td>        
                                    <td scope="col" class="text-center" style="width: 55%;"><b>Nome Completo</b></td>
                                    <td scope="col" class="text-center" style="width: 30%;"><b>Bilhete de Identidade</b></td>
                                </tr>
                           
                           
                                <tr v-for="item in lista">
                                  <td class="text-center">{{item.no}}</td>                            
                                  <td class="text-center">{{item.nomecompleto}}</td>  
                                  <td class="text-center">{{item.bi}}</td>                                    
                                </tr> 
                                                    
                            </table>
                          </div>                                                      
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>            
                      </div>
                    </div>
                  </div>
                </div>                     
              </div><!-- Fim Modal Exportar Turma--> 


                <!-- Inicio Modal Exportar Curso--> 

             <div class="modal fade" id="infoTurmaExportar" tabindex="-1" role="dialog" aria-labelledby="InformaçãoInscrição" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-uppercase">Informação completa da Turma</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">                         
                          <div class="col-12">
                            <table border="1"  id="exportarcursopdf" class="table  table-bordered" cellspacing="0" width="100%">
                                <tr>
                                  <td colspan="3" class="text-center text-uppercase">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LISTA DE CANDIDATOS AO EXAME DE ACESSO</td>
                                </tr> 
                                <tr>
                                  <td colspan="3" class="text-center"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Exame de Acceso {{ano}}</b></td>
                                </tr>  
                                <tr>                                  
                                  <td colspan="3"><b>Data</b>: {{dataaluno}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Curso</b>: {{curso}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Período</b>: {{periodo}}</td>                                  
                                  
                                </tr>                   
                                <tr>
                                    <td scope="col" class="text-center" style="width: 5%;"><b>No</b></td>        
                                    <td scope="col" class="text-center" style="width: 55%;"><b>Nome Completo</b></td>
                                    <td scope="col" class="text-center" style="width: 30%;"><b>Bilhete de Identidade</b></td>
                                </tr>
                           
                           
                                <tr v-for="item in listacompleta">
                                  <td class="text-center">{{item.no}}</td>                            
                                  <td class="text-center">{{item.nomecompleto}}</td>  
                                  <td class="text-center">{{item.bi}}</td>                                    
                                </tr> 
                                                    
                            </table>
                          </div>                                                      
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>            
                      </div>
                    </div>
                  </div>
                </div>                     
              </div><!-- Fim Modal Exportar Curso--> 

        </div>
            <!-- Fim  Fluid-->
      </div>
  <!-- End of Main Content -->  
  <?php include  'footer.php';?>
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <!-- Logout Modal-->

  <?php include  'common_foot2.php';?>  



</body>

</html>