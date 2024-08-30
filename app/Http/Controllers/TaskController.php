<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Yajra\DataTables\Facades\DataTables;

class TaskController extends Controller
{
   
    public function index(Request $request)
    {
        if($request->dataValue == 'yes'){
            $query = Task::query();
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            if(auth()->user()->role == 'project_manager'){
                $query->whereHas('project', function ($query) {
                    $query->where('project_manager_id', auth()->user()->id);
                });
            }
            if (auth()->user()->role == 'team_member') {
                $query->where('user_id', auth()->user()->id);
            }
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
                    return User::whereId($project->project->project_manager_id)->pluck('name')->first();
                })
                ->addColumn('name', function($project) {
                    return $project->project->name;
                })
                ->addColumn('action', function($project) {
                    return [
                        'edit' => route('tasks.edit', $project->id),
                        'view' => route('tasks.show', $project->id),
                        'delete' => route('tasks.destroy', $project->id),                    ];
                })
                ->toJson();
        }else{
            return view('admin.pages.tasks.index');
        }
    }


    public function create()
    {
        $project = new Project();
        if(auth()->user()->role == 'project_manager'){
            $project->where('project_manager_id', auth()->user()->id);
        }
        $projects = $project->select('id', 'name')->get();
        return view('admin.pages.tasks.create', compact('projects'));
    }

    public function edit(string $id)
    {
        $edit = Task::findOrFail($id);
        $project = new Project();
        if(auth()->user()->role == 'project_manager'){
            $project->where('project_manager_id', auth()->user()->id);
        }
        $projects = $project->select('id', 'name')->get();
        return view('admin.pages.tasks.create', compact('edit', 'projects'));
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
        $edit = Task::findOrFail($id);
        $manager = User::whereId($edit->project->project_manager_id)->pluck('name')->first();
        return view('admin.pages.tasks.show', compact('edit' , 'manager'));   
    }    

    public function update(TaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $validatedData = $request->validated();
        unset($validatedData['user_id']);        
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
