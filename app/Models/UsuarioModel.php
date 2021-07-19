<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
	protected $table = 'usuarios';
	protected $returnType = 'App\Entities\Usuario';
	protected $allowedFields = [
		'nome',
		'email',
		'telefone',
		'password_hash',
		'ativacao_hash',
		'reset_hash',
		'reset_expira_em',
		'criado_em',
		'is_admin',
		'ativo',

	];
	protected $useSoftDelete = true;
	protected $useTimestamps = true;
    protected $createdField  = 'criado_em';
    protected $updatedField  = 'atualizado_em';
    protected $deletedField  = 'deletado_em';

	protected $validationRules    = [
        'nome'     => 'required|min_length[4]|max_length[120]',
        'email'        => 'required|valid_email|is_unique[usuario.email]',
        'cpf'        => 'required|exact_length[14]|is_unique[usuario.cpf]',
        'password'     => 'required|min_length[6]',
        'password_confirmation' => 'required_with[password]|matches[password]'
    ];

    protected $validationMessages = [
        'nome'        => [
            'required' => 'o campo nome é obrigátorio.',
		],
        'email'        => [
            'required' => 'o campo e-mail é obrigátorio.',
            'is_unique' => 'Desculpe. Esse e-mail já existe.',
		],
        'cpf'        => [
            'required' => 'O campo CPF é obrigátorio.',
            'is_unique' => 'Desculpe. Esse CPF já existe.',
		],
    ];

	/**
	 *  Array de Usuarios
	 * 
	 */
	public function procurar($term)
	{
		if ($term === null) {
			return [];
		}

		return $this->select('id, nome')
					->like('nome', $term)
					->get()
					->getResult();
	}

	public function desabilitaValidacaoSenha()
	{
		unset($this->validationRules['password']);
		unset($this->validationRules['password_confirmation']);
	}

}
