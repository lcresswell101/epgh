<?php

namespace App\Http\Controllers;

use App\Repositories\JobRepositoryInterface;
use App\Repositories\StatusRepositoryInterface;
use App\Repositories\TypeRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    protected $typeRepository;
    protected $statusRepository;

    public function __construct(UserRepositoryInterface $userRepository, JobRepositoryInterface $jobRepository, TypeRepositoryInterface $typeRepository, StatusRepositoryInterface $statusRepository)
    {
        parent::__construct($userRepository, $jobRepository);

        $this->typeRepository = $typeRepository;
        $this->statusRepository = $statusRepository;
    }

    public function edit()
    {
        return Inertia::render('Admin/Edit', [
            'job_types' => $this->typeRepository->all(),
            'job_status' => $this->statusRepository->all()
        ]);
    }
}
