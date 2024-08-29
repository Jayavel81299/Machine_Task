<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        if($request->dataValue == 'yes'){
            $query = Task::query();
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            
            if ($startDate) {
                $startDate = \Carbon\Carbon::parse($startDate)->format('Y-m-d');
                $query->whereDate('start_date', '>=', $startDate);
            }
            
            if ($endDate) {
                $endDate = \Carbon\Carbon::parse($endDate)->format('Y-m-d');
                $query->whereDate('end_date', '<=', $endDate);
            }

            return DataTables::eloquent($query) 
                ->addColumn('project_manager_id', function($project) {
                    return User::whereId($project->project_manager_id)->pluck('name')->first();
                })
                ->addColumn('user_ids', function($project) {
                    $userIds = explode(',', $project->user_ids); 
                    return User::whereIn('id', $userIds)->pluck('name')->implode(', ');
                })
                ->addColumn('action', function($project) {
                    return [
                        'edit' => route('projects.edit', $project->id),
                        'delete' => route('projects.destroy', $project->id),
                        'url' => route('projects.show', $project->id),
                    ];
                })
                ->toJson();

            
        }else{
            return view('admin.pages.tasks.index');
        }
    }


    public function create()
    {
        $projects = Project::where('project_manager_id', auth()->user()->id)->select('id', 'name')->get();
        return view('admin.pages.tasks.create', compact('projects'));
    }
    public function getMembers(Request $request)
    {
        $projects = Project::whereId($request->project_id)->pluck('user_ids')->first();
        $users = User::whereIn('id', explode(',', $projects))->select('id', 'name')->get();
        return response()->json(['task_members' => $users], 200);
    }


    public function store(TaskRequest $request)
    {
        $validatedData = $request->validated();

        Task::create($validatedData);

        return response()->json(['redirectUrl' => route('tasks.index')]);
    }

    public function show(string $id)
    {
        //
    }

 
    public function edit(string $id)
    {
        $edit = User::findOrFail($id);
        $projects = Project::where('project_manager_id', auth()->user()->id)->select('id', 'name')->get();
        return view('admin.pages.tasks.create', compact('edit', 'projects'));
    }

    public function update(TaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $validatedData = $request->validated();

        // Update the task
        $task->update($validatedData);
        return response()->json(['redirectUrl' => route('tasks.index')]);
    }

    public function destroy(string $id)
    {
        $user = Task::findOrFail($id);
        $user->delete();
        return response()->json(['delete_type' => 1]);
    }
}
