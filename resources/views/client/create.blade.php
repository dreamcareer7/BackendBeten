@extends('layouts.app')

@section('content')
<div class="card border-success mb-4">
	<div class="card-header" style="font-size: 20px;font-weight: 600;">
		Create New Client
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
	<form method="post" data-ajax-form action="{{ route('dashboard.client.store') }}" data-execute-before="console.log('Storing...')" data-execute-after="hideModal();">
        @csrf
        @method('post')
        <div class="card-body">

            <div class="form-floating mb-3">
            <input type="text" class="form-control" id="fname" name="fullname" value="{{ old('fullname') ?? '' }}" placeholder="Full Name..." required autofocus autocomplete="off">
            <label for="fname">Full Name</label>
            <div class="invalid-feedback"></div>
            </div>

            <div class="form-floating mb-3">
                <select name="gender" id="gender" class="form-control">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <label for="gender">Gender</label>
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
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') ?? '' }}" placeholder="Phone Number...">
                <label for="phone">Phone Number</label>
                <div class="invalid-feedback"></div>
                </div>

                <div class="form-floating mb-3">
                <input type="text" class="form-control" id="id_type" name="id_type" value="{{ old('id_type') ?? '' }}" placeholder="ID Type...">
                <label for="phone">ID Type</label>
                <div class="invalid-feedback"></div>
                </div>

                <div class="form-floating mb-3">
                <input type="text" class="form-control" id="id_number" name="id_number" value="{{ old('id_number') ?? '' }}" placeholder="ID Number...">
                <label for="phone">ID Number</label>
                <div class="invalid-feedback"></div>
                </div>

                <div class="form-floating mb-3">
                <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob') ?? '' }}" placeholder="Date of Birth...">
                <label for="phone">Date of Birth</label>
                <div class="invalid-feedback"></div>
                </div>

                <div class="border rounded px-1">
                    <div class="form-switch">
                    <input type="hidden"  value="0" name="is_handicap">
                    <input class="form-check-input" type="checkbox"  value="1" name="is_handicap" checked id="is_handicap">
                    <label class="form-check-label" for="is_handicap">Is Handicap?</label>
                    </div>
                </div>
            </div>


            </div>


        </div>

        <div class="card-footer text-end">
            <a href="{{ route('dashboard.client.store') }}" class="btn btn-outline-success ajax">Save</a>

            {{-- <a href="{{ route('dashboard.users.index') }}" class="btn btn-outline-primary ajax" data-execute-after="assignDT('dataTable')">@lang('dashboard.actions.index')</a> --}}
        </div>
	</form>
</div>
@endsection
