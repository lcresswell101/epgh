<?php


namespace App\Repositories;


use App\Models\Status;

class StatusRepository extends BaseRepository implements StatusRepositoryInterface
{
    public function __construct(Status $model)
    {
        parent::__construct($model);
    }
}
