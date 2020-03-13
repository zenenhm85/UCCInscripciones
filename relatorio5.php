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
        <div class="container-fluid" id="relatorio5">
          <!-- Page Heading -->
          <div class="row">
            <div class="col-1">
              <div class="form-group row">                
                <div class="col-sm-12"> 
                  <select id="anoturmanota" class="form-control" v-model="ano">
                    <option v-for="item in anos">{{item.ano}}</option>                
                  </select>
                </div>
              </div>    
            </div> 
            <div class="col-2">              
              <div class="form-group row">
                <div class="col-sm-12"> 
                  <select id="periodoturmanota" class="form-control" v-model="periodo">
                    <option value="Regular" selected>Regular</option> 
                    <option value="Pos Laboral">Pos Laboral</option>               
                  </select>
                </div>
              </div>    
            </div>
            <div class="col-1">
              <button  class="btn btn-primary" @click="listarNotas">Aceitar</button>
            </div>          
            <div class="col-4">
              <h1 class="h3 mb-0 text-gray-800 text-uppercase text-center float-center">Notas Admitidos</h1>
            </div>
            <div class="col-1">              
              <div class="form-group row">                
                <div class="col-sm-12"> 
                  <button  class="btn btn-primary fa-1x  btn-circle" title="Imprimir tudo" @click="Imprimir"><i class="fa fa-print" ></i></button>
                </div>
              </div>   
            </div>    
            <div class="col-3">              
              <div class="form-group row">                
                <div class="col-sm-12"> 
                  <select id="cursoturmanota" class="form-control" v-model="curso">
                    <option v-for="item in cursos">{{item.nome}}</option>                
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
                  <table class="table table-bordered table-hover" id="notasadmitidos">
                      <thead class="bg-gradient-primary">                        
                        <tr>
                          <th scope="col" class="text-center text-gray-100" style="width: 10%;">Nº</th>
                          <th scope="col" class="text-center text-gray-100" style="width: 40%;">Nome</th>
                          <th scope="col" class="text-center text-gray-100" style="width: 20%;">Bilhete de identidade</th> 
                          <th scope="col" class="text-center text-gray-100" style="width: 10%;">Nota</th> 
                          <th scope="col" class="text-center text-gray-100" style="width: 20%;">Convocatoria</th>              
                        </tr>
                      </thead>
                      <tbody>                                                     
                        <tr v-for="item in listanotas">
                          <td class="text-center">{{item.no}}</td> 
                          <td class="text-center">{{item.nomecompleto}}</td>
                          <td class="text-center">{{item.bi}}</td>
                          <td class="text-center">{{item.notafinal}}</td>
                          <td class="text-center">{{item.convocatoria}}</td>                                               
                        </tr>                          
                      </tbody>
                  </table>
              </div>
            </div>      
          </div> <!-- DataTales Example -->   

           <!-- Inicio Modal Exportar Notas--> 

             <div class="modal fade" id="infoNotasExportar" tabindex="-1" role="dialog" aria-labelledby="InformaçãoInscrição" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-uppercase">Notas dos Admitidos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">                         
                          <div class="col-12">
                            <table border="1"  id="exportarnotasadmitidos" class="table  table-bordered" cellspacing="0" width="100%">
                                <tr>
                                  <td colspan="5" class="text-center text-uppercase">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RESULTADO DOS EXAMES DE ACESSO(Só Admitidos)</td>
                                </tr> 
                                <tr>
                                  <td colspan="5" class="text-center"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Exame de Acesso {{ano}}</b></td>
                                </tr>                                  
                                <tr>                                  
                                  <td colspan="5"><b>Curso</b>: {{curso}}</td>                       
                                </tr>
                                <tr>                                  
                                  <td colspan="5"><b>Período</b>: {{periodo}}</td>                      
                                </tr>
                                <tr>                                  
                                  <td colspan="5"><b>Ano</b>: {{ano}}</td>                      
                                </tr>                            
                                <tr>
                                  <td scope="col" class="text-center" style="width: 10%;"><b>No</b></td>        
                                  <td scope="col" class="text-center" style="width: 35%;"><b>Nome</b></td>
                                  <td scope="col" class="text-center" style="width: 20%;"><b>BI</b></td>
                                  <td scope="col" class="text-center" style="width: 15%;"><b>Resultado</b></td>
                                  <td scope="col" class="text-center" style="width: 20%;"><b>Convocatoria</b></td>
                                </tr>               
                                <tr v-for="item in listanotas">
                                  <td class="text-center">{{item.no}}</td>                            
                                  <td class="text-center">{{item.nomecompleto}}</td> 
                                  <td class="text-center">{{item.bi}}</td> 
                                  <td class="text-center">{{item.notafinal}}</td> 
                                  <td class="text-center">{{item.convocatoria}}</td>                             
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
              </div><!-- Fim Modal Exportar Notas--> 

        </div><!-- Fim  Fluid-->
            
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