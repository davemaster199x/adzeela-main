@extends('layouts.app')
@section('content')
    @include('global.topnav')
    @include('global.sidemenu')
    <div id="wrapper">
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="page-title-box">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Adzeela</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <h4 class="page-title">
                            All TV Screen
                           
                        </h4>
                    </div>
                </div>
            </div>
            <div class="content">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-sm">
                        <div class="card">
                            <div class="card-header">
                                <h4>TV Screen</h4>
                            </div>
                            <div class="card-group">
                                <div class="card">

                                    <div class="card-body">
                                        <div class="col-xs-8">
                                            <div id="loop-preview" >
                                                <div class="item previews-container video-container"  >
                                                    <img src="{{ Storage::url('image1.jpg') }}" class="card-img" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div id="url_shows"></div> --}}
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        
                                        <form method="POST" action="{{route('tvscreen.addTvscreen')}}" id="tvscreenform">
                                            @csrf
                                            @method('POST')

                                            <div class="mb-2">
                                                <input name="title" type="text" class="form-control" id="title" placeholder="Title: TV Screen 1" required>
                                            </div>
                                            <div class="mb-2">
                                                <select name="size" id="size" class="form-control" aria-label="Size: Portrait / Landscape" required>
                                                    <option value="" selected>Select Orientation</option>
                                                    <option value="portrait">Portrait</option>
                                                    <option value="landscape">Landscape</option>
                                                </select>
                                            </div>
                                            <div class="mb-2">
                                                <select name="playlist_name" id="playlist" class="form-control" aria-label="Playlist: Select Playlist" required>
                                                    
                                                </select>
                                            </div>
                                            <div class="mb-2">
                                                
                                                <select name="tvscreen_loc" id="tvscreen_loc" class="form-control" aria-label="Select TV Screen Location" required>
                                                    <option value="" selected>Select TV Screen Location</option>
                                                    <option value="tv1">TV 1</option>
                                                    <option value="tv2">TV 2</option>
                                                </select>

                                            </div>
                                            
                                            <button type="submit" class="btn btn-success" id="tvscreenForm">
                                            Submit
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10 ">      
                        <div class="row">
                        @foreach($tvscreen as $screen)
                            
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">{{$screen->title}}</h3>
                                    </div>
                                <div class="card-body">
                                    
                                    <p class="card-text">
                                        <strong>Playlist Name:</strong> {{strtoupper($screen->playlist_name)}}
                                        <br>
                                        <strong>Orientation:</strong> {{strtoupper($screen->size)}}
                                        <br>
                                        <strong>TV screen location:</strong> {{strtoupper($screen->tvscreen_loc)}}
                                    </p>
                                   
                                    <input class="btn btn-primary" type="button" value="Go to URL" onclick="window.open('{{url('play/'.$screen->id)}}')" />
                                </div>
                                </div>
                            </div>

                        @endforeach
                        </div>
                    </div>
                </div>

            </div>
            </div>
        </div>

        
    </div>
@endsection

@push('scripts')
    <script>
        
        $(document).ready(function () {

            $('#size').on('change',function() {
                let orientation = $(this).val();
                $('#playlist').empty();
                $('#playlist').append('<option value="0" disabled selected>Processing...</option>');

                $.ajax({
                    type: 'GET',
                    url: "GetSubPlaylist/" + orientation,
                    success: function(response) {
                        var response = JSON.parse(response);
                        console.log(response);

                        $('#playlist').empty();
                        $('#playlist').append('<option value="" selected>Select Sub Category*</option>');
                        response.forEach(element => {
                            $('#playlist').append(`<option value="${element['pl_name']}" >${element['pl_name']}</option>`)
                        });
                    }
                });
            });


            $('#playlist').on('change',function() {
                let orientation = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: "GetTvScreenID/" + orientation,
                    success: function(response) {
                        var response = JSON.parse(response);
                        //console.log(response);

                        $('#url_show').empty();

                        var tv_playlist = [];
                        response.forEach(element => {
                            //$('#url_show').append(`<a href="{{url('play/')}}/${element['id']}">{{url('play/')}}/${element['id']}</a>`)
                        });
                        

                        $.ajax({ 
                            url: "../GetVideoList/"+response[0].id,
                            type: 'GET',
                            dataType: 'json',
                            success: function(response)
                            {
                                var playlist_name = response.playlist_name;
                                var vid_show = $('#vid_show');
                                vid_show.empty();

                                /* playlist_name.forEach(function(user) {
                                    vid_show.append('<spanp>' + user.location + '</span>');
                                }); */

                                var loopAssets = [];
                                playlist_name.forEach(function(user) 
                                {
                                    console.log(user.type);
                                    //vid_show.append('<span>' + user.location + '</span>');
                                
                                    loopAssets.push({
                                        contentUrl: "{{ Storage::url('/') }}/"+user.location,
                                        contentType: user.contentType,
                                        type: user.type
                                    });
                                    
                                });


                                ///////////////////////////////////////////////////////
                                /* var loopAssets = [
                                { contentUrl: "{{ asset('assets/vid_land1.mp4') }}", contentType: "video/mp4", type:"VIDEO" },
                                { contentUrl: "{{ asset('assets/image1.jpg') }}", contentType: "image/jpg", type: "IMAGE"}
                                ]; */

                                var previewContainer = $(".previews-container");
                                var curIndex = 1;

                                appendMediaElement(loopAssets[0]);

                                function changeMedia() {

                                    if(curIndex >= loopAssets.length) {
                                        // modified this so it would display the first image/video when looping
                                        curIndex = 0;
                                    }

                                    appendMediaElement(loopAssets[curIndex]);

                                    curIndex++;
                                };
                                document.getElementById('lp-preview-video').play();

                                function appendMediaElement(asset) {
                                    var mediaEl = "";
                                    if(asset.type == "image") {
                                        mediaEl =  '<img  id="lp-preview-image" src="' + asset.contentUrl + '">';
                                        previewContainer.html(mediaEl);
                                        // image: go to the next media after 5 seconds
                                        var startInterval = 5000;
                                        setTimeout(changeMedia, startInterval);
                                    } else if(asset.type == "video") {
                                        mediaEl = "<video id='lp-preview-video' autoplay='autoplay' controlsList='nodownload' muted>";
                                        mediaEl += "<source src='"+ asset.contentUrl + "' type='" + asset.contentType + "'>";
                                        mediaEl += "</video>";
                                        previewContainer.html(mediaEl);
                                        // video: go to the next media when the video ends
                                        document.getElementById("lp-preview-video").addEventListener("ended", function(e) {
                                        changeMedia();
                                        });
                                    }
                                }
                                ///////////////////////////////////////////////////////
                                
                            }
                        });

                    }
                });
            });
        });

        $(document).ready(function(){
            
            
        });

    </script>
@endpush

<style>
   .video-container {
  position: absolute;
  top: 0;
  bottom: 0;
  width: 100%;
  height: 90%; 
  overflow: hidden;
}
.video-container video {
  /* Make video to at least 100% wide and tall */
  min-width: 100%; 
  min-height: 90%; 

  /* Setting width & height to auto prevents the browser from stretching or squishing the video */
  width: auto;
  height: auto;

  /* Center the video */
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
}
</style>
