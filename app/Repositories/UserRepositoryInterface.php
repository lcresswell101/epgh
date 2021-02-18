<?php


namespace App\Repositories;

interface UserRepositoryInterface
{
    /**
     * @param array $request
     * @return mixed
     */
    public function createUser(array $request);

    /**
     * @param array $request
     * @return mixed
     */
    public function createJob(array $request);
}
