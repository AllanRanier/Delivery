<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Usuario;

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
			'usuarios' =>  $this->UsuarioModel->withDeleted(true)->findAll()
		];
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

	public function criar()
	{
		$usuario = new Usuario();
		// dd($usuario);
		$data = [
			'titulo' => "Criando novo usuário",
			'usuario' => $usuario

		];

		return view('Admin/Usuarios/criar', $data);
	}

	public function cadastrar()
	{
		if ($this->request->getMethod() === 'post') {
			$usuario = new Usuario($this->request->getPost());

			if ($this->UsuarioModel->protect(false)->save($usuario)) {
				return redirect()->to(site_url("admin/usuarios/show/".$this->UsuarioModel->getInsertID()))
								->with('sucesso', "Usuário $usuario->nome cadastrado com sucesso.");
			}else {
				return redirect()->back()->with('errors_model', $this->UsuarioModel->errors())
										->with('atencao', 'Por favor verifique os erros  abaixo.');
			}

		}else{
			/* caso não seja post */
			return redirect()->back();
		}
	}


	public function excluir($id = null)
	{
		$usuario = $this->buscaUsuarioOu404($id);

		if ($usuario->is_admin == 't') {
			return redirect()->back()->with('info', "Não é possível excluir um usuário <b>Administrado</b>");
		}

		if ($usuario->deletado_em != null) {
			return redirect()->back()->with('info', "O usuário $usuario->nome já encontra-se excluído.");
		}


		if ($this->request->getMethod() === 'post') {
			$this->UsuarioModel->delete($id);

			return redirect()->to(site_url('admin/usuarios'))->with('sucesso', "Usuário $usuario->nome excluído com sucesso!");
		}

		// dd($usuario);
		$data = [
			'titulo' => "Excluir o usuário $usuario->nome",
			'usuario' => $usuario

		];

		return view('Admin/Usuarios/excluir', $data);
	}

	public function desfazerexclusao($id = null)
	{
		$usuario = $this->buscaUsuarioOu404($id);

		if ($usuario->deletado_em == null) {
			return redirect()->back()->with('info','Apenas usuários exluidos podem ser recuperados!');
		}

		if ($this->UsuarioModel->desfazerExclusao($id)) {
			return redirect()->back()->with('sucesso','Exclusão desfeita com sucesso!');
		}else{
			return redirect()->back()
							->with('errors_model', $this->UsuarioModel->errors())
							->with('atencao', 'Por favor verifique os erros  abaixo.');

		}

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

	public function editar($id = null)
	{
		$usuario = $this->buscaUsuarioOu404($id);

		if ($usuario->deletado_em != null) {
			return redirect()->back()->with('info', "O usuário $usuario->nome encontra-se excluído. Por tanto não é possível editá-lo");
		}

		// dd($usuario);
		$data = [
			'titulo' => "Editar o usuário $usuario->nome",
			'usuario' => $usuario

		];

		return view('Admin/Usuarios/editar', $data);
	}

	public function atualizar($id = null)
	{
		if ($this->request->getMethod() === 'post') {
			$usuario = $this->buscaUsuarioOu404($id);

			if ($usuario->deletado_em != null) {
				return redirect()->back()->with('info', "O usuário $usuario->nome encontra-se excluído. Por tanto não é possível editá-lo");
			}


			$post = $this->request->getPost();


			if (empty($post['password'])) {
				$this->UsuarioModel->desabilitaValidacaoSenha();
				unset($post['password']);
				unset($post['password_confirmation']);
			}

			$usuario->fill($post);
			if (!$usuario->hasChanged()) {
				return redirect()->back()->with('info', "Não dados para atualizar.");
			}

			if ($this->UsuarioModel->protect(false)->save($usuario)) {
				return redirect()->to(site_url("admin/usuarios/show/$usuario->id"))
								->with('sucesso', "Usuário $usuario->nome atualizado com sucesso.");
			}else {
				return redirect()->back()->with('errors_model', $this->UsuarioModel->errors())
										->with('atencao', 'Por favor verifique os erros  abaixo.');
			}

		}else{
			/* caso não seja post */
			return redirect()->back();
		}
	}

	/**
	 * objeto usuário
	 */
	private function buscaUsuarioOu404(int $id = null)
	{
		if (!$id || !$usuario = $this->UsuarioModel->withDeleted(true)->where('id', $id)->first()) {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o usuario $id");
		}

		return $usuario;
	}
}
