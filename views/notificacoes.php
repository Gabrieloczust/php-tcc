<a class="nav-link dropdown-toggle" id="link-notificacoes" href="#" role="button" data-toggle="dropdown" data-url="<?= HOME ?>" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-bell fa-fw"></i>
    <!-- Counter - Messages -->
    <span class="badge badge-danger badge-counter" id="qtd-notificacoes"><?= $qtdNaoLidas ?></span>
</a>

<!-- Dropdown - Notificações -->
<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
    <h6 class="dropdown-header">
        Notificações
    </h6>
    <?php
    foreach ($notificacoes as $notificacao) :
        if ($notificacao['tipo'] == 'aceito') :
            $classe = "btn-success";
            $fa = "fa-check";
        else :
            $classe = "btn-warning";
            $fa = "fa-exclamation-triangle";
        endif;
        ?>
        <div class="dropdown-item d-flex align-items-center">
            <div class="dropdown-list-image d-flex align-items-center mr-2">
                <div class="rounded-circle btn-circle btn-sm <?= $classe ?>">
                    <i class="fas <?= $fa ?>"></i>
                </div>
            </div>
            <div class="text-dark">
                <small><?= $notificacao['mensagem'] ?></small>
            </div>
        </div>
    <?php endforeach; ?>
</div>