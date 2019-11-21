<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>MeuTCC</title>

  <link rel="shortcut icon" href="<?= IMG ?>favicon.png" />

  <!-- Custom fonts for this template-->
  <link href="<?= VENDOR ?>fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= CSS ?>sb-admin-2.css" rel="stylesheet">
  <link href="<?= CSS ?>style.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="<?= VENDOR ?>datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top" class="temadark-<?= $temaDark ?>">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= HOME ?>">
        <div class="sidebar-brand-icon">
          <img src="<?= IMG ?>logo.png" alt="Logo" class="logo">
        </div>
        <div class="sidebar-brand-text mx-3">MeuTCC</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Meus Projetos -->
      <li class="nav-item <?php if ($viewName == 'projetos' || $viewName == 'projeto') {
                            echo 'active';
                          } ?>">
        <a class="nav-link" href="<?= HOME ?>">
          <i class="fas fa-fw fa-paste"></i>
          <span>Meus Projetos</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Biblioteca Projetos -->
      <li class="nav-item <?php if ($viewName == 'biblioteca') {
                            echo 'active';
                          } ?>">
        <a class="nav-link" href="<?= HOME ?>biblioteca">
          <i class="fas fa-fw fa-book"></i>
          <span>Projetos da Gelera</span>
        </a>
      </li>

      <!-- Nav Item - Configurações -->
      <li class="nav-item <?php if ($viewName == 'configuracoesaluno') {
                            echo 'active';
                          } ?>">
        <a class="nav-link" href="<?= HOME ?>configuracoesaluno">
          <i class="fas fa-fw fa-cog"></i>
          <span>Configurações</span></a>
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
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar projeto..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar projeto..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Convites -->
            <li class="stop-ajax nav-item dropdown no-arrow mx-1" id="convites" data-url="<?= HOME ?>"></li>

            <!-- Nav Item - Notificações -->
            <li class="stop-ajax nav-item dropdown no-arrow mx-1" id="notificacoes" data-url="<?= HOME ?>"></li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $nome ?></span>
                <div class="img-profile rounded-circle btn-circle btn-primary"><?= $letra ?></div>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= HOME ?>configuracoesaluno">
                  <i class="fas fa-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                  Configurações
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Sair
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

          <!-- Begin Page Content -->
          <div id="view" class="container-fluid">

            <!-- Page Heading -->
            <?= $this->loadViewInTemplate($viewName, $viewData); ?>

          </div>
          <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->


        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; MeuTCC 2019</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Pronto para Sair?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Selecione "Sair" se você estiver pronto para encerrar a sessão atual.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-primary" href="<?= HOME ?>logout">Sair</a>
          </div>
        </div>
      </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="<?= VENDOR ?>jquery/jquery.min.js"></script>
    <script src="<?= VENDOR ?>bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= VENDOR ?>jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= VENDOR ?>datatables/jquery.dataTables.min.js"></script>
    <script src="<?= VENDOR ?>datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= JS ?>demo/datatables-demo.js"></script>

    <!-- Validor Form FrontEnd -->
    <script src="<?= JS ?>validator.min.js"></script>
    <script src="<?= JS ?>jquery.mask.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= JS ?>frontend.js"></script>
    <script src="<?= JS ?>ajax.js"></script>

</body>

</html>