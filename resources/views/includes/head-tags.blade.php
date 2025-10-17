{{--
    Temel bazı css'ler eklenmiştir. Muhtemelen değiştirmeniz gerekmez.
    Yeni css'leri aynı yöntemle aynı pathlere ekleyebilirsiniz.

    Ayrıca `includes` dizinine her sayfada olmayacak alanları eklemeyin.
    Bazı sayfalarda bulunabilecek alanları `sections` klasörüne ekleyin.
--}}

{{-- Constants for custom scripts --}}

<script>
    var BASE_URL        = '{{url("")}}';
    var CURRENT_LANG    = '{{app()->getLocale()}}';
</script>

<!-- Google font-->
<link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
<!-- Font Awesome-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/fontawesome.css')}}">
<!-- ico-font-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/icofont.css')}}">
<!-- Themify icon-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/themify.css')}}">
<!-- Flag icon-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/flag-icon.css')}}">
<!-- Feather icon-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/feather-icon.css')}}">
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/slick.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/slick-theme.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/scrollbar.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/flatpickr/flatpickr.min.css')}}">
<!-- Plugins css Ends-->
<!-- Bootstrap css-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/bootstrap.css')}}">
<!-- App css-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
<link id="color" rel="stylesheet" href="{{asset('assets/css/color-1.css')}}" media="screen">
<!-- Responsive css-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}">


<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/jquery.dataTables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select.bootstrap5.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/vector-map1/jsvectormap.min.css')}}">
<!-- Plugins css Ends-->
