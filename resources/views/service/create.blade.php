@extends('layouts.app')

@section('content')
<div class="card border-success mb-4">
	<div class="card-header" style="font-size: 20px;font-weight: 600;">
		Create New Service
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
	<form method="post" data-ajax-form action="{{ route('dashboard.service.store') }}" data-execute-before="console.log('Storing...')" data-execute-after="hideModal();">
        @csrf
        @method('post')
        <div class="card-body">

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') ?? '' }}" placeholder="Title..." required autofocus autocomplete="off">
                <label for="title">Title</label>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-floating mb-3">
                <select name="country_id" id="country_id" class="form-control">
                    <option>Choose Country</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ ucfirst($country->title) }}</option>
                    @endforeach
                </select>
                <label for="country_id">Country</label>
                <div class="invalid-feedback"></div>
            </div>

            <div class="row g-1 mb-1">
            <div class="col">
                <div class="form-floating mb-3">
                <input type="date" class="form-control" id="before_date" name="before_date" value="{{ old('before_date') ?? '' }}" placeholder="Before date...">
                <label for="phone">Before date</label>
                <div class="invalid-feedback"></div>
                </div>

                <div class="form-floating mb-3">
                <input type="date" class="form-control" id="exact_date" name="exact_date" value="{{ old('exact_date') ?? '' }}" placeholder="Exact date...">
                <label for="phone">Exact Date</label>
                <div class="invalid-feedback"></div>
                </div>

                <div class="form-floating mb-3">
                <input type="date" class="form-control" id="after_date" name="after_date" value="{{ old('after_date') ?? '' }}" placeholder="After date...">
                <label for="phone">After date</label>
                <div class="invalid-feedback"></div>
                </div>
            </div>


            </div>


        </div>

        <div class="card-footer text-end">
            <a href="{{ route('dashboard.service.store') }}" class="btn btn-outline-success ajax">Save</a>

            {{-- <a href="{{ route('dashboard.users.index') }}" class="btn btn-outline-primary ajax" data-execute-after="assignDT('dataTable')">@lang('dashboard.actions.index')</a> --}}
        </div>
	</form>
</div>
@endsection
