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
                    <h4 class="mt-0 header-title">List Classes</h4>
                    @include('components.alert')
                    @foreach ($courses as $key => $course)
                        @if ($key % 4 == 0)
                        <div class="row m-b-30">
                            <div class="col-12">
                                <div class="card-deck-wrapper">
                                    <div class="card-deck">
                        @endif
                        <div class="card m-b-30">
                            <img class="card-img-top img-fluid" src="{{ $course->image }}" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title font-16 mt-0">{{ $course->title }}</h4>
                                <p class="card-text">{{ Str::limit($course->excerpt, 100) }}</p>
                                <p class="card-text">
                                    <small class="text-muted">{!! \Carbon\Carbon::createFromTimeStamp(strtotime($course->created_at))->diffForHumans() !!}</small>
                                    @if ($course->user_courses && ($course->user_courses->user_id == Auth::id()))
                                        {!! link_to_route('classes.view', 'LEARN', $course->slug,['class' => 'btn btn-outline-primary waves-effect waves-light float-right']) !!}
                                    @else
                                        {!! link_to_route('classes.view', 'VIEW', $course->slug,['class' => 'btn btn-outline-info waves-effect waves-light float-right']) !!}
                                    @endif
                                </p>
                            </div>
                        </div>
                        @if ($key % 4 == 3)
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>
@endsection