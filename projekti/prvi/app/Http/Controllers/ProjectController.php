<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $post = $request->post();
        $user = User::find(Auth::id());

        try {
            $postUserIds = array_filter($post['users']);
            $postUserIds = array_unique($postUserIds);
            $postUsers = User::whereIn('id', $postUserIds)->get();

            $userArray = collect([$user]);
            $userArray = $userArray->merge($postUsers);

            foreach ($userArray as $singleUser) {
                $singleUser->createdProjects()->create([
                    'name' => $post['name'],
                    'description' => $post['description'],
                    'price' => $post['price'],
                    'jobs_finished' => $post['jobs_finished'],
                    'start_date' => $post['start_date'],
                    'end_date' => $post['end_date'],
                    'manager_id' => Auth::id()
                ]);
            }

            return back()->with('message', 'Succesfully Created');
        } catch (MassAssignmentException $e) {
            return back()->with('message', 'Failed to create ' + $e);
        }
    }

    public function create()
    {
        $users = User::query()->orderBy('name', 'asc')->get()->except(Auth::id());
        return view('project.create_project', ['users' => $users]);
    }

    public function show(Project $project)
    {
        $users = User::query()->orderBy('name', 'asc')->get()->except(Auth::id());
        $isCreator = $project->creator->id === Auth::id();
        return view('project.show', ['project' => $project, 'users' => $users, 'isCreator' => $isCreator]);
    }

    public function getProjects()
    {
        $projects = Project::query()->orderBy('name', 'asc')->get();
        return response()->json($projects);
    }
}
