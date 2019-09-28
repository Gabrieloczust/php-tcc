<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title><?= $viewName ?></title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= CSS ?>sb-admin-2.min.css" rel="stylesheet">
  <link href="<?= CSS ?>style.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= HOME ?>">
        <div class="sidebar-brand-icon">
          <img src="<?= IMG ?>logo.png" alt="Logo" class="logo">
        </div>
        <div class="sidebar-brand-text mx-3">MyTCC</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Meus Projetos -->
      <li class="nav-item">
        <a class="nav-link" href="<?= HOME ?>">
          <i class="fas fa-fw fa-paste"></i>
          <span>Meus Projetos</span>
        </a>
      </li>

      <!-- Nav Item - Novo Projeto -->
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#projectModal">
          <i class="fas fa-fw fa-folder-plus"></i>
          <span>Novo Projeto</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Outros Projetos -->
      <li class="nav-item">
        <a class="nav-link" href="<?= HOME ?>biblioteca">
          <i class="fas fa-fw fa-book"></i>
          <span>Biblioteca de Projetos</span>
        </a>
      </li>

      <!-- Nav Item - Configurações -->
      <li class="nav-item">
        <a class="nav-link" href="<?= HOME ?>configuracoes">
          <i class="fas fa-fw fa-cogs"></i>
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
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3</span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Notificações
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">Setembro 20, 2019</div>
                    <span class="font-weight-bold">Novo projeto adicionado!</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">Setembro 18, 2019</div>
                    Alguma notificação qualquer!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">Setembro 15, 2019</div>
                    Alguma notificação qualquer!
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Ver Todas</a>
              </div>
            </li>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">4+</span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Convites
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <div class="rounded-circle btn-circle btn-danger">A</div>
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Convite para o Projeto Minha Casa</div>
                    <div class="small text-gray-500">Ana Maria · 58m</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <div class="rounded-circle btn-circle btn-info">J</div>
                    <div class="status-indicator"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Convite para o TCC Curitiba</div>
                    <div class="small text-gray-500">Jose Marcos · 1d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <div class="rounded-circle btn-circle btn-primary">J</div>
                    <div class="status-indicator bg-warning"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Convite para o TCC New</div>
                    <div class="small text-gray-500">João Carlos · 2d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <div class="rounded-circle btn-circle btn-warning">D</div>
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Convite para o Projeto Dog</div>
                    <div class="small text-gray-500">Dog · 4d</div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Ver Todos</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $nome ?></span>
                <div class="img-profile rounded-circle btn-circle btn-primary"><?= $letra ?></div>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Perfil
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
          <div class="container-fluid">

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
              <span>Copyright &copy; MyTCC 2019</span>
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

    <!-- New Project Modal-->
    <div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="projectModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="projectModalLabel">Novo Projeto</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="title" class="text-primary">Título do Projeto: </label>
              <input type="text" id="title" class="form-control" placeholder="Título..." name="titulo" required/>
            </div>
            <div class="form-group form-group-colega">
              <label for="inviteColegas" class="text-primary">Convidar Colegas: </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text text-white bg-primary border-0">Colega</div>
                </div>
                <input type="text" id="inviteColegas" class="form-control" placeholder="E-mail do Colega 1" name="emailColega[]" />
                <div class="input-group-append input-add-colega">
                  <a class="input-group-text text-white bg-primary border-0" title="Convidar outro Colega">+</a>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="inviteCoordenador" class="text-primary">Convidar Professores: </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text text-white bg-primary border-0">Coordenador</div>
                </div>
                <input type="text" id="inviteCoordenador" class="form-control" placeholder="E-mail do Professor Coordenador" name="emailProfessor" />
              </div>
            </div>
            <div class="form-group form-group-avaliador">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text text-white bg-primary border-0">Avaliador</div>
                </div>
                <input type="text" class="form-control" placeholder="E-mail do Professor Avaliador 1" name="emailAvaliador[]" />
                <div class="input-group-append input-add-avaliador">
                  <a class="input-group-text text-white bg-primary border-0" title="Convidar outro Avaliador">+</a>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-primary" href="#">Convidar e Criar</a>
          </div>
        </div>
      </div>
    </div>

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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= JS ?>sb-admin-2.min.js"></script>

</body>

</html>