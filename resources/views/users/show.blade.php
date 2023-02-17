@extends('layouts.app')

@section('content')
<div class="card @if(request()->route()->getName()=='dashboard.users.delete') border-danger @else border-info @endif mb-4">
	<div class="card-header">
		@lang('users.show_header')
	</div>

	@if (Session::has('error'))
        <div id="ialert" class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
	@endif
	
	@if (Session::has('success'))
        <div id="ialert" class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
	@endif


	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-border table-striped">
			  <tbody class="@if( ! $row->is_active ) bg-warning @endif">
				<tr><th>@lang('users.datafield_name')</th><td>{{ $row->name }}</td></tr>
				<tr><th>@lang('users.datafield_email')</th><td>{{ $row->email }}</td></tr>
				<tr><th>@lang('users.datafield_roles')</th><td>@foreach($row->roles as $role)<a class="badge rounded-pill text-bg-success text-decoration-none" href="">{{ $role->name }}</a> @endforeach</td></tr>
			  </tbody>
			</table>
		</div>
	</div>

	<div class="card-footer text-end">
	  @if(request()->route()->getName()=='dashboard.users.delete')
		@can('users.delete')
		<form method="post" class="d-inline" action="{{ route('dashboard.users.destroy', $row->id) }}" data-ajax-form data-execute-after="assignDT('dataTable')">
		  @csrf 
		  @method('delete')
		  <button class="btn btn-danger px-3" type="submit" role="button">@lang('dashboard.actions.delete')</button>
		</form>
		@endcan
	  @else
		@can('users.edit')
		   <a href="{{ route('dashboard.users.edit', $row->id) }}" class="btn btn-outline-warning ajax">@lang('dashboard.actions.edit')</a>
		@endcan
		
		@can('users.delete')
		   <a href="{{ route('dashboard.users.delete', $row->id) }}" class="btn btn-outline-danger ajax">@lang('dashboard.actions.delete')</a>
		@endcan
	  @endif
		<a href="{{ route('dashboard.users.index') }}" class="btn btn-outline-primary ajax" data-execute-after="assignDT('dataTable')">@lang('dashboard.actions.index')</a>
	</div>
</div>
@endsection