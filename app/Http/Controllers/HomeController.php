<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //$getUser = DB::table('users')->get();
        //$getProjects = DB::table('projects')->get();
        //$getTasks = DB::table('tasks')->get();
        return view('home');
    }
    public function myTestAddToLog()
    {
        \LogActivity::addToLog('My Testing Add To Log.');
        dd('log insert successfully.');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function logActivity()
    {
        $logs = \LogActivity::logActivityLists();
        return view('logActivity', compact('logs'));
    }
    public function uploadOld(Request $request)
    {
        if ($request->hasFile('image')) {
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('images', $filename, 'public');
            Auth()->user()->update(['image' => $filename]);
        }
        return redirect()->refresh();
    }

    public function upload(Request $request)
    {
        $fileUpload = $request->file('image');
        // dd($fileUpload->clientExtension());
        $timestamp = Carbon::now()->timestamp;
        $extension = $fileUpload->clientExtension();
        $name = "assets/files/uploaded-$timestamp.$extension";
        
        Storage::disk('oss')->put($name, file_get_contents($fileUpload));

        if (Storage::disk('oss')->exists($name)) {
            $fileUrl = "https://cdn.erakomp.co.id/$name";
            User::Where('id', auth()->id)->update([
                'image' => $fileUrl
            ]);
            // return response()->json([
            //     'url' => $fileUrl,
            // ]);
            return redirect()->route('home');
        }

        return response()->json([
            'error' => 'Failed to upload file',
        ]);
    }

    public function displayImage($filename)
    {
        $path = storage_path('images/' . $filename);



        if (!File::exists($path)) {
            abort(404);
        }



        $file = File::get($path);

        $type = File::mimeType($path);



        $response = Response::make($file, 200);

        $response->header("Content-Type", $type);



        return $response;
    }
}
