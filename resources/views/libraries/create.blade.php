@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            @if ($library)
            {{ Breadcrumbs::render('libraries.edit', $library) }}
            @else
            {{ Breadcrumbs::render('libraries.create') }}
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
                        @if ($library)
                        Edit
                        @else
                        Create
                        @endif Library
                    </h4>
                    @include('components.alert')
                    @if ($library)
                    {!! Form::model($library, ['route' => ['libraries.update', $library->id]]) !!}
                    @method('PATCH')
                    @else
                    {!! Form::open(['route' => 'libraries.store']) !!}
                    @endif
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
                        {!! Form::label('slug', 'Slug') !!}
                        {!! Form::text('slug', old('slug'), array_merge(['class' => 'form-control', 'placeholder' => 'leave it empty form auto generate slug', 'required' => false])) !!}

                        @error('slug')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('image', 'Image') !!}
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-light waves-effect waves-light">
                                    <i class="mdi mdi-file-image"></i> Choose
                                </a>
                            </span>
                            {!! Form::text('image', old('image'), ['class' => 'form-control', 'id' => 'thumbnail']) !!}
                        </div>
                        <div id="holder" class="m-t-20"></div>
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
                        {!! Form::label('excerpt', 'Excerpt') !!}
                        {!! Form::textarea('excerpt', old('excerpt'), array_merge(['class' => 'form-control', 'placeholder' => 'Type excerpt', 'required' => true, 'rows' => 3])) !!}
                    
                        @error('excerpt')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('description', 'Description') !!}
                        {!! Form::textarea('description',old('description'),['id' => 'content']) !!}

                        @error('description')
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
<link href="{{ asset('plugins/bootstrap-md-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script src="{{ asset('plugins/parsleyjs/parsley.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-md-datetimepicker/js/moment-with-locales.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-md-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

<script>
    $(document).ready(function() {
        $('form').parsley();

        $('#lfm').filemanager('image');
        $('#date-end').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
        $('#date-start').bootstrapMaterialDatePicker({ weekStart : 0, time: false }).on('change', function(e, date)
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