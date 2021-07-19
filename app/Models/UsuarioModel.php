<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
	protected $table = 'usuarios';
	protected $returnType = 'App\Entities\Usuario';
	protected $allowedFields = ['nome','email','telefone', 'password_hash'];
	protected $useSoftDelete = true;
	protected $useTimestamps = true;
    protected $createdField  = 'criado_em';
    protected $updatedField  = 'atualizado_em';
    protected $deletedField  = 'deletado_em';

	protected $validationRules    = [
        'nome'     => 'required|min_length[4]|min_length[120]',
        'email'        => 'required|valid_email|is_unique[usuario.email]',
        'cpf'        => 'required|exact_length[14]|is_unique[usuario.cpf]',
        'password'     => 'required|min_length[6]',
        'pass_confirm' => 'required_with[password]|matches[password]'
    ];

    protected $validationMessages = [
        'nome'        => [
            'required' => 'Esse campo é obrigátorio.',
		],
        'email'        => [
            'required' => 'Esse campo é obrigátorio.',
            'is_unique' => 'Desculpe. Esse e-mail já existe.',
		],
        'cpf'        => [
            'required' => 'Esse campo é obrigátorio.',
            'is_unique' => 'Desculpe. Esse CPF já existe.',
		],
    ];

	/**
	 *  Array de Usuarios
	 * 
	 */
	public function procurar($term){
		if ($term === null) {
			return [];
		}

		return $this->select('id, nome')
					->like('nome', $term)
					->get()
					->getResult();
	}


}
