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
        <div class="col-lg-8">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 m-b-30 header-title">
                        {!! $courses->title !!}
                        @can('get-class')
                            @empty ($courses->user_courses)
                                <button class="btn btn-outline-info waves-effect waves-light float-right start-learn" data-id="{{ $courses->id }}" data-action="{{ route('classes.learn',$courses->id) }}"><span>GET CLASS</span></button>
                            @endempty
                        @endcan
                    </h4>
                    @include('components.alert')
                    <p class="card-text">
                        {!! $courses->description !!}
                    </p>
                </div>
            </div>
        </div> <!-- end col -->
        <div class="col-lg-4">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Lessons</h4>
                    <ul>
                        @if ($courses->user_courses)
                            @foreach ($courses->lessons as $key => $lesson)
                                <li> <a href="#" id="lesson{{$key}}" data-toggle="modal" data-target=".bs-example-modal-center" data-video="{{$lesson->video}}" data-title="{{ $lesson->title }}"> {{ $lesson->title }} </a></li>
                            @endforeach
                        @else
                            @foreach ($courses->lessons as $lesson)
                                <li>{{ $lesson->title }}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- end row -->
</div>

<div id="modalVideo" class="modal fade bs-example-modal-center" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0 title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {{-- <video id="videoLearn" class="video-js vjs-default-skin vjs-16-9" controls preload="none" data-setup='{ "techOrder": ["youtube", "html5"], "sources": [], "youtube": { "ytControls": 0, "showinfo": 0, "customVars": { "wmode": "transparent" } } }'></video> --}}
                <video id="videoLearn" class="video-js vjs-default-skin vjs-16-9" controls data-setup='{}'></video>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/video-js.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/video.min.js') }}"></script>
<script src="{{ asset('js/Youtube.min.js') }}"></script>
<script type="text/javascript">
    $("body").on("click",".start-learn",function(){
            var current_object = $(this);
            swal({
                title: "Are you sure?",
                text: "Do yo want to learn this course?",
                icon: "warning",
                buttons: {
                    cancel : 'Cancel',
                    confirm : {text:'Okay!',className:'sweet-success'}
                },
                // dangerMode: true,
            })
            .then((response) => {
                if (response) {
                    var action = current_object.attr('data-action');
                    window.location = action;
                }
            });
        });
</script>
<script>
    $(document).ready(function(){
    $("#modalVideo").on('hide.bs.modal', function(){
        $('.title').text('');
        var player = videojs('videoLearn');
        player.ready(function() {
            player.pause();
        });
    });
    $("#modalVideo").on('show.bs.modal', function(e){
        var title = $(e.relatedTarget).data('title');
        $('.title').text(title);
        var src = $(e.relatedTarget).data('video');
        var player = videojs('videoLearn');
        var poster = '{{$courses->image}}';
        // console.log(player);
        player.poster(poster);
        player.src({
            type: "video/youtube", 
            src: src
        });
    });
});
</script>
@endpush