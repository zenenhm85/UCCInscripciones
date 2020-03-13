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
          <div class="container-fluid" id="paginainicio">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Inicio</h1>
             
            </div>

            <!-- Content Row -->
            <div class="row">

              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Inscrições (Ano Actual )</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{insc}}</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Recebido (Ano Actual )</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{dinheirototal}} KZ</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Earnings (Monthly) Card Example -->
             <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Feminino (Ano Actual )</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{feminino}}</div>           
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-venus-double fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Masculino (Ano Actual )</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{masculino}}</div>           
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-mars-double fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div> 
            </div>
            <!-- Content Provincia, Sexo,Cursos -->
            <div class="row">
              <!-- Content Column -->
              <div class="col-lg-6 mb-4">
                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Províncias</h6>
                  </div>
                  <div class="card-body">
                    <div v-for="item in listaQuantProv">
                      <h4 class="small font-weight-bold">{{item.provincia}} <span class="float-right">{{item.quant}}</span></h4>
                      <div class="progress mb-4">
                        <div class="progress-bar progress-bar-striped bg-info" role="progressbar" v-bind:style="{ width: item.porcento + '%'}"  :aria-valuenow="item.porcento" aria-valuemin="0" aria-valuemax="100">{{item.porcento}}%</div>
                      </div>
                    </div>            
                  </div>
                </div>
                <div class="row">
                  <div class="col mb-4">
                    <div class="card shadow mb-4">
                      <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Resultados segunda convocatória</h6>
                      </div>
                      <div class="card-body">                       
                        <div >
                          <h4 class="small font-weight-bold">Aprovados<span class="float-right">{{aprovadosII}}</span></h4>
                          <div class="progress mb-4">
                            <div class="progress-bar bg-secondary progress-bar-striped" role="progressbar" v-bind:style="{ width: poraprovadosII + '%'}"  :aria-valuenow="poraprovadosII" aria-valuemin="0" aria-valuemax="100">{{poraprovadosII}}%</div>
                          </div>
                        </div>   
                        <div >
                          <h4 class="small font-weight-bold">Reprovados<span class="float-right">{{reprovadosII}}</span></h4>
                          <div class="progress mb-4">
                            <div class="progress-bar bg-secondary progress-bar-striped" role="progressbar" v-bind:style="{ width: porreprovadosII  + '%'}"  :aria-valuenow="porreprovadosII" aria-valuemin="0" aria-valuemax="100">{{porreprovadosII}}%</div>
                          </div>
                        </div>             
                      </div>
                    </div>                    
                  </div>
                </div>                
              </div>  
              <div class="col-lg-6 mb-4">
                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quantidade por Cursos</h6>
                  </div>
                  <div class="card-body">
                    <div v-for="item2 in listaQuantCursos">
                      <h4 class="small font-weight-bold">{{item2.curso}}({{item2.perido}}) <span class="float-right">{{item2.quant}}</span></h4>
                      <div class="progress mb-4">
                        <div class="progress-bar progress-bar-striped" role="progressbar" v-bind:style="{ width: item2.porcento + '%'}"  :aria-valuenow="item2.porcento" aria-valuemin="0" aria-valuemax="100">{{item2.porcento}}%</div>
                      </div>
                    </div>            
                  </div>
                </div><br><br>
                <div class="row">
                  <div class="col mb-4">
                    <div class="card shadow mb-4">
                      <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Sexo</h6>
                      </div>
                      <div class="card-body">                       
                        <div >
                          <h4 class="small font-weight-bold">Feminino<span class="float-right">{{feminino}}</span></h4>
                          <div class="progress mb-4">
                            <div class="progress-bar bg-success progress-bar-striped" role="progressbar" v-bind:style="{ width: porfemenino + '%'}"  :aria-valuenow="porfemenino" aria-valuemin="0" aria-valuemax="100">{{porfemenino}}%</div>
                          </div>
                        </div>   
                        <div >
                          <h4 class="small font-weight-bold">Masculino<span class="float-right">{{masculino}}</span></h4>
                          <div class="progress mb-4">
                            <div class="progress-bar bg-success progress-bar-striped" role="progressbar" v-bind:style="{ width: pormasculino  + '%'}"  :aria-valuenow="pormasculino" aria-valuemin="0" aria-valuemax="100">{{pormasculino}}%</div>
                          </div>
                        </div>             
                      </div>
                    </div>                    
                  </div>
                </div><br>
                <div class="row">
                  <div class="col mb-4">
                    <div class="card shadow mb-4">
                      <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Trabalhador</h6>
                      </div>
                      <div class="card-body">                       
                        <div >
                          <h4 class="small font-weight-bold">Sim<span class="float-right">{{sim}}</span></h4>
                          <div class="progress mb-4">
                            <div class="progress-bar bg-secondary progress-bar-striped" role="progressbar" v-bind:style="{ width: porsim + '%'}"  :aria-valuenow="porsim" aria-valuemin="0" aria-valuemax="100">{{porsim}}%</div>
                          </div>
                        </div>   
                        <div >
                          <h4 class="small font-weight-bold">Não<span class="float-right">{{nao}}</span></h4>
                          <div class="progress mb-4">
                            <div class="progress-bar bg-secondary progress-bar-striped" role="progressbar" v-bind:style="{ width: pornao  + '%'}"  :aria-valuenow="pornao" aria-valuemin="0" aria-valuemax="100">{{pornao}}%</div>
                          </div>
                        </div>             
                      </div>
                    </div>                    
                  </div>
                </div>   <br>
                <div class="row">
                  <div class="col mb-4">
                    <div class="card shadow mb-4">
                      <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Resultados primeira convocatória</h6>
                      </div>
                      <div class="card-body">                       
                        <div >
                          <h4 class="small font-weight-bold">Aprovados<span class="float-right">{{aprovados}}</span></h4>
                          <div class="progress mb-4">
                            <div class="progress-bar bg-warning progress-bar-striped" role="progressbar" v-bind:style="{ width: poraprovados + '%'}"  :aria-valuenow="poraprovados" aria-valuemin="0" aria-valuemax="100">{{poraprovados}}%</div>
                          </div>
                        </div>   
                        <div >
                          <h4 class="small font-weight-bold">Reprovados<span class="float-right">{{reprovados}}</span></h4>
                          <div class="progress mb-4">
                            <div class="progress-bar bg-warning progress-bar-striped" role="progressbar" v-bind:style="{ width: porreprovados  + '%'}"  :aria-valuenow="porreprovados" aria-valuemin="0" aria-valuemax="100">{{porreprovados}}%</div>
                          </div>
                        </div>             
                      </div>
                    </div>                    
                  </div>
                </div>               
              </div> 
            </div>
            <!-- Content Cursos -->   
            <!-- Content Procedencia, Curso ensino meio,Cursos -->
            <div class="row">
              <!-- Content Column -->
              <div class="col-lg-6 mb-4">
                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quantidade de inscritos</h6>
                  </div>
                  <div class="card-body">
                    <div v-for="item in listaQuantProcedencia">
                      <h4 class="small font-weight-bold">{{item.procedencia}} <span class="float-right">{{item.quant}}</span></h4>
                      <div class="progress mb-4">
                        <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" v-bind:style="{ width: item.porcento + '%'}"  :aria-valuenow="item.porcento" aria-valuemin="0" aria-valuemax="100">{{item.porcento}}%</div>
                      </div>
                    </div>            
                  </div>
                </div> 
                <div class="row">
                  <div class="col-12">
                    <div class="card shadow mb-4">
                      <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Resultados (média geral) por Procedência Escolar de Ensino Médio (I)</h6>
                      </div>
                      <div class="card-body">
                        <div v-for="item in listaQuantProcedenciaProm">
                          <h4 class="small font-weight-bold">{{item.procedencia}} <span class="float-right">{{item.media}}</span></h4>
                          <div class="progress mb-4">
                            <div class="progress-bar progress-bar-striped bg-info" role="progressbar" v-bind:style="{ width: item.media * 5 + '%'}"  :aria-valuenow="item.media" aria-valuemin="0" aria-valuemax="100">{{item.media}}</div>
                          </div>
                        </div>            
                      </div>
                    </div>                   
                  </div>              
                </div>    
                 <div class="row">
                  <div class="col-12">
                    <div class="card shadow mb-4">
                      <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Resultados (média geral) por Procedência Escolar de Ensino Médio (II)</h6>
                      </div>
                      <div class="card-body">
                        <div v-for="item in listaQuantProcedenciaPromII">
                          <h4 class="small font-weight-bold">{{item.procedencia}} <span class="float-right">{{item.media}}</span></h4>
                          <div class="progress mb-4">
                            <div class="progress-bar progress-bar-striped bg-info" role="progressbar" v-bind:style="{ width: item.media * 5 + '%'}"  :aria-valuenow="item.media" aria-valuemin="0" aria-valuemax="100">{{item.media}}</div>
                          </div>
                        </div>            
                      </div>
                    </div>                   
                  </div>              
                </div>                    
              </div>  
              <div class="col-lg-6 mb-4">
                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Curso do Ensino Médio</h6>
                  </div>
                  <div class="card-body">
                    <div v-for="item2 in listaQuantEnsinoMedio">
                      <h4 class="small font-weight-bold">{{item2.cursomedio}}<span class="float-right">{{item2.quant}}</span></h4>
                      <div class="progress mb-4">
                        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" v-bind:style="{ width: item2.porcento + '%'}"  :aria-valuenow="item2.porcento" aria-valuemin="0" aria-valuemax="100">{{item2.porcento}}%</div>
                      </div>
                    </div>            
                  </div>
                </div>                   
              </div> 
            </div>
            <!-- Content Cursos -->                   
          </div>
          <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
        <?php include  'footer.php';?>

       

      </div>
      <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    

    <?php include  'common_foot.php';?>

  </body>

</html>
