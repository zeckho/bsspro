@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            @if ($role)
            {{ Breadcrumbs::render('roles.edit', $role) }}
            @else
            {{ Breadcrumbs::render('roles.create') }}
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
                        @if ($role)
                            Edit
                        @else
                            Create
                        @endif Roles
                    </h4>
                    @include('components.alert')
                    @if ($role)
                        {!! Form::model($role, ['route' => ['roles.update', $role->id]]) !!}
                        @method('PATCH')
                    @else
                        {!! Form::open(['route' => 'roles.store']) !!}
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
                        {!! Form::label('permission', 'Permission') !!}
                        <br />
                        <input type="checkbox" id="switch6" switch="none">
                        <label for="switch6" data-on-label="" data-off-label=""></label>
                        <div class="row">
                            @php
                                $count = 1;
                            @endphp
                            @foreach($permission as $value)
                                @php
                                    if ($count%4 == 1)
                                    {
                                        echo "<div class='col-3'>";
                                    }
                                    // other stuff
                                    echo "<label>". Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) ." ". $value->name ."</label>";
                                    echo "<br />";
                                    if ($count%4 == 0)
                                    {
                                        echo "</div>";
                                    }
                                    $count++;
                                @endphp
                            @endforeach
                            @php
                                if ($count%4 != 1) echo "</div>";
                            @endphp
                        </div>
                        @error('permission')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group m-b-0">
                        <div>
                            {!! Form::submit('Submit', ['class' => 'btn btn-primary waves-effect waves-light']) !!}
                            {!! link_to_route('roles.index', 'Cancel', null, ['class' => 'btn btn-secondary waves-effect m-l-5']) !!}
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
    
    $("#switch6").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>
@endpush