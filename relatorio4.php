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
        <div class="container-fluid" id="relatorio4">

          <!-- Page Heading -->
          <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
              <div >              
                <h1 class="h3 mb-0 text-gray-800 text-uppercase text-center float-center">Inscrições II</h1>
              </div>
            </div>
            <div class="col-2">              
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