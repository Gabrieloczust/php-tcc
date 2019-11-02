<?php if ($qtd_convites > 0) : ?>
    <a class="nav-link dropdown-toggle" href="#" id="link-convites" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-envelope fa-fw"></i>
        <!-- Counter - Messages -->
        <span class="badge badge-danger badge-counter"><?= $qtd_convites ?></span>
    </a>

    <!-- Dropdown - Convites -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
        <h6 class="dropdown-header">
            Convites
        </h6>
        <div class="dropdown-itens dropdown-itens-primary">
            <?php foreach ($convites as $convite) : ?>
                <div class="dropdown-item d-flex align-items-center">
                    <div class="dropdown-list-image mr-3">
                        <div class="rounded-circle btn-circle btn-primary"><?= substr($convite['nome'], 0, 1) ?></div>
                    </div>
                    <div class="font-weight-bold">
                        <div class="text-truncate">Projeto <?= $convite['titulo'] ?></div>
                        <div class="small text-gray-500"><?= $convite['nome'] ?></div>
                        <div class="convite-btns small text-gray-500 d-flex justify-content-between mt-1">
                            <a class="btn dark-off btn-sm btn-danger" href="<?= HOME . 'convite/recusar/' . $convite['hashConvite'] ?>">Recusar</a>
                            <a class="btn dark-off btn-sm btn-success" href="<?= HOME . 'convite/aceitar/' . $convite['hashConvite'] ?>">Aceitar</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="dropdown-item small text-gray-500 d-flex justify-content-between">
                <a class="dark-off text-danger" href="<?= HOME . 'convite/recusartodos' ?>">Recusar Todos</a>
                <a class="dark-off text-success" href="<?= HOME . 'convite/aceitartodos' ?>">Aceitar Todos</a>
            </div>
        </div>
    </div>
<?php endif; ?>