@can('user-edit')    
<a href="{{ route('users.edit',$query->id) }}" class="btn btn-sm btn-primary"><span class="mdi mdi-pencil">Edit</span></a>
@endcan
@can('user-delete')
<button class="btn btn-sm btn-danger remove-user" data-id="{{ $query->id }}" data-action="{{ route('users.destroy',$query->id) }}"><span class="mdi mdi-delete">Delete</span></button>
@endcan