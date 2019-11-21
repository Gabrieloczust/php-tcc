<div class="d-sm-flex flex-column mb-4">
  <h1 class="h3 mb-2 text-gray-800">
    <a class="text-success" href="<?= HOME ?>turmas">TURMAS</a> -
    <a class="text-success" href="<?= HOME ?>turmas/turma/<?= $entregas[0]['slugTurma'] ?>">
      <?= $entregas[0]['nome'] ?>
    </a>
    - <?= $entregas[0]['titulo'] ?>
  </h1>
  <strong class="text-gray-800">DATA DE ENTREGA: <?= date("d/m/Y", strtotime($entregas[0]['data_entrega'])) ?></strong>
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
        Entregues
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
                    <?= $entregue['titulo'] ?>
                  </div>
                  <div class="text-xs font-weight-bold text-gray-800 text-uppercase">
                    DIA QUE FOI ENTREGUE: <?= date("d/m/Y", strtotime($entregue['data'])) ?>
                  </div>
                </div>
              </div>
              <div class="col-auto text-center text-primary">
                <button class="btn btn-primary">AVALIAR</button>
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
                <button class="btn btn-success">ALTERAR NOTA</button>
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
              <?= $pendente['titulo'] ?>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>