@extends('layouts.master')

@section('content')
</div>
<style>
.thumbnail { width: 25%;}
</style>
<div class="container">

    <div class="row">

    <h1 class="tk-seravek-web">Photos</h1>
    <p>View more photos at <a href="https://compasshb.smugmug.com/PhotoArchive">http://photos.compasshb.com/</a></p>


      <div id="js-masonry">
        @foreach ($photos as $photo)
          <div class="thumbnail">
            <a href="{{ $photo[0] }}">
              <img src="{{ $photo[1] }}" alt="compasshb.com/photos">
            </a>
          </div>
        @endforeach
      </div>
    </div>

    <p>View more photos at <a href="http://photos.compasshb.com/">http://photos.compasshb.com/</a></p>
</div>

<script src="http://imagesloaded.desandro.com/imagesloaded.pkgd.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.0/masonry.pkgd.min.js"></script>
<script>
var container = document.querySelector('#js-masonry');
var msnry;
// initialize Masonry after all images have loaded
imagesLoaded( container, function() {
  msnry = new Masonry( container, {
    "itemSelector": ".thumbnail"
  } );
});
</script>

@stop
