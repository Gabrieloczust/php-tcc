<div class="row">
  <div class="col-12 mb-2">
    <div class="card border-left-primary shadow py-2 mb-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="h5 mb-0 font-weight-bold text-primary text-uppercase mb-1">PROJETO: <?= $projeto['titulo'] ?></div>
            <div class="text-xs font-weight-bold text-uppercase">ORIENTADOR: <b><?= $projeto['nome'] ?></b></div>
            <div class="text-xs font-weight-bold text-uppercase">ALUNO(S): <b><?= $projeto['alunosParticipantes'] ?></b></div>
            <div class="text-xs font-weight-bold text-uppercase">INÍCIO: <b><?= date("d/m/y", strtotime($projeto['data_criacao'])) ?></b></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12">
    <?php
    foreach ($successes as $s) {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . $s . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>';
    }
    foreach ($warnings as $w) {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $w . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>';
    }
    foreach ($errors as $e) {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $e . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>';
    }
    ?>
  </div>
</div>

<div class="accordion" id="accordionExample">
  <div class="row mb-3">
    <div class="col-6">
      <div class="accordion-menu accordion-menu-warning" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Entregas Pendentes
        <span class="badge badge-warning badge-pill"><?= count($pendentes) ?></span>
      </div>
    </div>
    <div class="col-6">
      <div class="accordion-menu accordion-menu-success" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Entregas Realizadas
        <span class="badge badge-success badge-pill"><?= count($realizadas) + count($avaliados) ?></span>
      </div>
    </div>
  </div>

  <div id="collapseOne" class="row collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
    <?php if (count($pendentes) > 0) : foreach ($pendentes as $entrega) : ?>
        <div class="col-12">
          <div class="card card-entrega entrega-modal border-left-warning shadow py-2 pointer mb-3" rel="<?= $entrega['idProjetoEntrega'] ?>" data-titulo="<?= $entrega['titulo'] ?>" data-descricao="<?= $entrega['descricao'] ?>" title="Enviar Documento">
            <div class=" card-body">
              <div class="row no-gutters align-items-center">
                <div class="col d-flex align-items-center">
                  <i class="fas fa-exclamation-circle fa-2x text-warning mr-3"></i>
                  <div>
                    <div class="h5 mb-0 font-weight-bold text-uppercase text-warning">
                      <?= $entrega['titulo'] ?>
                    </div>
                    <div class="text-xs font-weight-bold text-gray-800 text-uppercase">
                      DATA DE ENTREGA: <?= date("d/m/y", strtotime($entrega['data_entrega'])) ?>
                    </div>
                  </div>
                </div>
                <div class="col-auto text-center text-warning">
                  <i class="fas fa-upload fa-2x"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach;
      else : ?>
      <div class="col">
        <div class="alert alert-warning text-center">Você não possui nenhuma entrega pendente!</div>
      </div>
    <?php endif; ?>
  </div>

  <div id="collapseTwo" class="row collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
    <?php if (count($realizadas) > 0 || count($avaliados) > 0) : ?>
      <?php foreach ($realizadas as $entrega) : ?>
        <div class="col-12">
          <a class="card card-entrega border-left-info dark-off shadow py-2 mb-3" download href="<?= HOME ?>assets/uploads/<?= $entrega['idProjetoEntrega'] . '/' . $entrega['documento'] ?>" title="Baixa Documento">
            <div class=" card-body">
              <div class="row no-gutters align-items-center">
                <div class="col d-flex align-items-center">
                  <i class="fas fa-clock fa-2x text-info mr-3 dark-off"></i>
                  <div>
                    <div class="h5 mb-0 font-weight-bold text-uppercase text-info dark-off">
                      <?= $entrega['titulo'] ?>
                    </div>
                    <div class="text-xs font-weight-bold text-gray-800 text-uppercase">
                      ENTREGUE POR <b><?= $entrega['nome'] ?></b> NO DIA <b><?= date("d/m/y", strtotime($entrega['data'])) ?></b>
                    </div>
                    <div class="text-xs font-weight-bold text-info text-uppercase">
                      <?= $entrega['notaStatus'] ?>
                    </div>
                  </div>
                </div>
                <div class="col-auto text-center text-info">
                  <i class="fas fa-download fa-2x"></i>
                </div>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
      <?php foreach ($avaliados as $avaliado) : ?>
        <div class="col-12">
          <a class="card card-entrega border-left-success dark-off shadow py-2 mb-3" download href="<?= HOME ?>assets/uploads/<?= $avaliado['idProjetoEntrega'] . '/' . $avaliado['documento'] ?>" title="Baixa Documento">
            <div class=" card-body">
              <div class="row no-gutters align-items-center">
                <div class="col d-flex align-items-center">
                  <i class="fas fa-check-circle fa-2x text-success mr-3 dark-off"></i>
                  <div>
                    <div class="h5 mb-0 font-weight-bold text-uppercase text-success dark-off">
                      <?= $avaliado['titulo'] ?>
                    </div>
                    <div class="text-xs font-weight-bold text-gray-800 text-uppercase">
                      ENTREGUE POR <b><?= $avaliado['nome'] ?></b> NO DIA <b><?= date("d/m/y", strtotime($avaliado['data'])) ?></b>
                    </div>
                    <div class="text-xs font-weight-bold text-info text-uppercase">
                      <?= $avaliado['notaStatus'] ?>
                    </div>
                  </div>
                </div>
                <div class="col-auto text-center text-success">
                  <i class="fas fa-download fa-2x"></i>
                </div>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    <?php else : ?>
      <div class="col">
        <div class="alert alert-warning text-center">Você não possui nenhuma entrega realizada!</div>
      </div>
    <?php endif; ?>
  </div>
</div>

<!-- Modal Entrega -->
<div class="modal fade" id="entregaModal" tabindex="-1" role="dialog" aria-labelledby="entregaModalLabel" aria-hidden="true">
  <form class="modal-dialog" role="document" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="entrega" value="entrega" />
    <input type="hidden" class="e-id" name="e-id">
    <input type="hidden" id="entregaModalNome" name="e-nome">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary">REALIZAR ENTREGA <span id="entregaModalLabel"></span></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="entregaModalDescricao"></p>
        <div class="custom-file">
          <input type="file" name="fileToUpload" class="custom-file-input" id="fileToUpload" required>
          <label class="custom-file-label mb-0" for="fileToUpload">Escolher arquivo...</label>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" id="btn-editar-titulo">Enviar</button>
      </div>
    </div>
  </form>
</div>