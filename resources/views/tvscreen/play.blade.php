@extends('layouts.app')
@section('content')
    

            <div class="content">
               <?php
                    //echo $playlist_id;
                    
                    /*
                    SELECT location FROM tvscreens a 
                    JOIN playlists b ON (a.playlist_name = b.pl_name) 
                    JOIN medias c on (b.media_id = c.id) 
                    WHERE a.id = 13
                    */

                    $pl = DB::table('tvscreens')
                    ->join('playlists', 'tvscreens.playlist_name', '=', 'playlists.pl_name')
                    ->join('medias', 'playlists.media_id', '=', 'medias.id')
                    ->where('tvscreens.id', $playlist_id)
                    ->get();

                    foreach ($pl as $pls) 
                    {
                        //echo $pls->location."<br>";
                    }
               ?>

                {{-- <div id="vid_show"></div> --}}

                <div class="col-xs-8">
                <div id="loop-preview">
                    <div class="item previews-container video-container">
                    </div>
                </div>
                </div>

            </div>

@endsection

@push('scripts')
    <script>
        const queryString = window.location.href;
        const tv_playlist = queryString.toString().split("/")[4];

        ////////////////////////////////////
        $(document).ready(function(){
            
            $.ajax({ 
                url: "../GetVideoList/"+tv_playlist,
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
                            mediaEl =  '<img id="lp-preview-image" src="' + asset.contentUrl + '">';
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
        });
        
    </script>
@endpush

<style>
.video-container {
  position: absolute;
  top: 0;
  bottom: 0;
  width: 100%;
  height: 100%; 
  overflow: hidden;
}
.video-container video {
  /* Make video to at least 100% wide and tall */
  min-width: 100%; 
  min-height: 100%; 

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
