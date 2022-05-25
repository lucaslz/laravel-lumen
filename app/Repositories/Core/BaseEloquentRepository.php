<?php

namespace App\Repositories\Core;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Exceptions\EntityNotDefined;
use Exception;
use Doctrine\Inflector\Inflector;

class BaseEloquentRepository implements RepositoryInterface
{
    protected $entity;

    public function __construct()
    {
        $this->entity = $this->resolveEntity();
    }

    public function resolveEntity()
    {
        $entity = 'entity';
        if (!method_exists($this, $entity)) {
            throw new EntityNotDefined('Entity not defined');
        }

        return app()->make($this->$entity());
    }

    public function getAll()
    {
        return $this->entity->all();
    }

    public function findById($id)
    {
        return $this->entity->find($id);
    }

    public function findByWhere(array $where = [])
    {
        return $this->entity->where($where)->get();
    }

    public function findByWhereFirst(array $where = [])
    {
        return $this->entity->where($where)->first();
    }

    public function paginate($totalPage = 10)
    {
        return $this->entity->paginate($totalPage);
    }

    public function save(array $data)
    {
        return $this->entity->save($data);
    }

    public function update(array $data, $id)
    {
        return $this->entity->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->entity->find($id)->delete();
    }
}