@extends('layouts.app')

@section('content')
<div class="card border-success mb-4">
	<div class="card-header" style="font-size: 20px;font-weight: 600;">
		Create New Vehicle
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
	<form method="post" data-ajax-form action="{{ route('dashboard.crew.store') }}" data-execute-before="console.log('Storing...')" data-execute-after="hideModal();">
        @csrf
        @method('post')
        <div class="card-body">

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="model" name="model" placeholder="Model..." required autofocus autocomplete="off">
                <label for="model">Model</label>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="manufactory" name="manufactory" placeholder="Manufactory..." required autocomplete="off">
                <label for="manufactory">Manufactory</label>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="year" name="year" placeholder="Manufactory..." required autocomplete="off">
                <label for="year">Year</label>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="registration" name="registration" placeholder="Registration..." required autocomplete="off">
                <label for="registration">Registration</label>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="badge" name="badge" placeholder="Badge..." required autocomplete="off">
                <label for="badge">Badge</label>
                <div class="invalid-feedback"></div>
            </div>

        </div>

        <div class="card-footer text-end">
            <a href="{{ route('dashboard.crew.store') }}" class="btn btn-outline-success ajax">Save</a>

            {{-- <a href="{{ route('dashboard.users.index') }}" class="btn btn-outline-primary ajax" data-execute-after="assignDT('dataTable')">@lang('dashboard.actions.index')</a> --}}
        </div>
	</form>
</div>
@endsection
