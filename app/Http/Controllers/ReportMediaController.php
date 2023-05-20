<?php

namespace App\Http\Controllers;

use App\Data\Report\ReportOutputData;
use App\Data\ReportMedia\ReportMediaCreateData;
use App\Data\ReportMedia\ReportMediaOutputData;
use App\Models\Report;
use App\Models\ReportMedia;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ReportMediaController extends Controller
{
    // TODO

    use HttpResponses;

    const route = 'report-media';

    public function index()
    {
        // (array) $data = ReportMediaOutputData::collection(ReportMedia::paginate())->include('report')->toArray();
        (array) $data = ReportMediaOutputData::collection(ReportMedia::paginate())->toArray();
        return $this->successPaginate($data, null, Response::HTTP_OK);
    }

    public function store(ReportMediaCreateData $req)
    {
        (string) $fileName = 'attachment-' . $req->attachment->hashName();
        (string) $fileAttachmentPath = $req->attachment->storeAs('public/report-media', $fileName);

        $reportMedia = new ReportMedia();
        $reportMedia->report_id = $req->report_id;
        $reportMedia->attachment = $fileAttachmentPath;

        (bool) $isSuccess = $reportMedia->save();

        if (!$isSuccess) {
            Storage::delete($fileAttachmentPath);
            return $this->error(null, 'Register failed', Response::HTTP_BAD_REQUEST);
        }

        (array) $data = ReportMediaOutputData::from($reportMedia)->toArray();

        return $this->success($data, 'Report media successfully stored', Response::HTTP_OK);
    }

    // php artisan route:list -> somehow malah menerima api/report-media/{report_medium}
    public function show(ReportMedia $reportMedium)
    {
        (array) $data = ReportMediaOutputData::from($reportMedium)->toArray();
        return  $this->success($data, null, Response::HTTP_OK);
    }

    public function update(Request $request, ReportMedia $reportMedia)
    {
        return $this->error(null, 'Report Media cannot be updated', Response::HTTP_BAD_REQUEST);
    }

    // php artisan route:list -> somehow malah menerima api/report-media/{report_medium}
    public function destroy(ReportMedia $reportMedium)
    {
        //
        (bool) $isSuccess = $reportMedium->delete();
        if ($isSuccess) {
            return $this->success([], 'Report media successfully deleted', Response::HTTP_OK);
        }

        return $this->error(null, 'Report media failed deleted', Response::HTTP_BAD_REQUEST);
    }

    public function restore(string $id)
    {
        $reportMedia = ReportMedia::withTrashed()->where('id', $id)->first();
        if ($reportMedia == null)
            throw new NotFoundHttpException();

        (bool) $isSuccess = $reportMedia->restore();
        if ($isSuccess) {
            (array) $data = ReportMediaOutputData::from($reportMedia)->toArray();
            return $this->success($data, 'Report media successfully restored', Response::HTTP_OK);
        }
        return $this->error(null, 'Report media failed restored', Response::HTTP_BAD_REQUEST);
    }
}
