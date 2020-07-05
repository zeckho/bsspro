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
                        {!! $course->title !!}
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
                                        <div class="card m-b-30">
                                            <video 
                                                id="vid{{$key}}" 
                                                class="video-js vjs-default-skin vjs-16-9"
                                                controls
                                                data-setup='{ "techOrder": ["youtube", "html5"], "sources": [{ "type": "video/youtube", "src": "{{$lesson->video}}"}], "youtube": { "ytControls": 0, "showinfo": 0, "customVars": { "wmode": "transparent", "aspectRatio": "9:16" } } }'>
                                            </video>
                                            <div class="card-body">
                                                <h4 class="card-title font-16 mt-0">{!! $lesson->title !!}</h4>
                                                <p class="card-text">
                                                    <small class="text-muted">Trainer <cite title="Source Title">{!! $lesson->user->name !!}</cite></small>
                                                </p>
                                                <p class="card-text">
                                                    {!! $lesson->content !!}
                                                </p>
                                            </div>
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

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/video-js.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/video.min.js') }}"></script>
    <script src="{{ asset('js/Youtube.min.js') }}"></script>
@endpush