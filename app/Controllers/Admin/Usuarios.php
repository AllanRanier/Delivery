<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Usuarios extends BaseController
{
	private $UsuarioModel;

	public function __construct()
	{
	  $this->UsuarioModel = new \App\Models\UsuarioModel();
	}

	public function index()
	{
		// dd($this->UsuarioModel->findAll());
		$data = [
			'titulo' => 'Listando os Usuários',
			'usuarios' =>  $this->UsuarioModel->findAll()
		];

		session()->set('sucesso', 'Teste bb');
		return view('Admin/Usuarios/index', $data);
	}

	public function procurar()
	{
		if (!$this->request->isAJAX()) {
			exit('Página não encontrada');
		}

		$usuarios = $this->UsuarioModel->procurar($this->request->getGet('term'));

		$resultado = [];

		foreach ($usuarios as $usuario){
			$data['id'] = $usuario->id;
			$data['value'] = $usuario->nome;

			$resultado[] = $data;
		}
		return $this->response->setJson($resultado);
	}

	public function editar($id = null)
	{
		$usuario = $this->buscaUsuarioOu404($id);

		// dd($usuario);
		$data = [
			'titulo' => "Editar o usuário $usuario->nome",
			'usuario' => $usuario

		];

		return view('Admin/Usuarios/editar', $data);
	}

	public function show($id = null)
	{
		$usuario = $this->buscaUsuarioOu404($id);

		// dd($usuario);
		$data = [
			'titulo' => "Detalhado o usuário $usuario->nome",
			'usuario' => $usuario

		];

		return view('Admin/Usuarios/show', $data);
	}

	/**
	 * objeto usuário
	 */
	private function buscaUsuarioOu404(int $id = null)
	{
		if (!$id || !$usuario = $this->UsuarioModel->where('id', $id)->first()) {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o usuario $id");
		}

		return $usuario;
	}
}
