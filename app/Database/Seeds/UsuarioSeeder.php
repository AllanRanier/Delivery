<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuarioSeeder extends Seeder
{
	public function run()
	{
		$usuarioModel = new \App\Models\UsuarioModel;

		$usuarios = [
			'nome' => 'Administrador do Sistemas',
			'email' => 'admin@admin.com',
			'cpf' => '116.835.754-31',
			'telefone' => '81 99999-9999',
			'password' => '102030',
			'password_hash' => ""
		];

		$usuarioModel->protect(false)->insert($usuarios);

		dd($usuarioModel->errors());
	}
}
