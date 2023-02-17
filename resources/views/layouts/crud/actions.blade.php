@can($model_plural.'.show')
<a class="btn btn-sm btn-primary ajax" href="{{route('dashboard.'.$model_plural.'.show', $row->id)}}">V</a>
@endcan
@can($model_plural.'.edit')
<a class="btn btn-sm btn-warning ajax" href="{{route('dashboard.'.$model_plural.'.edit', $row->id)}}">E</a>
@endcan
@can($model_plural.'.delete')
<a class="btn btn-sm btn-danger ajax" href="{{route('dashboard.'.$model_plural.'.delete', $row->id)}}">D</a>
@endcan
