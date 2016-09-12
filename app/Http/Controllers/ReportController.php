<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ReportRequest;
use App\Repositories\Eloquent\ReportRepositoryEloquent;

class ReportController extends Controller
{
    /**
     * The vote repository eloquent instance.
     *
     * @var ReportRepositoryEloquent
     */
    protected $report;

    /**
     * Create a new report controller instance.
     *
     * @param ReportRepositoryEloquent $report the report repository eloquent
     */
    public function __construct(ReportRepositoryEloquent $report)
    {
        $this->report = $report;
    }

    /**
     * Store a report to the database.
     *
     * @param Request $request the reporting request
     *
     * @return Illuminate\Http\Response
     */
    public function store(ReportRequest $request)
    {
        if ($request->ajax()) {
            $request['reporter_id'] = \Auth::user()->id;
            $report = $this->report->create($request->only(['reporter_id', 'post_id', 'description']));
            return $report ? response()->json(['responseText' => trans('frontend.report.create.success')], \Config::get('common.HTTP_CREATED_STATUS'))
                           : response()->json(['responseText' => trans('frontend.report.create.fails')], \Config::get('common.HTTP_BAD_REQUEST_STATUS'));
        }
    }
}
