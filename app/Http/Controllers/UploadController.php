<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{
    public function uploadFile(Request $request)
    {
        // $fileUpload = $request->file('image');
        $fileUpload = $request->file('file');
        // dd($fileUpload->clientExtension());
        $timestamp = Carbon::now()->timestamp;
        $extension = $fileUpload->clientExtension();
        $filename = $fileUpload->getClientOriginalName();
        // $name = "assets/files/uploaded-$timestamp.$extension";
        $name = "assets/files/uploaded-$filename";
        
        Storage::disk('oss')->put($name, file_get_contents($fileUpload));

        if (Storage::disk('oss')->exists($name)) {
            $fileUrl = `https://cdn.erakomp.co.id/$name`;
            User::Where('id',Auth::id())->update([
                'file' => $fileUrl
            ]);
            return response()->json([
                'url' => $fileUrl,
            ]);
            // return redirect()->route('home');
        }

        return response()->json([
            'error' => 'Failed to upload file',
        ]);
    }
}
