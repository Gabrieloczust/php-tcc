<div class="d-sm-flex flex-column mb-4">
    <h1 class="h3 mb-2 text-gray-800">
        <a class="text-success" href="<?= HOME ?>turmas">Turmas</a> -
        <a class="text-success" href="<?= HOME ?>turmas/turma/SLUGTURMA">Nome da Turma</a> -
        Nome da Entrega
    </h1>
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