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

<div class="row mb-2">
  <div class="col">
    <div class="card border-left-primary shadow py-2 mb-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="h5 mb-0 font-weight-bold text-primary text-uppercase mb-1">PROJETO: <?= $projeto['titulo'] ?></div>
            <div class="text-xs font-weight-bold text-uppercase">ORIENTADOR: <?= $projeto['nome'] ?></div>
            <div class="text-xs font-weight-bold text-uppercase">ALUNO(S): <?= $projeto['alunosParticipantes'] ?></div>
            <div class="text-xs font-weight-bold text-uppercase">INÍCIO: <?= date("d/m/y", strtotime($projeto['data_criacao'])) ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <?php if (count($entregas) > 0) : foreach ($entregas as $entrega) :
      if ($entrega['status'] == 'pendente') :
        $fa = "fa-exclamation-circle";
        $cor = "warning";
      else :
        $fa = "fa-check-circle";
        $cor = "success";
      endif;
      ?>
      <div class="col-lg-6">
        <div class="card card-entrega border-left-<?= $cor ?> shadow py-2 pointer mb-3" rel="<?= $entrega['idProjetoEntrega'] ?>" data-titulo="<?= $entrega['titulo'] ?>" data-descricao="<?= $entrega['descricao'] ?>">
          <div class=" card-body">
            <div class="row no-gutters align-items-center">
              <div class="col">
                <div class="h5 mb-0 font-weight-bold text-uppercase text-<?= $cor ?> mb-1"><?= $entrega['titulo'] ?></div>
                <div class="text-xs font-weight-bold text-gray-800 text-uppercase">DATA DE ENTREGA: <?= date("d/m/y", strtotime($entrega['data_entrega'])) ?></div>
              </div>
              <div class="col-auto">
                <i class="fas <?= $fa ?> fa-2x text-<?= $cor ?>"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach;
    else : ?>
    <div class="col">
      <div class="alert alert-warning text-center">Você não possui nenhuma entrega! <a class=" ml-2 btn btn-warning pointer" href="<?= HOME ?>projetos">VOLTAR</a>
      </div>
    </div>
  <?php endif; ?>
</div>

<!-- Modal Entrega -->
<div class="modal fade" id="entregaModal" tabindex="-1" role="dialog" aria-labelledby="entregaModalLabel" aria-hidden="true">
  <form class="modal-dialog" role="document" method="POST">
    <input type="hidden" name="entrega" value="entrega" enctype="multipart/form-data" />
    <input type="hidden" class="e-id" name="e-id">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary" id="entregaModalLabel"></h5>
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