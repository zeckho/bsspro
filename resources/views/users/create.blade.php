@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                @if ($user)
                    {{ Breadcrumbs::render('users.edit', $user) }}
                @else
                    {{ Breadcrumbs::render('users.create') }}
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
                            @if ($user)
                                Edit
                            @else
                                Create
                            @endif Users
                        </h4>
                        @include('components.alert')
                        @if ($user)
                            {!! Form::model($user, ['route' => ['users.update', $user->id]]) !!}
                            @method('PATCH')
                        @else                            
                            {!! Form::open(['route' => 'users.store']) !!}
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
                                {!! Form::label('email', 'Email') !!}
                                {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Type email', 'required' => true, 'data-parsley-type' => 'email']) !!}

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                {!! Form::label('role', 'Role') !!}
                                {!! Form::select('role', $roles, null, ['class' => 'form-control']) !!}
                                
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                {!! Form::label('password', 'Password') !!}
                                @role('superadmin')
                                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Type Password (leave it blank for the default password "secret")', 'required' => false]) !!}
                                @else
                                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Type Password', 'required' => true]) !!}
                                @endrole

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group m-b-0">
                                <div>
                                    {!! Form::submit('Submit', ['class' => 'btn btn-primary waves-effect waves-light']) !!}
                                    <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                        Reset
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
            $('form').parsley();
        });
    </script>
@endpush