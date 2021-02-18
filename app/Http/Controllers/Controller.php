<?php

namespace App\Http\Controllers;

use App\Repositories\BaseRepositoryInterface;
use App\Repositories\JobRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $userRepository;

    protected $jobRepository;

    protected $user;

    public function __construct(UserRepositoryInterface $userRepository, JobRepositoryInterface $jobRepository)
    {
        $this->userRepository = $userRepository;
        $this->jobRepository = $jobRepository;

        $this->middleware(['auth', 'verified']);
        $this->middleware(function ($request, $next) {
            $this->user = $this->userRepository->find(auth()->user()->id);

            return $next($request);
        });
    }

    public function search($model, Request $request)
    {

        $search = $request->search == 'false' ? false : $request->search;

        $page = $request->page ?? 1;

        if($this->{$model . "Repository"} instanceof BaseRepositoryInterface)
        {
            $repository = $this->{$model . "Repository"};
            $results = $repository->getPaginatedData($search, 'created_at', env('POSTS_PER_PAGE', 8), $repository->model->getSearchable(), $page);

            return response()->json([
                'results' => $results->results,
                'search' => $results->search,
                'pagination_data' => $results->pagination_data
            ]);
        }else
        {
            return response()->json([
                'error' => 'Repository not found'
            ], 400);
        }
    }
}
