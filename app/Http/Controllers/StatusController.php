<?php

namespace App\Http\Controllers;

use App\Repositories\JobRepositoryInterface;
use App\Repositories\StatusRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    protected $statusRepository;

    public function __construct(UserRepositoryInterface $userRepository, JobRepositoryInterface $jobRepository, StatusRepositoryInterface $statusRepository)
    {
        parent::__construct($userRepository, $jobRepository);

        $this->statusRepository = $statusRepository;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $this->statusRepository->syncModel($request->all());

        return redirect()->back()->with('success', 'Types Updated!');
    }
}
