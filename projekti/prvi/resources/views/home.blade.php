@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Dashboard') }}</span>
                    <a href="{{ route('project.create_project') }}" class="btn btn-primary">Create Project</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                @php
                $userProjects = $userProjects->sortBy('manager_id');
                @endphp

                @foreach($userProjects as $project)
                @if($project->manager_id == Auth::id())
                <hr>
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Project that you manage') }}</span>
                </div>
                @else
                <hr>
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Project that you work on') }}</span>
                </div>
                @endif
                <div class="project-card text-center">
                    <h3>{{ $project->name }}</h3>
                    <p>{{ $project->description }}</p>
                    <p>Price: ${{ $project->price }}</p>
                    <p>Jobs Finished: {{ $project->jobs_finished }}</p>
                    <p>Start Date: {{ $project->start_date }}</p>
                    <p>End Date: {{ $project->end_date }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


@endsection