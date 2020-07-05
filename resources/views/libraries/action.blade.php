@can('library-edit')
<a href="{{ route('libraries.edit',$query->id) }}" class="btn btn-sm btn-primary"><span class="mdi mdi-pencil">Edit</span></a>
@endcan
@can('library-delete')
<button class="btn btn-sm btn-danger remove-library" data-id="{{ $query->id }}" data-action="{{ route('libraries.destroy',$query->id) }}"><span class="mdi mdi-delete">Delete</span></button>
@endcan