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
        <div class="container-fluid" id="relatorio3">

          <!-- Page Heading -->
          <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
              <div >              
                <h1 class="h3 mb-0 text-gray-800 text-uppercase text-center float-center">Realatorios para cursos da UCC</h1>
              </div>
            </div>
            <div class="col-2">
              <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Ano:</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="anorelatorio3" @change="reiniciar" v-model="ano">
                  </div>
                </div> 
            </div>
          </div>          
          <p></p>   
          <!-- DataTales Inscrições -->     
          <div class="row">
              <!-- Content Column -->              
              <div class="col-lg-12 mb-4">
                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary text-center">Quantidade por Cursos (primeira convocatória)</h6>
                  </div>
                  <div class="card-body">
                    <div v-for="item2 in listaQuantCursos">
                      <h4 class="small font-weight-bold">{{item2.curso}}({{item2.perido}}) <span class="float-right">{{item2.quant}}</span></h4>
                      <div class="progress mb-4">
                        <div class="progress-bar progress-bar-striped" role="progressbar" v-bind:style="{ width: item2.porcento + '%'}"  :aria-valuenow="item2.porcento" aria-valuemin="0" aria-valuemax="100">{{item2.porcento}}%</div>
                      </div>
                    </div>            
                  </div>
                </div>         
              </div> 
            </div>   
            <div class="row">
              <!-- Content Column -->              
              <div class="col-lg-12 mb-4">
                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary text-center">Quantidade por Cursos (segunda convocatória)</h6>
                  </div>
                  <div class="card-body">
                    <div v-for="item2 in listaQuantCursosII">
                      <h4 class="small font-weight-bold">{{item2.curso}}({{item2.perido}}) <span class="float-right">{{item2.quant}}</span></h4>
                      <div class="progress mb-4">
                        <div class="progress-bar progress-bar-striped" role="progressbar" v-bind:style="{ width: item2.porcento + '%'}"  :aria-valuenow="item2.porcento" aria-valuemin="0" aria-valuemax="100">{{item2.porcento}}%</div>
                      </div>
                    </div>            
                  </div>
                </div>         
              </div> 
            </div>   
            <div class="row" v-for="item3 in cursossexo">
              <!-- Content Column -->              
              <div class="col-lg-12 mb-4">
                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary text-center">Gênero por curso: {{item3.curso}}</h6>
                  </div>
                  <div class="card-body">
                    <div >
                      <h4 class="small font-weight-bold">Masculino<span class="float-right">{{item3.masculino}}</span></h4>
                      <div class="progress mb-4">
                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" v-bind:style="{ width: item3.pormasculino + '%'}"  :aria-valuenow="item3.pormasculino" aria-valuemin="0" aria-valuemax="100">{{item3.pormasculino}}%</div>
                      </div>
                    </div> 
                    <div >
                      <h4 class="small font-weight-bold">Feminino<span class="float-right">{{item3.feminino}}</span></h4>
                      <div class="progress mb-4">
                        <div class="progress-bar progress-bar-striped bg-info" role="progressbar" v-bind:style="{ width: item3.porfemenino + '%'}"  :aria-valuenow="item3.porfemenino" aria-valuemin="0" aria-valuemax="100">{{item3.porfemenino}}%</div>
                      </div>
                    </div>                
                  </div>
                </div>         
              </div> 
            </div>
            <div class="row" v-for="item4 in cursoaprovados">
              <!-- Content Column -->              
              <div class="col-lg-12 mb-4">
                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary text-center">Resultados por curso: {{item4.curso}}(primeira convocatória)</h6>
                  </div>
                  <div class="card-body">
                    <div >
                      <h4 class="small font-weight-bold">Aprovados<span class="float-right">{{item4.aprovados}}</span></h4>
                      <div class="progress mb-4">
                        <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" v-bind:style="{ width: item4.poraprovados + '%'}"  :aria-valuenow="item4.poraprovados" aria-valuemin="0" aria-valuemax="100">{{item4.poraprovados}}%</div>
                      </div>
                    </div> 
                    <div >
                      <h4 class="small font-weight-bold">Reprovados<span class="float-right">{{item4.reprovados}}</span></h4>
                      <div class="progress mb-4">
                        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" v-bind:style="{ width: item4.porreprovados + '%'}"  :aria-valuenow="item4.porreprovados" aria-valuemin="0" aria-valuemax="100">{{item4.porreprovados}}%</div>
                      </div>
                    </div>                
                  </div>
                </div>         
              </div> 
            </div> 
            <div class="row" v-for="item4 in cursoaprovadosII">
              <!-- Content Column -->              
              <div class="col-lg-12 mb-4">
                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary text-center">Resultados por curso: {{item4.curso}}(segunda convocatória)</h6>
                  </div>
                  <div class="card-body">
                    <div >
                      <h4 class="small font-weight-bold">Aprovados<span class="float-right">{{item4.aprovados}}</span></h4>
                      <div class="progress mb-4">
                        <div class="progress-bar progress-bar-striped bg-info" role="progressbar" v-bind:style="{ width: item4.poraprovados + '%'}"  :aria-valuenow="item4.poraprovados" aria-valuemin="0" aria-valuemax="100">{{item4.poraprovados}}%</div>
                      </div>
                    </div> 
                    <div >
                      <h4 class="small font-weight-bold">Reprovados<span class="float-right">{{item4.reprovados}}</span></h4>
                      <div class="progress mb-4">
                        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" v-bind:style="{ width: item4.porreprovados + '%'}"  :aria-valuenow="item4.porreprovados" aria-valuemin="0" aria-valuemax="100">{{item4.porreprovados}}%</div>
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
                    <h6 class="m-0 font-weight-bold text-primary">Resultados (média geral) por Cursos(primeira convocatória)</h6>
                  </div>
                  <div class="card-body">
                    <div v-for="item in listaQuantProcedencia">
                      <h4 class="small font-weight-bold">{{item.curso}} <span class="float-right">{{item.media}}</span></h4>
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
                    <h6 class="m-0 font-weight-bold text-primary">Resultados (média geral) por Cursos(segunda convocatória)</h6>
                  </div>
                  <div class="card-body">
                    <div v-for="item in listaQuantProcedenciaII">
                      <h4 class="small font-weight-bold">{{item.curso}} <span class="float-right">{{item.media}}</span></h4>
                      <div class="progress mb-4">
                        <div class="progress-bar progress-bar-striped bg-info" role="progressbar" v-bind:style="{ width: item.media * 5 + '%'}"  :aria-valuenow="item.media" aria-valuemin="0" aria-valuemax="100">{{item.media}}</div>
                      </div>
                    </div>            
                  </div>
                </div>                   
              </div>              
            </div>                      
        </div>
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