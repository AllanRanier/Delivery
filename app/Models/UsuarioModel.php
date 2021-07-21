<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
	protected $table = 'usuario';
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
	//Datas
	protected $useTimestamps = true;
    protected $createdField  = 'criado_em';
    protected $updatedField  = 'atualizado_em';
    protected $dateFormat  = 'datetime';
	protected $useSoftDeletes = true;
    protected $deletedField  = 'deletado_em';
	//Validações
	protected $validationRules    = [
        'nome'     => 'required|min_length[4]|max_length[120]',
        'email'        => 'required|valid_email|is_unique[usuario.email]',
        'cpf'        => 'required|validaCpf|exact_length[14]|is_unique[usuario.cpf]',
        'telefone'        => 'required',
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

	protected $beforeInsert = ['hashPassword'];
	protected $beforeUpdate = ['hashPassword'];

	protected function hashPassword(array $data)
	{
		if (isset($data['data']['password'])) {
			$data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
			unset($data['data']['password']);
			unset($data['data']['password_confirmation']);
		}

		// dd($data);

		return $data;
	}

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

	public function desfazerExclusao(int $id)
	{
		return $this->protect(false)
					->where('id',$id)
					->set('deletado_em', null)
					->update();
	}

}
