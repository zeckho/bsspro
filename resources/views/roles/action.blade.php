@can('role-edit')    
<a href="{{ route('roles.edit',$query->id) }}" class="btn btn-sm btn-primary"><span class="mdi mdi-pencil">Edit</span></a>
@endcan
@can('role-delete')
<button class="btn btn-sm btn-danger remove-role" data-id="{{ $query->id }}" data-action="{{ route('roles.destroy',$query->id) }}"><span class="mdi mdi-delete">Delete</span></button>
@endcan