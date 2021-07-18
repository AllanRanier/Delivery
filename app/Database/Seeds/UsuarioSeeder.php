<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuarioSeeder extends Seeder
{
	public function run()
	{
		$usuarioModel = new \App\Models\UsuarioModel;

		$usuario = [
			'nome' => 'Administrador do Sistemas',
			'email' => 'admin@admin.com',
			'cpf' => '349.957.910-35',
			'telefone' => '81 - 99999-9999',
			'password_hash' => ""
		];

		$usuarioModel->protect(false)->insert($usuario);

		dd($usuarioModel->errors());
	}
}
