<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    public function update(array $attributes): bool;

    /**
     * @return bool|null
     */
    public function delete(): ?bool;

    /**
     * @param $id
     * @return BaseRepository
     */
    public function find(int $id): BaseRepository;

    /**
     * @param string $condition
     * @param string $operator
     * @param $value
     * @return BaseRepository
     */
    public function where(string $condition, string $operator, $value): BaseRepository;

    /**
     * @return mixed
     */
    public function get(array $atts);

    /**
     * @return mixed
     */
    public function all();
}
