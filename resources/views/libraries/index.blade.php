@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            {{ Breadcrumbs::render('libraries') }}
        </div>
    </div>
</div>

<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title">List Libraries</h4>
                    @can('library-create')
                    <a href="{{ route('libraries.create') }}" class="btn btn-primary waves-effect waves-light mb-4" data-toggle="button" aria-pressed="false"><i class="mdi mdi-cellphone-link"></i> Create Library</a>
                    @endcan
                    @csrf
                    @include('components.alert')
                    {{$dataTable->table()}}
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>
@endsection

@push('scripts')
{{$dataTable->scripts()}}

<script type="text/javascript">
    $("body").on("click",".remove-library",function(){
            var current_object = $(this);
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this library!",
                icon: "warning",
                buttons: ["Cancel", "Delete!"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Poof! Library has been deleted!", {
                        icon: "success",
                    });
                    var action = current_object.attr('data-action');
                    var token = $('input[name="_token"]').attr('value');
                    var id = current_object.attr('data-id');
                    
                    $('body').html("<form class='form-inline remove-form' method='post' action='"+action+"'></form>");
                    $('body').find('.remove-form').append('<input name="_method" type="hidden" value="delete">');
                    $('body').find('.remove-form').append('<input name="_token" type="hidden" value="'+token+'">');
                    $('body').find('.remove-form').append('<input name="id" type="hidden" value="'+id+'">');
                    $('body').find('.remove-form').submit();
                }
            });
        });
</script>
@endpush