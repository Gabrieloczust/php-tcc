<div class="d-sm-flex flex-column mb-2">
  <h1 class="h3 mb-2 text-gray-800">
    <a class="text-success" href="<?= HOME ?>turmas">TURMAS</a> -
    <a class="text-success" href="<?= HOME ?>turmas/turma/<?= $entregas[0]['slugTurma'] ?>">
      TURMA <?= $entregas[0]['nome'] ?>
    </a>
    - ENTREGA <?= $entregas[0]['titulo'] ?>
  </h1>
</div>

<div class="card border-left-primary shadow py-2 mb-3">
  <div class="card-body">
    <div class="row no-gutters align-items-center">
      <div class="col mr-2">
        <div class="h5 mb-0 font-weight-bold text-primary text-uppercase mb-1">ENTREGA: <?= $entregas[0]['titulo'] ?></div>
        <div class="text-xs font-weight-bold text-uppercase">DESCRIÇÃO: <?= $entregas[0]['descricao'] ?></b></div>
        <div class="text-xs font-weight-bold text-uppercase">TURMA: <?= $entregas[0]['nome'] ?></b></div>
        <div class="text-xs font-weight-bold text-uppercase">DATA DE ENTREGA: <?= date("d/m/Y", strtotime($entregas[0]['data_entrega'])) ?><b></b></div>
      </div>
      <div class="col-auto">
        <i class="fas fa-clipboard fa-2x text-gray-300"></i>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col">
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
  <div class="row mb-2">
    <div class="col-lg-4 mb-2">
      <div class="accordion-menu accordion-menu-primary" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
        Recebidos
        <span class="badge badge-primary badge-pill"><?= count($entregues) ?></span>
      </div>
    </div>
    <div class="col-lg-4 mb-2">
      <div class="accordion-menu accordion-menu-success" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
        Avaliados
        <span class="badge badge-success badge-pill"><?= count($avaliados) ?></span>
      </div>
    </div>
    <div class="col-lg-4 mb-2">
      <div class="accordion-menu accordion-menu-warning" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
        Pendentes
        <span class="badge badge-warning badge-pill"><?= count($pendentes) ?></span>
      </div>
    </div>
  </div>

  <div id="collapse1" class="row collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
    <?php foreach ($entregues as $entregue) : ?>
      <div class="col-12">
        <div class="card card-entrega entrega-modal border-left-primary shadow py-2 pointer mb-3">
          <div class=" card-body">
            <div class="row no-gutters align-items-center">
              <div class="col d-flex align-items-center">
                <div>
                  <div class="h5 mb-0 font-weight-bold text-uppercase text-primary">
                    PROJETO <?= $entregue['titulo'] ?>
                  </div>
                  <div class="text-xs font-weight-bold text-gray-800 text-uppercase">
                    DIA QUE FOI ENTREGUE <?= date("d/m/Y", strtotime($entregue['data'])) ?>
                  </div>
                </div>
              </div>
              <div class="col-auto text-center">
                <a class="btn btn-primary" download href="<?= HOME ?>assets/uploads/<?= $entregue['idProjetoEntrega'] . '/' . $entregue['documento'] ?>" title="Baixa Documento">BAIXAR</a>
                <button class="btn btn-success btn-avaliar" rel="<?= $entregue['idProjetoEntrega'] ?>" data-projeto="<?= $entregue['titulo'] ?>">AVALIAR</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <div id="collapse2" class="row collapse hide" aria-labelledby="headingOne" data-parent="#accordionExample">
    <?php foreach ($avaliados as $avaliado) : ?>
      <div class="col-12">
        <div class="card card-entrega entrega-modal border-left-success shadow py-2 pointer mb-3">
          <div class=" card-body">
            <div class="row no-gutters align-items-center">
              <div class="col d-flex align-items-center">
                <div>
                  <div class="h5 mb-0 font-weight-bold text-uppercase text-success">
                    <?= $avaliado['titulo'] ?>
                  </div>
                  <div class="text-xs font-weight-bold text-gray-800 text-uppercase">
                    NOTA: <?= $avaliado['nota'] ?>
                  </div>
                </div>
              </div>
              <div class="col-auto text-center text-success">
                <a class="btn btn-primary" download href="<?= HOME ?>assets/uploads/<?= $avaliado['idProjetoEntrega'] . '/' . $avaliado['documento'] ?>" title="Baixa Documento">BAIXAR</a>
                <button class="btn btn-success btn-alterar-nota" rel="<?= $avaliado['idProjetoEntrega'] ?>" data-projeto="<?= $avaliado['titulo'] ?>" data-nota="<?= $avaliado['nota'] ?>">ALTERAR NOTA</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <div id="collapse3" class="row collapse hide" aria-labelledby="headingOne" data-parent="#accordionExample">
    <?php foreach ($pendentes as $pendente) : ?>
      <div class="col-lg-4">
        <div class="card shadow mb-3">
          <div class="card-header pt-0 pb-0 pr-0">
            <div class="m-0 py-2 font-weight-bold text-uppercase text-warning">
              PROJETO <?= $pendente['titulo'] ?>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- Modal Avaliar -->
<div class="modal fade" id="avaliarModal" tabindex="-1" role="dialog" aria-labelledby="avaliarModalLabel" aria-hidden="true">
  <form class="modal-dialog" role="document" method="POST">
    <input type="hidden" name="avaliar_entrega" value="avaliar_entrega" />
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-success" id="avaliarModalLabel">ENTREGA <?= $entregas[0]['titulo'] ?> - PROJETO <span class="ae-projeto"></span></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="ae-id" id="ae-id" />
        <input type="hidden" name="ae-projeto" id="ae-projeto" />
        <div class="form-group">
          <label for="ae-nota">Nota:</label>
          <input type="number" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" min="0" max="10" name="ae-nota" id="ae-nota" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success">Salvar</button>
      </div>
    </div>
  </form>
</div>

<!-- Modal Alterar nota -->
<div class="modal fade" id="notaModal" tabindex="-1" role="dialog" aria-labelledby="notaModalLabel" aria-hidden="true">
  <form class="modal-dialog" role="document" method="POST">
    <input type="hidden" name="alterar_nota" value="alterar_nota" />
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-success" id="notaModalLabel">ENTREGA <?= $entregas[0]['titulo'] ?> - PROJETO <span class="an-projeto"></span></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="an-id" id="an-id" />
        <input type="hidden" name="an-projeto" id="an-projeto" />
        <input type="hidden" name="an-notaAntiga" class="an-nota" />
        <div class="form-group">
          <label for="an-nota">Nota:</label>
          <input type="number" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" min="0" max="10" name="an-nota" class="form-control an-nota" required>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success">Salvar</button>
      </div>
    </div>
  </form>
</div>