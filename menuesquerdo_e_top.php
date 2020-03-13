
<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="inicio.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-university"></i>
        </div>
        <div class="sidebar-brand-text mx-3">UCC</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="inicio.php">
          <i class="fas fa-fw fa-home"></i>
          <span class="text-uppercase">Inicio</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item" >
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-barcode"></i>
          <span>Ficha de inscrição</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">  
            <a class="collapse-item" href="inscrever.php">Inscrever</a>
             <?php 
               $usurio = $_SESSION['Usuario'];
                if($usurio['tipo']=="1" || $usurio['tipo']=="3"){
            ?>
            <a class="collapse-item" href="pagamento.php">Realizar pagamento</a>
            <?php
            }
            ?>                     
            <h6 class="collapse-header">Elementos Úteis:</h6>
            <a class="collapse-item" href="aluno.php">Aluno</a>
            <a class="collapse-item" href="curso.php">Curso</a>
            <a class="collapse-item" href="procedenciaescolar.php">Procedência</a>
            <a class="collapse-item" href="cursomedio.php">Curso do Ensino Médio</a>
            <a class="collapse-item" href="provincia.php">Província</a>
            <a class="collapse-item" href="municipio.php">Município</a>
            <a class="collapse-item" href="comuna.php">Comuna</a>
            <a class="collapse-item" href="banco.php">Banco</a>
            <a class="collapse-item" href="processo.php">Ano de processo</a>            
          </div>
        </div>
      </li>
      <!-- Nav Item - Utilities Collapse Menu -->
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item" >
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
          <i class="fas fa-fw fa-cog"></i>
          <span>Ferramentas</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">              
            <a class="collapse-item" href="formarturmas.php">Conformar Turmas</a>
            <?php 
               $usurio = $_SESSION['Usuario'];
                if($usurio['tipo']=="4" || $usurio['tipo']=="1"){
            ?>
              <a class="collapse-item" href="notas1.php">Inserir Notas</a> 
              <a class="collapse-item" href="publicarnota1.php">Publicar notas</a>    
            <?php
            }
            ?>    
                             
          </div>
        </div>
      </li>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item" >
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2conv" aria-expanded="true" aria-controls="collapse2conv">
          <i class="fas fa-fw fa-fast-forward"></i>
          <span>Segunda Convocatória</span>
        </a>
        <div id="collapse2conv" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">  
            <a class="collapse-item" href="inscrever2.php">Inscrever</a>
            <a class="collapse-item" href="formarturmas2.php">Conformar Turmas</a>
             <?php 
               $usurio = $_SESSION['Usuario'];
                if($usurio['tipo']=="1" || $usurio['tipo']=="4"){
            ?>
            <a class="collapse-item" href="notas2.php">Inserir Notas</a>
            <a class="collapse-item" href="publicarnota2.php">Publicar Notas</a>
            <?php
            }
            ?>             
          </div>
        </div>
      </li>
      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-bars"></i>
          <span>Relatorios</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Cursos na UCC:</h6>
            <a class="collapse-item" href="relatorio3.php">Geral</a>            
            <h6 class="collapse-header">Procedência escolar:</h6>
            <a class="collapse-item" href="relatorio7.php">Geral</a>            
            <h6 class="collapse-header">Cursos de Procedência:</h6>
            <a class="collapse-item" href="relatorio8.php">Geral</a> 
            <h6 class="collapse-header">Provincias:</h6>
            <a class="collapse-item" href="relatorio9.php">Geral</a>                      
            <h6 class="collapse-header">Outros:</h6>
            <a class="collapse-item" href="relatorio5.php">Pauta Admitidos</a>
            <a class="collapse-item" href="relatorio6.php">Pauta Geral</a>
            <a class="collapse-item" href="relatorio1.php">Inscrições e Pagamentos</a>
            <a class="collapse-item" href="relatorio4.php">Inscrições II</a>
            <a class="collapse-item" href="relatorio2.php">Inscrições sem pagar</a>            
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
     

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item" id="sessao">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-users"></i>
          <span>Usuário</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Opções de Usuários:</h6>
            <?php 
               $usurio = $_SESSION['Usuario'];
                if($usurio['tipo']=="1"){
            ?>
            <a class="collapse-item" href="listadeusuarios.php">Lista de Usuários</a>
            <?php
            }

            ?>   
            <a class="collapse-item" href="trocarsenha.php">Trocar Senha</a>
            <a class="collapse-item" href="#" @click="FecharSessao">Fechar sessão</a>            
          </div>
        </div>
      </li>

      
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" id="sessao2">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Titulo -->
          <div class="justify-content-center">
            <p class="text-uppercase text-gray-500 text-lg">Sistema de Gestão Universitária</p>
          </div>
          

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto"> 
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $usurio['idnome'];?></span>
                <img class="img-profile rounded-circle" src="img/user.ico">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">                
                <a class="dropdown-item" href="trocarsenha.php">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Trocar Senha
                </a>
                
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal" @click="FecharSessao">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Fechar sessão
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->