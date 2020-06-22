@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            @if ($course)
            {{ Breadcrumbs::render('courses.edit', $course) }}
            @else
            {{ Breadcrumbs::render('courses.create') }}
            @endif
        </div>
    </div>
</div>
<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title">
                        @if ($course)
                            Edit
                        @else
                            Create
                        @endif Courses
                    </h4>
                    @include('components.alert')
                    @if ($course)
                    {!! Form::model($course, ['route' => ['courses.update', $course->id]]) !!}
                    @method('PATCH')
                    @else
                    {!! Form::open(['route' => 'courses.store']) !!}
                    @endif
                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', old('name'), array_merge(['class' => 'form-control', 'placeholder' => 'Type name', 'required' => true])) !!}

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('description', 'Description') !!}
                        {!! Form::textarea('description',old('description'),['id' => 'content']) !!}

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('date', 'Date') !!}
                        <div class="col-6">
                            <div class="input-group">
                                {!! Form::text('started_at', old('started_at'), ['id' => 'date-start', 'class' => 'form-control floating-label', 'placeholder' => 'Start Date']) !!}
                                {!! Form::text('finish_at', old('finish_at'), ['id' => 'date-end', 'class' => 'form-control floating-label', 'placeholder' => 'End Date']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::checkbox('status', null, old('status')=='disable' ? false : true, ['switch'=>'bool', 'id' => 'status']); !!}
                        <label for="status" data-on-label="yes" data-off-label="no"></label>
                        
                        @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group m-b-0">
                        <div>
                            {!! Form::submit('Submit', ['class' => 'btn btn-primary waves-effect waves-light']) !!}
                            {!! link_to_route('courses.index', 'Cancel', null, ['class' => 'btn btn-secondary waves-effect m-l-5']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>
@endsection

@push('styles')
    <link href="{{ asset('plugins/bootstrap-md-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script src="{{ asset('plugins/bootstrap-md-datetimepicker/js/moment-with-locales.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-md-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<script src="{{ asset('plugins/parsleyjs/parsley.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('form').parsley();

        $('#date-end').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
        $('#date-start').bootstrapMaterialDatePicker({ weekStart : 0, time: false, minDate : new Date() }).on('change', function(e, date)
        {
        $('#date-end').bootstrapMaterialDatePicker('setMinDate', date);
        });
    });
</script>
<script>
    CKEDITOR.replace('content', {
        filebrowserImageBrowseUrl: '/filemanager?type=Images',
        filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/filemanager?type=Files',
        filebrowserUploadUrl: '/filemanager/upload?type=Files&_token='
    });
</script>
@endpush