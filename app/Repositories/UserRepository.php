<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $request
     */
    public function createUser(array $request)
    {
        $request['password'] = Hash::make($request['password']);
        $request['api_token'] = Str::random(80);

        $this->model->create($request);
    }

    /**
     * @param array $request
     * @throws ValidationException
     */
    public function updateUser(array $request)
    {
        $user = $this->model;

        Validator::make($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'image', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($request['photo'])) {
            $user->updateProfilePhoto($request['photo']);
        }

        if ($request['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $request);
        } else {
            $user->forceFill([
                'name' => $request['name'],
                'email' => $request['email'],
            ])->save();
        }

        $user->update($request);
    }

    /**
     * @param array $request
     * @throws ValidationException
     */
    public function updateUserPassword(array $request)
    {
        $user = $this->model;

        Validator::make($request, [
            'current_password' => ['required', 'string'],
            'password' => $user->passwordRules(),
        ])->after(function ($validator) use ($user, $request) {
            if (! isset($request['current_password']) || ! Hash::check($request['current_password'], $user->password)) {
                $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
            }
        })->validateWithBag('updatePassword');

        $user->forceFill([
            'password' => Hash::make($request['password']),
        ])->save();
    }

    public function deleteUserPhoto()
    {
        $user = $this->model;

        $user->deleteProfilePhoto();
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }

    /**
     * @param array $request
     */
    public function createJob(array $request)
    {
        $this->model->jobs()->create($request);
    }
}
