@can('lesson-edit')
<a href="{{ route('lessons.edit',$query->id) }}" class="btn btn-sm btn-primary"><span class="mdi mdi-pencil">Edit</span></a>
@endcan
@can('lesson-delete')
<button class="btn btn-sm btn-danger remove-lesson" data-id="{{ $query->id }}" data-action="{{ route('lessons.destroy',$query->id) }}"><span class="mdi mdi-delete">Delete</span></button>
@endcan