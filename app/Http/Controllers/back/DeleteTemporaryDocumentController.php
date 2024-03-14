<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\TemporaryDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteTemporaryDocumentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $temporaryImage = TemporaryDocument::where('folder', request()->getContent())->first();
        if ($temporaryImage) {
            Storage::deleteDirectory('/public/document/tmp/'. $temporaryImage->folder);
            $temporaryImage->delete();
        }
        return response()->noContent();
    }
}
