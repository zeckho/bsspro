@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            {{ Breadcrumbs::render('courses.show', $course) }}
        </div>
    </div>
</div>

<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title">
                        {!! $course->name !!}
                        <a href="{{ route('lessons.create',$course->id) }}" class="btn btn-primary waves-effect waves-light mb-4 float-right" data-toggle="button" aria-pressed="false"><i class="mdi mdi-book-multiple"></i> Create Lesson</a>
                    </h4>
                    <footer class="blockquote-footer text-muted m-b-30">
                        created by {!! $course->user->name !!}
                    </footer>
                    @include('components.alert')
                    <div id="accordion">
                        @foreach ($course->lessons as $key => $lesson)
                            <div class="card mb-1">
                                <a href="#collapse{{$key}}" class="text-dark" data-toggle="collapse" aria-expanded="true" aria-controls="collapse{{$key}}">
                                    <div class="card-header p-3" id="heading{{$key}}">
                                        <h6 class="m-0 font-14">
                                            {!! $lesson->title !!}
                                            @if ($lesson->status == 'disable')
                                                <footer class="blockquote-footer text-muted float-right"><cite title="Status"><code class="highlighter-rouge">{!! $lesson->status !!}</code></cite></footer>
                                            @endif
                                        </h6>
                                    </div>
                                </a>
                        
                                <div id="collapse{{$key}}" class="collapse" aria-labelledby="heading{{$key}}" data-parent="#accordion">
                                    <div class="card-body">
                                        <p class="blockquote-footer text-muted m-b-20">Trainer <cite title="Source Title">{!! $lesson->user->name !!}</cite></p>
                                        <div class="embed-responsive embed-responsive-16by9 m-b-20">
                                            {!! $lesson->video_html !!}
                                        </div>
                                        <div>
                                            {!! $lesson->content !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>
@endsection