@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            {{ Breadcrumbs::render('courses') }}
        </div>
    </div>
</div>

<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title">{!! $courses->name !!}</h4>
                    @include('components.alert')
                    <p class="card-text">
                        {!! $courses->description !!}
                    </p>
                    <ul>
                        @foreach ($courses->lessons as $lesson)
                            <li>{{ $lesson->title }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>
@endsection