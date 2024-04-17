@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Create Project') }}
                </div>

                <div class="card-body">
                    <div class="project-card text-center">

                        @if(session('message'))
                        <p>{{ session('message') }}</p>
                        @endif

                        <form action="{{ route('project.store') }}" method="POST">
                            @csrf
                            <label for="name">Name:</label><br>
                            <input type="text" id="name" name="name"><br>

                            <label for="description">Description:</label><br>
                            <textarea id="description" name="description"></textarea><br>

                            <label for="price">Price:</label><br>
                            <input type="text" id="price" name="price"><br>

                            <label for="jobs_finished">Completed Jobs:</label><br>
                            <input type="text" id="jobs_finished" name="jobs_finished"><br>

                            <label for="start_date">Start Date:</label><br>
                            <input type="date" id="start_date" name="start_date"><br>

                            <label for="end_date">End Date:</label><br>
                            <input type="date" id="end_date" name="end_date"><br>

                            <label>Select Users:</label><br>
                            <div class="p-1">
                                @foreach ($users as $user)
                                <div class="form-check" style="display: inline-block; margin-right: 10px;">
                                    <input class="form-check-input" type="checkbox" name="users[]" id="user{{$user->id}}" value="{{ $user->id }}">
                                    <label class="form-check-label" for="user{{$user->id}}">
                                        {{ $user->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>

                            <button type="submit" class="btn btn-primary float-right">Create Project</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection