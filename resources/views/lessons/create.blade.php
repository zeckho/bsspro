@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            @if ($lesson)
                {{ Breadcrumbs::render('lessons.edit', $lesson) }}
            @else
                {{ Breadcrumbs::render('lessons.create') }}
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
                        @if ($lesson)
                        Edit
                        @else
                        Create
                        @endif Lessons
                    </h4>
                    @include('components.alert')
                    @if ($lesson)
                    {!! Form::model($lesson, ['route' => ['lessons.update', $lesson->id]]) !!}
                    @method('PATCH')
                    @else
                    {!! Form::open(['route' => 'lessons.store']) !!}
                    @endif
                    {!! Form::hidden('c_id', request()->course) !!}
                    <div class="form-group">
                        {!! Form::label('course', 'Course') !!}
                        {!! Form::select('course_id', $courses, old('course_id'), ['class' => 'form-control select2', 'required' => true]) !!}

                        @error('course')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('title', 'Title') !!}
                        {!! Form::text('title', old('title'), array_merge(['class' => 'form-control', 'placeholder' => 'Type title', 'required' => true])) !!}

                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('video', 'Video') !!}
                        {!! Form::text('video', old('video'), array_merge(['class' => 'form-control', 'placeholder' => 'Type Video URL (https://www.youtube.com/watch?v=xxx)', 'required' => true])) !!}

                        @error('video')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('content', 'Content') !!}
                        {!! Form::textarea('content',old('content'),['id' => 'content']) !!}

                        @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('trainer', 'Trainer') !!}
                        {!! Form::select('user_id', $trainers, old('user_id'), ['class' => 'form-control select2', 'required' => true]) !!}
                    
                        @error('user_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
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
                            {!! link_to_route('lessons.index', 'Cancel', null, ['class' => 'btn btn-secondary waves-effect m-l-5']) !!}
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
    <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script src="{{ asset('plugins/parsleyjs/parsley.min.js') }}"></script>

<script>
    CKEDITOR.replace('content', {
        filebrowserImageBrowseUrl: '/filemanager?type=Images',
        filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/filemanager?type=Files',
        filebrowserUploadUrl: '/filemanager/upload?type=Files&_token='
    });
</script>
@endpush