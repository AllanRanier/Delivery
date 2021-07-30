<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class Login extends BaseController
{

	private $usuarioModel;
	protected $session;

	public function __construct()
	{
		$this->session = \Config\Services::session();
		$this->usuarioModel = new UsuarioModel();
	}
	public function novo()
	{
		return view('Login/novo', [
			'titulo' => 'Realize o login.'
		]);
	}

	public function logar()
    {
        $data = $this->request->getPost();

        $user = $this->usuarioModel->where('email', $data['email'])
            ->first();    

        if (!$user || !password_verify($data['password'], $user->password_hash)) {
            return  redirect()->to('/login')->with('info', "E-mail e Senha Incorretos!");
        } else {
			$this->session->set([
				'email' => $this->request->getPost('email'),
                'nome' => $user->nome,
                'id' => $user->id,
				'is_admin' => $user->is_admin
            ]);
			if ($this->session->is_admin == 'f') {
				return redirect()->to('/');
			}

            return redirect()->to('/admin/home');
        }
    }

	public function logout(){
        session()->destroy();
        return redirect()->to('/login');
    }
}
