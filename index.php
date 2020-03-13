<?php 
  session_start();    
?>
<!DOCTYPE html>
<html lang="pt">

<head>

  <?php include  'common_header.php';?>

</head>

<body class="bg-gradient-primary">

  <div class="container" id="users">
    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              
              <div class="col-lg-12">
                <div class="text-center">
                    <h1><b class="text-uppercase">Universidade Cuito Cuanavale</b></h1>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="text-center">
                    <h3>Sistema de Gestão Universitária</h3>
                </div>
              </div>
            </div>
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block" style="background: url('img/cuito.jpg');background-position: center;
  background-size: cover;">                               
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Bem-vindo!!!</h1>
                  </div>
                  <form class="user">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="idnome" placeholder="Entre seu nome de usuário...">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="passwordinicio" placeholder="Entre sua senha..." v-on:keyup.enter="Entrar">
                    </div>
                    
                    <a href="#" class="btn btn-primary btn-user btn-block" @click="Entrar" >
                      Login
                    </a>
                    <hr>
                    <a href="index.html" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Login com Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login com Facebook
                    </a>
                  </form>
                  <hr>
                                  
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <?php include  'common_foot.php';?>

</body>

</html>
