@extends('layouts.homepage')
@push('style')
    <style>
        .thumbnails {
            display: flex;
            margin: 1rem auto 0;
            padding: 0;
            justify-content: center;
        }

        .thumbnail {
            width: 70px;
            height: 70px;
            overflow: hidden;
            list-style: none;
            margin: 0 0.2rem;
            cursor: pointer;
        }

        .thumbnail img {
            width: 100%;
            height: auto;
        }
        .thumbnail {
            opacity: 0.3;
        }

        .thumbnail.is-active {
            opacity: 1;
        }
    </style>
@endpush
@section('content')

<section id="main-carousel" class="splide" aria-label="My Awesome Gallery">
    <div class="splide__track">
      <ul class="splide__list">
        @foreach ($gambarkos as $item)
        <li class="splide__slide">
            <img src="{{ asset('storage/' . $item->image) }}" alt="">
          </li>
        @endforeach
      </ul>
    </div>
  </section>
  
  
  <ul id="thumbnails" class="thumbnails">
    @foreach ($gambarkos as $item)
    <li class="thumbnail">
        <img src="{{ asset('storage/' . $item->image) }}" alt="">
      </li>
    @endforeach
  </ul>


@endsection

@push('script')
<script>
    var splide = new Splide( '#main-carousel', {
    pagination: false,
    } );


    var thumbnails = document.getElementsByClassName( 'thumbnail' );
    var current;


    for ( var i = 0; i < thumbnails.length; i++ ) {
    initThumbnail( thumbnails[ i ], i );
    }


    function initThumbnail( thumbnail, index ) {
    thumbnail.addEventListener( 'click', function () {
        splide.go( index );
    } );
    }


    splide.on( 'mounted move', function () {
    var thumbnail = thumbnails[ splide.index ];


    if ( thumbnail ) {
        if ( current ) {
        current.classList.remove( 'is-active' );
        }


        thumbnail.classList.add( 'is-active' );
        current = thumbnail;
    }
    } );


    splide.mount();
</script>

@endpush
