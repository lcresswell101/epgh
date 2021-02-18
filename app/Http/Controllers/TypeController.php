<?php

namespace App\Http\Controllers;

use App\Repositories\JobRepositoryInterface;
use App\Repositories\TypeRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    protected $typeRepository;

    public function __construct(UserRepositoryInterface $userRepository, JobRepositoryInterface $jobRepository, TypeRepositoryInterface $typeRepository)
    {
        parent::__construct($userRepository, $jobRepository);

        $this->typeRepository = $typeRepository;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $this->typeRepository->syncModel($request->all());

        return redirect()->back()->with('success', 'Types Updated!');
    }
}
