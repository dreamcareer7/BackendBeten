@extends('layouts.app')

@section('content')
<style>.actions {width: 5rem !important;}</style>
    <div class="card mb-4">
        <div class="card-header">
            @lang('users.model_header')
        </div>

        <div id="ialert" class="" role="alert"></div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-border table-striped table-hover datatable" aria-clickable="false" id="dataTable" data-dt-url="{{ route('dashboard.users.index') }}">
				<thead>
					<tr>
						<th data-column-name="name">@lang('users.datafield_name')</th>
						<th data-column-name="email">@lang('users.datafield_email')</th>
						<th data-column-name="is_active">@lang('users.datafield_is_active')</th>
						{{-- <th data-column-name="roles">@lang('users.datafield_roles')</th> --}}
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
