<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use App\Repositories\JobRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function __construct(UserRepositoryInterface $userRepository, JobRepositoryInterface $jobRepository)
    {
        parent::__construct($userRepository, $jobRepository);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $users = $this->userRepository->getPaginatedData(false, 'created_at', env('POSTS_PER_PAGE', 8), [
            'id',
            'name',
            'email',
            'profile_photo_path'
        ], 1);

        return Inertia::render('Users/Index',
        [
            'attributes' => $this->userRepository->model->getAttributesFrontend(),
            'actions' => $this->userRepository->model->getActions(),
            'pagination_data' => $users->pagination_data,
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Users/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserCreateRequest $request
     * @return RedirectResponse
     */
    public function store(UserCreateRequest $request): RedirectResponse
    {
        $this->userRepository->createUser($request->validated());

        return redirect()->back()->with('success', 'User Created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user): Response
    {
        return Inertia::render('Users/Edit', [
            'user_edited' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $this->userRepository->find($user->id)->updateUser($request->all());

        return redirect()->back()->with('success', 'User Updated!');
    }

    /**
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function updatePassword(Request $request, User $user): RedirectResponse
    {
        $this->userRepository->find($user->id)->updateUserPassword($request->all());

        return redirect()->back()->with('success', 'Password Updated!');
    }

    public function deletePhoto(User $user)
    {
        $this->userRepository->find($user->id)->deleteUserPhoto();

        return redirect()->back()->with('success', 'Photo Deleted!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(User $user): RedirectResponse
    {
        $this->userRepository->find($user->id)->delete();

        return redirect()->route('user.index')->with('success', 'User Deleted!');
    }
}
