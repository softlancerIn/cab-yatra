@php
    $url = url()->full();
    $data['meta_tags'] = DB::table('seo')->where('page_url', $url)->first();
@endphp
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <meta name="yandex-verification" content="7ff5c6cfa7411063" />
    <meta name="msvalidate.01" content="862F59DE388F2B8C1FFFB6B52CAD77F5" />
    <meta name="google-site-verification" content="gIKDG6fIF4mMMjZgIHVQ6cJe_lRvVsAi8AmrFWKA6AQ" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-5VP1EKFDH5"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-5VP1EKFDH5');
    </script>
    <script type="application/ld+json">
        {
        "@context": "https://schema.org/",
        "@type": "WebSite",
        "name": "Cab Yatra",
        "url": "https://cabyatra.com/",
        "potentialAction": {
            "@type": "SearchAction",
            "target": "{search_term_string}",
            "query-input": "required name=search_term_string"
        }
        }
    </script>
    <script type="application/ld+json">
        {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Cab Yatra",
        "url": "https://cabyatra.com/",
        "logo": "https://cabyatra.com/public/admin/assets/images/admin_logo.jpeg",
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+91-9911995523",
            "contactType": "customer service",
            "areaServed": "IN",
            "availableLanguage": ["Hindi","en"]
        },
        "sameAs": [
            "https://www.facebook.com/cabyatraindia",
            "https://www.instagram.com/cabyatra/"
        ]
        }
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- slick slider -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"
        integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"
        integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cabyatra.com/public/web/assets/css/style.css">
    <link rel="stylesheet" href="https://cabyatra.com/public/web/assets/css/responsive.css">


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'AW-16844763758');
    </script>

    <!-- Event snippet for Purchase conversion page In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. -->
    <script>
        function gtag_report_conversion(url) {
            var callback = function () {
                if (typeof (url) != 'undefined') {
                    window.location = url;
                }
            };
            gtag('event', 'conversion', {
                'send_to': 'AW-16844763758/Y27dCPiLg5caEO7kmuA-',
                'value': 1.0,
                'currency': 'INR',
                'transaction_id': '',
                'event_callback': callback
            });
            return false;
        }
    </script>

    <!-- Event snippet for Purchase conversion page -->
    <script>
        gtag('event', 'conversion', {
            'send_to': 'AW-16844763758/Y27dCPiLg5caEO7kmuA-',
            'value': 1.0,
            'currency': 'INR',
            'transaction_id': ''
        });
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-15H4C3G6RJ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-15H4C3G6RJ');
    </script>


    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large" />
    <link rel="canonical" href="{{$url}}" />
    <title>{{$data['meta_tags']->title ?? 'Cab Yatra'}}</title>
    <meta name="description" content="{{$data['meta_tags']->description ?? 'Cab Yatra'}}">
    <meta name="keyword" content="{{$data['meta_tags']->keyword ?? 'Cab Yatra'}}">
    <link href="https://cabyatra.com/public/admin/assets/images/admin_logo.jpeg" rel="icon">

    <!----------- OG TAG ------------------->
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="Website" />
    <meta property="og:title" content="{{$data['meta_tags']->title ?? 'Cab Yatra'}}" />
    <meta property="og:description" content="{{$data['meta_tags']->description ?? 'Cab Yatra'}}" />
    <meta property="og:site_name" content="Cab Yatra" />
    <meta property="og:url" content="{{$url}}" />
    <meta property="og:image" content="" />
    <meta property="og:image:width" content="400" />
    <meta property="og:image:height" content="400" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{$data['meta_tags']->title ?? 'Cab Yatra'}}" />
    <meta name="twitter:description" content="{{$data['meta_tags']->description ?? 'Cab Yatra'}}" />
    <meta name="twitter:image" content="" />
    <link rel="alternate" hreflang="en-US" href="{{$url}}" />
    <link rel="alternate" href="{{$url}}" hreflang="x-default" />

    {!! $data['meta_tags']->script ?? '' !!}


</head>



<!-- Header Start-->
@include('web.layout.header')
<!-- Header End -->

<!-- Modals  -->

<!---------------------------- Dynamic component add here ------------------>
@yield('content')
<!---------------------------- Dynamic component add here ------------------>


<!-- Include the scripts stack -->
@stack('scripts')
<!-- Include the scripts stack -->


<!-- ========= Footer Section ============== -->
@include('web.layout.footer')
<!-- ============================= Important cdn and links =================== -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<!--      slick slider js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
    integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-16844763758">
</script>
<script src="https://cabyatra.com/public/web/assets/js/main.js"></script>
</body>

</html>