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
        <div class="container-fluid" id="relatorio1">

          <!-- Page Heading -->
          <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
              <div >              
                <h1 class="h3 mb-0 text-gray-800 text-uppercase text-center float-center">Inscrições e Pagamentos</h1>
              </div>
            </div>
            <div class="col-2">
              <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Data:</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="daterel1" @change="quantidadeInscporData" value="<?php echo date("Y-m-d");?>">
                  </div>
                </div> 
            </div>
          </div>          
          <p></p>   
          <!-- DataTales Inscrições -->
          <div class="card shadow mb-4">                
            <div class="row">
              <div class="col">
                  <table class="table table-bordered table-hover">
                      <thead class="bg-gradient-primary">
                          <tr>
                              <th scope="col" class="text-center text-gray-100">Nome Completo</th>                              
                              <th scope="col" class="text-center text-gray-100">Identificador de usuário</th>
                              <th scope="col" class="text-center text-gray-100">Quantidade</th>                             
                          </tr>
                      </thead>
                      <tbody>                                
                          <tr v-for="item in lista">
                            <td class="text-center">{{item.nome}}</td>
                            <td class="text-center">{{item.idusuario}}</td>
                            <td class="text-center">{{item.quant}}</td>                                         
                          </tr>                          
                      </tbody>
                  </table>

              </div>
            </div>            
          </div> <!-- DataTales Inscrições -->  
          <!-- DataTales Pagamentos -->
          <div class="card shadow mb-4">
            <div class="row">
              <div class="col">
                <h4 class="h4 mb-0 text-gray-800 text-uppercase text-center float-center">Pagamentos</h4>
              </div>
            </div>            
            <div class="row">
              <div class="col">
                  <table class="table table-bordered table-hover">
                      <thead class="bg-gradient-primary">
                          <tr>
                              <th scope="col" class="text-center text-gray-100">Nome Completo</th>                              
                              <th scope="col" class="text-center text-gray-100">Identificador de usuário</th>
                              <th scope="col" class="text-center text-gray-100">Quantidade</th>                             
                          </tr>
                      </thead>
                      <tbody>                                
                          <tr v-for="item2 in lista2">
                            <td class="text-center">{{item2.nome}}</td>
                            <td class="text-center">{{item2.idusuario}}</td>
                            <td class="text-center">{{item2.quant}}</td>                                         
                          </tr>                          
                      </tbody>
                  </table>

              </div>
            </div>            
          </div> <!-- DataTales Pagamentos --> 
          <div class="card shadow mb-4">                    
            <div class="row">
              <div class="col">
                  <table class="table table-bordered table-hover">
                      <thead class="bg-gradient-primary">
                          <tr>
                              <th scope="col" class="text-center text-gray-100">Inscrições Total</th>                      
                              <th scope="col" class="text-center text-gray-100">Pagamentos Total</th>
                              <th scope="col" class="text-center text-gray-100">Inscrições Hoje</th>
                                                           
                          </tr>
                      </thead>
                      <tbody>                                
                          <tr >
                            <td class="text-center"><b>{{insc}}</b></td>
                            <td class="text-center"><b>{{paga}}</b></td>  
                            <td class="text-center"><b>{{totalinscpordata}}</b></td>                             
                          </tr>                          
                      </tbody>
                  </table>
              </div>
            </div>            
          </div> <!-- DataTales Pagamentos -->                 
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