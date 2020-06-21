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
                        {!! Form::checkbox('status', null, true, ['switch'=>'bool', 'id' => 'status']); !!}
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
                            <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                Cancel
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>
@endsection

@push('scripts')
<script src="{{ asset('plugins/parsleyjs/parsley.min.js') }}"></script>
<script>
    $(document).ready(function() {
        //$('form').parsley();
    });
</script>
@endpush