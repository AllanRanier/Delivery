<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriarTabelaUsuarios extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'SERIAL'
			],
			'nome' => [
				'type' => 'VARCHAR',
				'constraint' => '128'
			],
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'cpf' => [
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => true,
				'unique' => true
			],
			'telefone' => [
				'type' => 'VARCHAR',
				'constraint' => '20'
			],
			'is_admin' => [
				'type' => 'BOOLEAN',
				'null' => false,
				'default' => false
			],
			'ativo' => [
				'type' => 'BOOLEAN',
				'null' => false,
				'default' => false
			],
			'password_hash' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'ativacao_hash' => [
				'type' => 'VARCHAR',
				'constraint' => '64',
				'null' => true,
				'unique' => true
			],
			'reset_hash' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true,
				'unique' => true
			],
			'reset_expira_em' => [
				'type' => 'DATETIME',
				'null' => true,
				'default' => null
			],
			'criado_em' => [
				'type' => 'DATETIME',
				'null' => true,
				'default' => null
			],
			'atualizado_em' => [
				'type' => 'DATETIME',
				'null' => true,
				'default' => null
			],
			'deletado_em' => [
				'type' => 'DATETIME',
				'null' => true,
				'default' => null
			],
		]);

		$this->forge->addKey('id', true);
		$this->forge->createTable('usuario');
	}

	public function down()
	{
		$this->forge->dropTable('usuario');
	}
}
