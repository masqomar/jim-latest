<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use App\Http\Requests\{StoreSubmissionRequest, UpdateSubmissionRequest};
use Yajra\DataTables\Facades\DataTables;

class SubmissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:pengajuan view')->only('index', 'show');
        $this->middleware('permission:pengajuan create')->only('create', 'store');
        $this->middleware('permission:pengajuan edit')->only('edit', 'update');
        $this->middleware('permission:pengajuan delete')->only('delete');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $submissions = Submission::with('user:id,first_name');

            return DataTables::of($submissions)
                ->addColumn('user', function ($row) {
                    return $row->user ? $row->user->first_name : '';
                })->addColumn('action', 'submissions.include.action')
                ->toJson();
        }

        return view('submissions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('submissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubmissionRequest $request)
    {
        
        Submission::create($request->validated());

        return redirect()
            ->route('submissions.index')
            ->with('success', __('The submission was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function show(Submission $submission)
    {
        $submission->load('user:id,first_name');

		return view('submissions.show', compact('submission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function edit(Submission $submission)
    {
        $submission->load('user:id,first_name');

		return view('submissions.edit', compact('submission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubmissionRequest $request, Submission $submission)
    {
        
        $submission->update($request->validated());

        return redirect()
            ->route('submissions.index')
            ->with('success', __('The submission was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Submission $submission)
    {
        try {
            $submission->delete();

            return redirect()
                ->route('submissions.index')
                ->with('success', __('The submission was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('submissions.index')
                ->with('error', __("The submission can't be deleted because it's related to another table."));
        }
    }
}
