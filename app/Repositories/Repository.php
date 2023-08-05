<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Repository
{
    protected $model;

    /**
     * Cria uma nova instância do repositório e resolve o modelo associado.
     */
    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    /**
     * Método para resolver o modelo associado ao repositório.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function resolveModel(): Builder
    {
        return $this->model;
    }

    /**
     * Retorna todos os registros do modelo.
     *
     * @return Model
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Encontra um registro pelo ID.
     *
     * @param  mixed  $id
     * @param  string|array  $columns
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find($id, $columns = '*')
    {
        return $this->model->find($id, $columns);
    }

    /**
     * Armazena um novo registro no banco de dados.
     *
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        // Utiliza o método "create()" do modelo para armazenar um novo registro.
        return $this->model->create($data);
    }

    /**
     * Atualiza o registro pelo ID e retorna o modelo atualizado.
     *
     * @param  mixed  $id
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function update($id, array $data)
    {
        // Encontra o registro pelo ID.
        $model = $this->find($id);

        if ($model) {
            // Utiliza o método "update()" para atualizar os atributos do modelo.
            $model->update($data);
            return $model;
        }

        return null;
    }

    /**
     * Exclui o registro pelo ID e retorna um booleano indicando se a operação foi bem-sucedida.
     *
     * @param  mixed  $id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function destroy($id)
    {
        // Encontra o registro pelo ID.
        $model = $this->find($id);

        if ($model) {
            // Utiliza o método "delete()" para excluir o registro do banco de dados.
            return $model->delete();
        }

        return null;
    }
}
