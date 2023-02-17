@extends('layouts.app')

@section('content')
<style>.actions {width: 5rem !important;} #dataTable1 TR TD {margin: 0px !important;padding: 0px !important;}</style>
    <div class="card mb-4">
        <div class="card-header">
		  <div class="d-flex justify-content-between">
            <div class="h5">Crew List</div>
            <div class="title">{{ config('app.name') }}</div>
            <div class="actions">@can('users.create')<a class="btn btn-outline-success ajax" href="{{ route('dashboard.crew.create') }}">Create</a> @endcan</div>
		  </div>
        </div>
	@if (Session::has('error'))
        <div id="ialert" class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
	@endif

	@if (Session::has('success'))
        <div id="ialert" class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
	@endif

	<div class="card-body">
		<div class="table-responsive1">
			<table class="table table-border table-striped table-hover" aria-clickable="false" id="dataTable" data-dt-url="{{ route('dashboard.crew.index') }}">
				<thead>
					<tr>
						<th data-column-name="fullname">Full Name</th>
						<th data-column-name="gender">Gender</th>
						<th data-column-name="phone">Phone No</th>
						{{-- <th data-column-name="country_id">Country</th>
						<th data-column-name="profession_id">Profession</th> --}}
						<th data-column-name="id_type">ID Type</th>
						<th data-column-name="id_no">ID No</th>
						<th data-column-name="dob">Date of Birth</th>
						<th data-column-name="actions" class="actions">Actions</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>

        <div class="card-footer">
            {{-- $rows->links() --}}
        </div>
    </div>
@endsection
@if( ! request()->ajax() )
{{-- @include('layouts.partials.datatables', ['table'=>'dataTable']) --}}
@endif
