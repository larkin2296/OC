<?php

namespace App\Http\Controllers\Card;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Report\AttachmentService as Service;

class AttachmentController extends Controller
{
    protected $folder = 'back.report.attachment';

    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function index($reportId, $reportTabId)
    {
        /*是否是ajax*/
        if( request()->ajax() ) {
            return $this->service->datatables($reportId, $reportTabId);
        }
    }

    public function create($reportId, $reportTabId)
    {
        $results = $this->service->create($reportId, $reportTabId);

        return view(getThemeTemplate($this->folder  . '.create'))->with($results);
    }

    public function store($reportId, $reportTabId)
    {
        $results = $this->service->store($reportId, $reportTabId);

        return response()->json($results);
    }

    public function edit($reportId, $reportTabId, $attachmentId)
    {
        $results = $this->service->edit($reportId, $reportTabId, $attachmentId);

        return view(getThemeTemplate($this->folder  . '.edit'))->with($results);
    }

    public function update($reportId, $reportTabId, $attachmentId)
    {
        $results = $this->service->update($reportId, $reportTabId, $attachmentId);

        return response()->json($results);
    }

    public function show($reportId, $reportTabId, $attachmentId)
    {
        $results = $this->service->show($reportId, $reportTabId, $attachmentId);

        return view(getThemeTemplate($this->folder  . '.show'))->with($results);
    }

    public function destroy($reportId, $reportTabId, $attachmentId)
    {
        $results = $this->service->destroy($reportId, $reportTabId, $attachmentId);

        return response()->json($results);
    }
}
