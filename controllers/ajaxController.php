<?php
class ajaxController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function mudatema()
    {
        $usuario = $this->usuarioLogado;
        $usuario->mudarTema();
    }

    public function notificacoesLidas()
    {
        $usuario = $this->usuarioLogado;
        $notificacao = new Notificacao($this->usuarioLogadoTipo);
        $notificacao->changeLidas($usuario->getId());
        echo $notificacao->qtdNaoLidas($usuario->getId());
    }

    public function notificacoes()
    {
        if ($this->usuarioLogadoTipo == 'professor') {
            $notificacao = new Notificacao('Orientador');
        } else {
            $notificacao = new Notificacao('Aluno');
        }
        $dados["notificacoes"] = $notificacao->getNoficacoes($this->usuarioLogado->getId());
        $dados["qtdNaoLidas"] = $notificacao->qtdNaoLidas($this->usuarioLogado->getId());

        $this->loadView("notificacoes", $dados);
    }

    public function convites()
    {
        $c = new Convite();
        $dados["convites"] = $c->getConvites($this->usuarioLogado->getId(), $this->usuarioLogadoTipo);
        $dados["qtd_convites"] = count($dados["convites"]);

        $this->loadView("convites", $dados);
    }

    public function convitesProfessor()
    {
        $c = new Convite();
        $dados["convites"] = $c->getConvites($this->usuarioLogado->getId(), $this->usuarioLogadoTipo);
        $dados["qtd_convites"] = count($dados["convites"]);

        // Lista turmas no convite para Professor
        $t = new Turma($this->usuarioLogado->getEmail());
        $dados["turmas_select"] = $t->getTurmas();

        $this->loadView("convitesProfessor", $dados);
    }
}
