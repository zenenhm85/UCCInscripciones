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
        <div class="container-fluid" id="publicarnota1">
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
              <h1 class="h3 mb-0 text-gray-800 text-uppercase text-center float-center">Publicar Notas</h1>
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
                  <table class="table table-bordered table-hover" id="resultadosnota1">
                      <thead class="bg-gradient-primary">                        
                        <tr>
                          <th scope="col" class="text-center text-gray-100" style="width: 5%;">Nº</th>
                          <th scope="col" class="text-center text-gray-100" style="width: 40%;">Nome</th>
                          <th scope="col" class="text-center text-gray-100" style="width: 15%;">Bilhete de identidade</th> 
                          <th scope="col" class="text-center text-gray-100" style="width: 10%;">Nota</th> 
                          <th scope="col" class="text-center text-gray-100" style="width: 15%;">Apto</th>
                          <th scope="col" class="text-center text-gray-100" style="width: 15%;">Admitido</th> 

                        </tr>
                      </thead>
                      <tbody>                                                     
                        <tr v-for="item in listanotas">
                          <td class="text-center">{{item.no}}</td> 
                          <td class="text-center">{{item.nomecompleto}}</td>
                          <td class="text-center">{{item.bi}}</td>
                          <td class="text-center">{{item.nota1}}</td> 
                          <td class="text-center">{{item.apto}}</td>                         
                          <td class="text-center" v-if="item.admitido == 1">
                            <button type="button" class="btn btn-primary btn-sm" >Sim</button>
                            <button type="button" class="btn btn-secondary btn-sm" @click="Admitir(item.bi,0)">Não</button>
                          </td>
                          <td class="text-center" v-if="item.admitido == 0">
                            <button type="button" class="btn btn-secondary btn-sm" @click="Admitir(item.bi,1)">Sim</button>
                            <button type="button" class="btn btn-primary btn-sm">Não</button>
                          </td>                                                  
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
                        <h5 class="modal-title text-uppercase">Informação completa das Notas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">                         
                          <div class="col-12">
                            <table border="1"  id="exportarnotas" class="table  table-bordered" cellspacing="0" width="100%">
                                <tr style="border: hidden; justify-content: center;align-items: center;">
                                  <td colspan="6" class="text-center text-uppercase" style="border: hidden;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="img/cuito4.jpg"></td>
                                </tr> 
                                <tr style="border: hidden;">
                                  <td colspan="6" class="text-center text-uppercase" style="border: hidden;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UNIVERSIDADE CUITO CUANAVALE </td>
                                </tr> 
                                <tr style="border: hidden;">
                                  <td colspan="6" class="text-center text-uppercase" style="border: hidden;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;COMISSÃO INSTITUCIONAL PARA O EXAME DE ACESSO {{ano}}</td>
                                </tr> 
                                <tr style="border: hidden;">
                                  <td colspan="6" class="text-center text-uppercase" style="border: hidden;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SUB-COMISSÃO DE LANÇAMENTO E VERIFICAÇÃO <br> <br> <br></td>
                                </tr> 
                                <tr style="border: hidden;" >
                                  <td colspan="6" class="text-center text-uppercase" style="border: hidden;">HOMOLOGAÇÃO <br> <br></td>
                                </tr> 
                                <tr style="border: hidden;" >
                                  <td colspan="6" class="text-center text-uppercase" style="border: hidden;">O REITOR:______________________________ <br> <br></td>
                                </tr>
                                
                                <tr>
                                  <td colspan="6" class="text-center text-uppercase">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RESULTADO DOS EXAMES DE ACESSO {{ano}}</td>
                                </tr>                                                               
                                <tr>                                  
                                  <td colspan="6"><b>Curso</b>: {{curso}}</td>                       
                                </tr>
                                <tr>                                  
                                  <td colspan="6"><b>Período</b>: {{periodo}}</td>                      
                                </tr>
                                <tr>                                  
                                  <td colspan="6"><b>Ano</b>: {{ano}}</td>                      
                                </tr>                            
                                <tr>
                                  <td scope="col" class="text-center" style="width: 6%;"><b>No</b></td>        
                                  <td scope="col" class="text-center" style="width: 43%;"><b>Nome</b></td>
                                  <td scope="col" class="text-center" style="width: 20%;"><b>BI</b></td>
                                  <td scope="col" class="text-center" style="width: 7%;"><b>Nota</b></td>
                                  <td scope="col" class="text-center" style="width: 10%;"><b>Apto</b></td>
                                  <td scope="col" class="text-center" style="width: 14%;"><b>OBS</b></td>
                                </tr>               
                                <tr v-for="item in listanotas">
                                  <td class="text-center">{{item.no}}</td>                            
                                  <td class="text-center">{{item.nomecompleto}}</td> 
                                  <td class="text-center">{{item.bi}}</td> 
                                  <td class="text-center">{{item.nota1}}</td>  
                                  <td class="text-center">{{item.apto}}</td> 
                                  <td class="text-center" v-if="item.admitido == 1">Admitido</td>
                                  <td class="text-center" v-else>Não Admitido</td>                                  
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

  <?php include  'common_foot.php';?>  



</body>

</html>