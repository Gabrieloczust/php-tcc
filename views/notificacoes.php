<?php if (!empty($notificacoes)) : ?>
    <a class="nav-link dropdown-toggle pointer" id="link-notificacoes" role="button" data-toggle="dropdown" data-url="<?= HOME ?>" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Messages -->
        <?php if ($qtdNaoLidas > 0) : ?>
            <span class="badge badge-danger badge-counter" id="qtd-notificacoes"><?= $qtdNaoLidas ?></span>
        <?php endif; ?>
    </a>

    <!-- Dropdown - Notificações -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
        <h6 class="dropdown-header">
            Notificações
        </h6>
        <form class="dropdown-itens">
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
                <div class="dropdown-item align-items-center" style="display: flex">
                    <div class="dropdown-list-image d-flex align-items-center mr-2">
                        <div class="rounded-circle btn-circle btn-sm <?= $classe ?> dark-off">
                            <i class="fas <?= $fa ?>"></i>
                        </div>
                    </div>
                    <div class="text-dark text-notificacao">
                        <small class="d-block"><?= $notificacao['mensagem'] ?></small>
                        <div class="d-flex align-items-center justify-content-between mt-2">
                            <small class="">
                                <i class="fa fa-clock text-dark mr-1"></i><?= $notificacao['tempo'] ?>
                            </small>
                            <a data-url="<?= HOME ?>ajax/apagaNotificacao/<?= $notificacao['idNotificacao'] ?>" class="apaga-mensagem pointer" title="Apagar">
                                <i class="text-danger fa fa-trash fa-sm"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </form>
    </div>
<?php endif; ?>

<script>
    // Apaga Mensagem
    $('.apaga-mensagem').on('click', function() {
        $(this).parents('.dropdown-item').slideUp()

        var home = $(this).attr('data-url');
        $(this).load(home);
    });
</script>