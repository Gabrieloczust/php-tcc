<div class="col-lg-12">
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
<?php
foreach ($turma as $p) :
    echo "Projeto: {$p['titulo']} - Turma: {$p['nome']}";
    echo "<hr>";
endforeach;
