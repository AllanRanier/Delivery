<?php


class Autenticacao {
    private $usuario;

    public function login(string $email, string $password)
    {
        $usuarioModel = new \App\Models\UsuarioModel();


        $usuario = $usuarioModel->buscaUsuarioEmail($email);

        if ($usuario === null) {
            return false;
        }

        if (!$usuario->verificaPassword($password)) {
            return false;
        }

        if ($usuario->ativo == 'f') {
           return false;
        }

        $this->logaUsuario($usuario);


    }

    public function logout()
    {
        session()->destroy();
    }

    public function usuarioLogado(){
        if ($this->usuario === null) {
            $this->usuario = $this->usuarioDaSessao();;
        }

        return $this->usuario;
    }

    public function estaLogado(){
        return $this->usuarioLogado() !== null;
    }

    public function usuarioDaSessao()
    {
        if (!session()->has('usario_id')) {
            return null;
        }


        $usuarioModel = new \App\Models\UsuarioModel();
        $usuario = $usuarioModel->find(session()->get('usuario_id'));

        if ($usuario && $usuario->ativo == 't') {
            return $usuario;
        }
    }

    private function logaUsuario(object $usuario)
    {
        $session = session();
        $session->regenerate();
        $session->set('usario_id', $usuario->id);
    }
}