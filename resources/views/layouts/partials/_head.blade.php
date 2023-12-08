<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta http-equiv="X-UA-Compatible" content="ie=edge">

<title>{{ env('APP_NAME') }}</title>

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="{{ asset('assets/css/bootstrap@5-2-3.min.css') }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
  integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
  href="{{ asset('assets/css/font.css') }}"
  rel="stylesheet">

<link rel="stylesheet" href="{{ asset('assets/vendor/owlcarousel-2-3-4/assets/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/owlcarousel-2-3-4/assets/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}" />