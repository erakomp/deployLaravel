<?php
namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Create a comment for tasks and leads
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
        ]);

        $modelsMapping = [
            'task' => 'App\Models\Task',
            'lead' => 'App\Models\Lead',
            'project' => 'App\Models\Project',
        ];
        
        if (!array_key_exists($request->type, $modelsMapping)) {
            Session::flash('flash_message_warning', __('Could not create comment, type not found'));
            throw new \Exception("Could not create comment with type " . $request->type);
            return redirect()->back();
        }

        $model = $modelsMapping[$request->type];
        $source = $model::whereExternalId($request->external_id)->first();
        $source->comments()->create(
            [
                'description' => clean($request->description),
                'user_id' => auth()->user()->id
            ]
        );

        
        Session::flash('flash_message', __('Comment successfully added')); //Snippet in Master.blade.php
        \LogActivity::addToLog('just commented');

        return redirect()->back();
    }
    public function logActivity()
    {
        $logs = \LogActivity::logActivityLists();
        return view('logActivity', compact('logs'));
    }
}
