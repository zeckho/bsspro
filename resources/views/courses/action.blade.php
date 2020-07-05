@can('lesson-list')
<a href="{{ route('courses.show',$query->id) }}" class="btn btn-sm btn-info"><i class="mdi mdi-book-multiple"></i> <span>Lessons</span> <span class="badge badge-light"> {{ $query->lessons()->count() }}</span></a>
@endcan
@can('course-edit')
<a href="{{ route('courses.edit',$query->id) }}" class="btn btn-sm btn-primary"><i class="mdi mdi-pencil"></i> <span>Edit</span></a>
@endcan
@can('course-delete')
<button class="btn btn-sm btn-danger remove-course" data-id="{{ $query->id }}" data-action="{{ route('courses.destroy',$query->id) }}"><i class="mdi mdi-delete"></i><span>Delete</span></button>
@endcan