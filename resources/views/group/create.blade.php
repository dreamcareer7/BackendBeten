@extends('layouts.app')

@section('content')
<div class="card border-success mb-4">
	<div class="card-header" style="font-size: 20px;font-weight: 600;">
		Create New Group
	</div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
	<div id="ialert" class="" role="alert"></div>
	<form method="post" data-ajax-form action="{{ route('dashboard.group.store') }}" data-execute-before="console.log('Storing...')" data-execute-after="hideModal();">
        @csrf
        @method('post')
        <div class="card-body">

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') ?? '' }}" placeholder="Title..." required autofocus autocomplete="off">
                <label for="title">Title</label>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-floating mb-3">
                <select name="crew_id" id="crew_id" class="form-control">
                    <option>Choose Crew</option>
                    @foreach($crews as $crew)
                        <option value="{{ $crew->id }}">{{ ucfirst($crew->fullname) }}</option>
                    @endforeach
                </select>
                <label for="crew_id">Crew</label>
                <div class="invalid-feedback"></div>
            </div>


        </div>

        <div class="card-footer text-end">
            <a href="{{ route('dashboard.group.store') }}" class="btn btn-outline-success ajax">Save</a>

            {{-- <a href="{{ route('dashboard.users.index') }}" class="btn btn-outline-primary ajax" data-execute-after="assignDT('dataTable')">@lang('dashboard.actions.index')</a> --}}
        </div>
	</form>
</div>
@endsection
