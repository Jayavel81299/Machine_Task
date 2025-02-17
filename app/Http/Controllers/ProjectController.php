<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\Request;
use App\Models\Project;
use Yajra\DataTables\Facades\DataTables;
use App\CheckProjectWay;
class ProjectController extends Controller
{
    use CheckProjectWay;
    public function index(Request $request)
    {
        if($request->dataValue == 'yes'){
            $query = Project::query();

            if(auth()->user()->role == 'project_manager'){
                $query->where('project_manager_id', auth()->user()->id);
            }

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
            return view('admin.pages.projects.index');
        }
    }
    public function create()
    {
        $managers = '';

        if (auth()->user()->role === 'admin') {
           $managers = $this->typeRole();
        }
        $members = User::where('role', 'team_member')->select('name', 'id')->get();
        return view('admin.pages.projects.create', compact('members', 'managers'));
        
    }
    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();
        if (auth()->user()->role == 'project_manager') {
            $validated['project_manager_id']  = auth()->user()->id;
        }else{
            $validated['project_manager_id'] = (int) $request->project_manager_id;
        }
        if (isset($validated['user_ids']) && is_array($validated['user_ids'])) {
            $validated['user_ids'] = implode(',', $validated['user_ids']);
        }
        Project::create($validated);
        return response()->json(['redirectUrl' => route('projects.index')]);
    }
    public function edit(string $id)
    {
        $edit = Project::findOrFail($id);
        $managers = '';
        if (auth()->user()->role === 'admin') {
            $managers = $this->typeRole();
         }
        $members = User::where('role', 'team_member')->select('name', 'id')->get();
        return view('admin.pages.projects.create', compact('edit', 'members', 'managers'));
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $validated = $request->validated();
        if (auth()->user()->role == 'project_manager') {
            $validated['project_manager_id']  = auth()->user()->id;
        }else{
            $validated['project_manager_id'] = (int) $request->project_manager_id;
        }
        if (isset($validated['user_ids']) && is_array($validated['user_ids'])) {
            $validated['user_ids'] = implode(',', $validated['user_ids']);
        }
        $project->update($validated);
        return response()->json(['redirectUrl' => route('projects.index')]);
    }
    public function destroy(string $id)
    {
        $user = Project::findOrFail($id);
        $user->delete();
        return response()->json(['delete_type' => 1]);
    }
}
