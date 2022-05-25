<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function findByWhere(array $where = []);
    public function findByWhereFirst(array $where = []);
    public function paginate($totalPage = 10);
    public function save(array $data);
    public function update(array $data, $id);
    public function delete($id);
}