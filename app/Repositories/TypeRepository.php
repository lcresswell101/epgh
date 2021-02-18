<?php


namespace App\Repositories;

use App\Models\Type;

class TypeRepository extends BaseRepository implements TypeRepositoryInterface
{
    public function __construct(Type $model)
    {
        parent::__construct($model);
    }
}
