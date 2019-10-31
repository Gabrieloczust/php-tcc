<?php if ($qtd_convites > 0) : ?>
    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-envelope fa-fw"></i>
        <!-- Counter - Messages -->
        <span class="badge badge-danger badge-counter"><?= $qtd_convites ?></span>
    </a>

    <!-- Dropdown - Convites -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
        <h6 class="dropdown-header bg-success border-success">
            Convites
        </h6>

        <?php
            if (count($turmas_select) > 0) :
                foreach ($convites as $convite) : ?>
                <form class="dropdown-item" method="POST" action="<?= HOME ?>convite/aceitarorientador/<?= $convite['hashConvite'] ?>">
                    <div class="font-weight-bold">
                        <div class="text-truncate"><?= $convite['titulo'] ?></div>
                        <div class="small text-gray-500">Tipo: <?= $convite['tipo'] ?></div>
                        <div class="small text-gray-500">Por: <?= $convite['nome'] ?></div>
                        <div class="convite-btns small text-gray-500 d-flex flex-column justify-content-between mt-1">
                            <div class="form-group mb-2">
                                <select id="" class="form-control form-control-sm" name="turma" required>
                                    <option selected disabled value="">Selecione uma turma...</option>
                                    <?php foreach ($turmas_select as $ts) { ?>
                                        <option value="<?= $ts['idTurma'] ?>"><?= $ts['nome'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div>
                                <a class="btn dark-off btn-md btn-danger" href="<?= HOME ?>convite/recusar/<?= $convite['hashConvite'] ?>">Recusar</a>
                                <input type="submit" value="Aceitar" class="btn dark-off btn-md btn-success">
                            </div>
                        </div>
                    </div>
                </form>
            <?php endforeach; ?>

            <div class="dropdown-item small text-gray-500 d-flex justify-content-center">
                <a class="dark-off text-danger" href="<?= HOME . 'convite/recusartodos' ?>">Recusar Todos</a>
            </div>
        <?php else : ?>
            <div class="alert alert-warning text-center m-0 rounded-0">
                Antes de visualizar seus convites crie uma turma para aceitar novos projetos
            </div>
        <?php
            endif;
            ?>
    </div>
<?php endif; ?>