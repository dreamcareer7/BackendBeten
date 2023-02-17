@extends('layouts.app')

@section('content')
<div class="card border-warning mb-4">
	<div class="card-header">
		@lang('users.edit_header')
	</div>

	<div id="ialert" class="" role="alert"></div>
	<form method="post" data-ajax-form action="{{ route('dashboard.users.update', $row->id) }}" data-execute-before="console.log('Stroing...')" data-row-target="#articlesContainer" data-execute-after1="do_click('.users');hideModal();" data-execute-after="assignDT('dataTable')">
@csrf
@method('put')
	<div class="card-body">

		<div class="form-floating mb-1">
		  <input type="text" class="form-control" id="iname" name="name" value="{{ $row->name ?? old('name') ?? '' }}" placeholder="@lang('users.placeholder_name')" required autofocus autocomplete="off">
		  <label for="iname">@lang('users.datafield_name')</label>
		  <div class="invalid-feedback"></div>
		</div>

		<div class="form-floating mb-1">
		  <input type="email" class="form-control" id="iemail" name="email" value="{{ $row->email ?? old('email') ?? '' }}" placeholder="@lang('users.placeholder_email')"  autocomplete="off">
		  <label for="iemail">@lang('users.datafield_email')</label>
		  <div class="invalid-feedback"></div>
		</div>

		<div class="row g-1 mb-1">
		  <div class="col">
			<div class="form-floating mb-1">
			  <input type="password" class="form-control" id="ipassword" name="password" value="{{ old('password') ?? '' }}" placeholder="@lang('users.placeholder_password')" autocomplete="new-password" aria-autocomplete="list">
			  <label for="ipassword">@lang('users.datafield_password')</label>
			  <div class="invalid-feedback"></div>
			</div>

			<div class="form-floating mb-1">
			  <input type="password" class="form-control" id="ipassword_confirmation" name="password_confirmation" value="{{ old('password_confirmation') ?? '' }}" placeholder="@lang('users.placeholder_password_confirmation')" autocomplete="new-password" aria-autocomplete="list">
			  <label for="ipassword_confirmation">@lang('users.datafield_password_confirmation')</label>
			  <div class="invalid-feedback"></div>
			</div>

			<div class="border rounded px-1">
				<div class="form-check form-switch">
				  <input type="hidden"  value="0" name="is_active">
				  <input class="form-check-input" type="checkbox"  value="1" name="is_active" id="iis_active" @if( $row->is_active == 1) checked @endif>
				  <label class="form-check-label" for="iis_active">@lang('users.datafield_is_active')</label>
				</div>
			</div>
			<div class="border rounded px-1 position-relative">
				<div class="form-check form-switch">
				  <input type="hidden"  value="0" name="send_confirmation">
				  <input class="form-check-input" type="checkbox" disabled value="1" name="send_confirmation" id="isend_confirmation">
					@if ( trans()->has('users.datafield_send_confirmation_info'))<i class="fa fa-info-circle inside-input" title="@lang('users.datafield_send_confirmation_info')"></i>@endif
				  <label class="form-check-label" for="isend_confirmation">@lang('users.datafield_send_confirmation')</label>
				</div>
			</div>

		  </div>

		  <div class="col">
			<div class="form-floating1">
				<label for="ilang">@lang('users.datafield_roles')</label>
				<select class="form-select" multiple size="6" name="roles[]" id="iroles">
				  @foreach($roles as $role)
					<option value="{{ $role->id }}" @if( $row->hasRole( $role->name ) ) selected @endif>{{ $role->name }}</option>
				  @endforeach
				</select>
			</div>
		  </div>
		</div>
	</div>

	<div class="card-footer text-end">
		@can('users.edit')
		   <button role="submit" class="btn btn-outline-warning">@lang('dashboard.actions.save')</button>
		@endcan

		<a href="{{ route('dashboard.users.index') }}" class="btn btn-outline-primary ajax" data-execute-after="assignDT('dataTable')">@lang('dashboard.actions.index')</a>
	</div>
	</form>
</div>
@endsection
