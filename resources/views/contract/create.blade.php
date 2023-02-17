@extends('layouts.app')

@section('content')
<div class="card border-success mb-4">
	<div class="card-header" style="font-size: 20px;font-weight: 600;">
		Create New Document
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
	<form method="post" data-ajax-form action="{{ route('dashboard.document.store') }}" data-execute-before="console.log('Storing...')" data-execute-after="hideModal();">
        @csrf
        @method('post')
        <div class="card-body">

            <div class="form-floating mb-3">
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') ?? '' }}" placeholder="Title..." required autofocus autocomplete="off">
            <label for="title">Title</label>
            <div class="invalid-feedback"></div>
            </div>


            <div class="form-floating mb-3">
            <input type="text" class="form-control" id="path" name="path" value="{{ old('path') ?? '' }}" placeholder="Path..." required autocomplete="off">
            <label for="path">Path</label>
            <div class="invalid-feedback"></div>
            </div>

            <div class="form-floating mb-3">
            <input type="text" class="form-control" id="model_type" name="model_type" value="{{ old('model_type') ?? '' }}" placeholder="Model Type..." required autocomplete="off">
            <label for="model_type">Model Type</label>
            <div class="invalid-feedback"></div>
            </div>

            <div class="form-floating mb-3">
            <input type="text" class="form-control" id="model_id" name="model_id" value="{{ old('model_id') ?? '' }}" placeholder="Model ID..." required autocomplete="off">
            <label for="model_id">Model ID</label>
            <div class="invalid-feedback"></div>
            </div>


        </div>

        <div class="card-footer text-end">
            <a href="{{ route('dashboard.document.store') }}" class="btn btn-outline-success ajax">Save</a>

            {{-- <a href="{{ route('dashboard.users.index') }}" class="btn btn-outline-primary ajax" data-execute-after="assignDT('dataTable')">@lang('dashboard.actions.index')</a> --}}
        </div>
	</form>
</div>
@endsection
