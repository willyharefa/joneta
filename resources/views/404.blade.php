<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/homepage.css') }}">
    <title>{{ $title }}</title>
  </head>
  <body>
    <div class="container-nothing">
        <div class="row g-0 p-4 justify-content-center text-center">
            <div class="col-12 col-md-6">
                <img src="{{ asset('/icon/under-construction.svg') }}" width="60%" alt="">
                <h1 class="display-1" style="font-weight:700; color:#2467cd">404</h1>
                <h1 class="display-5" style="font-weight: 400; color:#2467cd">Coming Soon</h1>
                <a class="btn" href="{{ route('home') }}" id="btn-back-404">Back Home</a>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>