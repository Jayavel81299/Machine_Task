<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if($request->dataValue == 'yes'){
            $query = User::query();
            $query->where('id', '!=', auth()->user()->id);
            return datatables()->eloquent($query)
                ->addColumn('action', fn($plan) => [
                    'edit' => route('users.edit', $plan->id),
                    'delete' => route('users.destroy', $plan->id),
                    'url' => route('users.show', $plan->id),
                ])
                ->toJson();
        }else{
            return view('admin.pages.users.index');
        }
    }
    public function create()
    {
        return view('admin.pages.users.create');
    }
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        User::create($data);

        return response()->json([
            'success' => true,
            'message' => 'User successfully created!',
            'redirectUrl' => route('users.index'),
        ]);
    }
    public function edit(string $id)
    {
        $edit = User::findOrFail($id);
        return view('admin.pages.users.create', compact('edit'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validated();

        // If password is empty, don't update it
        if (!$request->filled('password')) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }
        $user->update($data);
        return response()->json(['redirectUrl' => route('users.index')]);
    }
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['delete_type' => 1]);
    }
}
