<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobExportRequest;
use App\Http\Requests\JobRequest;
use App\Models\Job;
use App\Repositories\JobRepositoryInterface;
use App\Repositories\StatusRepositoryInterface;
use App\Repositories\TypeRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Exception;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use PDF;

class JobController extends Controller
{
    protected $jobRepository;

    protected $typeRepository;

    protected $statusRepository;

    public function __construct(UserRepositoryInterface $userRepository, JobRepositoryInterface $jobRepository, TypeRepositoryInterface $typeRepository, StatusRepositoryInterface $statusRepository)
    {
        parent::__construct($userRepository, $jobRepository);

        $this->jobRepository = $jobRepository;

        $this->typeRepository = $typeRepository;

        $this->statusRepository = $statusRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $jobs = $this->jobRepository->getPaginatedData(false, 'created_at', env('POSTS_PER_PAGE', 8), [
            'id',
            'user_id',
            'type_id',
            'status_id',
            'invoice_number',
            'date',
            'time',
            'name',
            'created_at'
        ], 1);

        return Inertia::render('Jobs/Index', [
            'attributes' => $this->jobRepository->model->getAttributesFrontend(),
            'actions' => $this->jobRepository->model->getActions(),
            'pagination_data' => $jobs->pagination_data,
            'jobs' => $jobs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        $types = $this->typeRepository->all();
        $status = $this->statusRepository->all();

        return Inertia::render('Jobs/Create', [
            'types' => $types,
            'status' => $status
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param JobRequest $request
     * @return RedirectResponse
     */
    public function store(JobRequest $request): RedirectResponse
    {
        $this->userRepository->createJob($request->validated());

        return redirect()->back()->with('success', 'Job Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param Job $job
     * @return Response
     */
    public function show(Job $job): Response
    {
        return Inertia::render('Jobs/Show', [
            'job' => $job
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Job $job
     * @return Response
     */
    public function edit(Job $job): Response
    {
        $types = $this->typeRepository->all();
        $status = $this->statusRepository->all();

        return Inertia::render('Jobs/Edit', [
            'job' => $job->makeVisible([
                    'id',
                    'type_id',
                    'status_id',
                    'date_formatted'
                ]),
            'types' => $types,
            'status' => $status
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param JobRequest $request
     * @param Job $job
     * @return RedirectResponse
     */
    public function update(JobRequest $request, Job $job): RedirectResponse
    {
        $this->jobRepository->find($job->id)->update($request->validated());

        return redirect()->back()->with('success', 'Job Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Job $job
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Job $job): RedirectResponse
    {
        $this->jobRepository->find($job->id)->delete();

        return redirect()->route('job.index')->with('success', 'Job Deleted!');
    }

    public function export(JobExportRequest $request)
    {
        $jobsArr = explode(',', $request->jobs);

        $jobs = $this->jobRepository->model->whereIn('id', $jobsArr)->get();

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdfs.job', ['jobs' => $jobs]);

        return $pdf->stream();
    }
}
