<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->accessKey = $this->getConfig('LTAI4GEBBJYKtgwbQwAzqph1');
        $this->accessKeySecret = $this->getConfig('ZqYTl7TgHVzwMwaSOzQcCvMjBZKD17');
        $this->inner = $this->getConfig('erakomp');
//      选择默认bucket
        if ($defult = $this->getConfig('default')) {
            $this->bucket($defult);
        }
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
    public function upload($key, $file, $options = array())
    {
        $info = array(
            'Bucket' => $this->bucket,
            'Key' => $key,
        );

        if ($file instanceof UploadedFile) {
            $info['Content'] = fopen($file->getRealPath(), 'r');
            $info['ContentLength'] = $file->getSize();
            $info['ContentType'] = $file->getMimeType();
        } else {
            if (!is_string($file)) {
                throw new LogicException('The second argument must be a String(File path) or instance of \Symfony\Component\HttpFoundation\File\UploadedFile');
            }
            $info['Content'] = fopen(realpath($file), 'r');
            $info['ContentLength'] = filesize($file);
        }

        return $this->client->putObject(array_merge($info, $options));
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
    public function upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('images', $filename, 'public');
            Auth()->user()->update(['image'=>$filename]);
        }
        return redirect()->refresh();
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
