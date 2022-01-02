 <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Foodbook') }}</title>

    <link rel="manifest" href="/manifest.json">

    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#fffaf0">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" _defer></script>
    <!-- <script src="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/owl.carousel.js"></script> -->
    <script src="js/index.js"></script>
    <script src="/js/owl.carousel2/dist/owl.carousel.min.js"></script>

    <!-- Styles -->
    <!-- <link rel="stylesheet" href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.carousel.min.css"> -->
    <link rel="stylesheet" href="/js/owl.carousel2/dist/assets/owl.carousel.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @if (app()->environment('production'))
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-134069694-1"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());
	
	gtag('config', 'UA-134069694-1');
	</script>
    @endif

</head>
<body class="notranslate" style="background-color: #fffcf6;">

    <div id="app">

        <div class="container">
            @include('layouts.nav.main')
        </div>

        <div class="container-fluid p-0">
            @include('layouts.nav.secondary')
        </div>
            
        @yield('content')

    </div>

<script>
    var date = new Date({{$GLOBALS['year']}}, {{$GLOBALS['month']-1}}, {{$GLOBALS['day']}});


    // $.get( 'https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$long&key=AIzaSyDljGiAcet5cIxtAi2LeGSS6bgveARBiVY', function( data ) {
    //     console.info( data );
    //     console.info( data.results[8].address_components[0].long_name );
    // });

    @if (app()->environment('production'))
        @guest
            <?php
            Cookie::queue( Cookie::make( 'lat', '', -(time() + (86400 * 30)), '/' ) );
            Cookie::queue( Cookie::make( 'long', '', -(time() + (86400 * 30)), '/' ) );
            $GLOBALS['set_to_auto'] = false;
            ?>
        @else
            @if( null === \Illuminate\Support\Facades\Cookie::get('location') )
            if ("geolocation" in navigator) {
                /* geolocation is available */
                navigator.geolocation.getCurrentPosition(function(position) {
                    redirectToPosition(position);
                }, errorCallback);

                function redirectToPosition(position) {
                    var latitude  = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    window.location='?lat='+latitude+'&long='+longitude;
                }

                function errorCallback(error) {
                    alert('ERROR(' + error.code + '): ' + error.message);
                };
            } else {
                /* geolocation IS NOT available */
                alert('geolocation IS NOT available')
            }
            @endif
        @endif
    @endif
</script>

@if( Request::is('/') || Request::is('breakfast') || Request::is('lunch') || Request::is('dinner') )
<script>
    <?php foreach( ['breakfast', 'lunch', 'dinner'] as $meal_slug ): ?>
    <?php foreach( $GLOBALS['categories'] as $group => $val ):
        $group = str_replace('-', '_', $group);
        //dd($group); ?>
        var owl_{{$meal_slug}}{{$group}} = $('.owl-carousel_{{$meal_slug}}{{$group}}');
        owl_{{$meal_slug}}{{$group}}.owlCarousel({
            loop: false,
            lazyLoad: true,
            lazyLoadEager: 1,
            items: 1,
            dots: true
        })

        if( owl_{{$meal_slug}}{{$group}}.length == 0 ) {
            $('.customNextBtn_{{$group}}').remove();
        }

        $('.customNextBtn_{{$meal_slug}}{{$group}}').click(function() {
            owl_{{$meal_slug}}{{$group}}.trigger('next.owl.carousel');
        })
    <?php endforeach; ?>
    <?php endforeach; ?>
    
    setTimeout(() => {
        $('#info').modal('hide')
    }, 1350);
</script>
@endif

<?php
$botRegexPattern = "(googlebot\/|Googlebot-Mobile|Googlebot-Image|Google favicon|Mediapartners-Google|bingbot|slurp|java|wget|curl|Commons-HttpClient|Python-urllib|libwww|httpunit|nutch|phpcrawl|msnbot|jyxobot|FAST-WebCrawler|FAST Enterprise Crawler|biglotron|teoma|convera|seekbot|gigablast|exabot|ngbot|ia_archiver|GingerCrawler|webmon |httrack|webcrawler|grub.org|UsineNouvelleCrawler|antibot|netresearchserver|speedy|fluffy|bibnum.bnf|findlink|msrbot|panscient|yacybot|AISearchBot|IOI|ips-agent|tagoobot|MJ12bot|dotbot|woriobot|yanga|buzzbot|mlbot|yandexbot|purebot|Linguee Bot|Voyager|CyberPatrol|voilabot|baiduspider|citeseerxbot|spbot|twengabot|postrank|turnitinbot|scribdbot|page2rss|sitebot|linkdex|Adidxbot|blekkobot|ezooms|dotbot|Mail.RU_Bot|discobot|heritrix|findthatfile|europarchive.org|NerdByNature.Bot|sistrix crawler|ahrefsbot|Aboundex|domaincrawler|wbsearchbot|summify|ccbot|edisterbot|seznambot|ec2linkfinder|gslfbot|aihitbot|intelium_bot|facebookexternalhit|yeti|RetrevoPageAnalyzer|lb-spider|sogou|lssbot|careerbot|wotbox|wocbot|ichiro|DuckDuckBot|lssrocketcrawler|drupact|webcompanycrawler|acoonbot|openindexspider|gnam gnam spider|web-archive-net.com.bot|backlinkcrawler|coccoc|integromedb|content crawler spider|toplistbot|seokicks-robot|it2media-domain-crawler|ip-web-crawler.com|siteexplorer.info|elisabot|proximic|changedetection|blexbot|arabot|WeSEE:Search|niki-bot|CrystalSemanticsBot|rogerbot|360Spider|psbot|InterfaxScanBot|Lipperhey SEO Service|CC Metadata Scaper|g00g1e.net|GrapeshotCrawler|urlappendbot|brainobot|fr-crawler|binlar|SimpleCrawler|Livelapbot|Twitterbot|cXensebot|smtbot|bnf.fr_bot|A6-Indexer|ADmantX|Facebot|Twitterbot|OrangeBot|memorybot|AdvBot|MegaIndex|SemanticScholarBot|ltx71|nerdybot|xovibot|BUbiNG|Qwantify|archive.org_bot|Applebot|TweetmemeBot|crawler4j|findxbot|SemrushBot|yoozBot|lipperhey|y!j-asr|Domain Re-Animator Bot|AddThis|YisouSpider|BLEXBot|YandexBot|SurdotlyBot|AwarioRssBot|FeedlyBot|Barkrowler|Gluten Free Crawler|Cliqzbot)";
function is_bot($user_agent) {
    $botRegexPattern = "(googlebot\/|Googlebot\-Mobile|Googlebot\-Image|Google favicon|Mediapartners\-Google|bingbot|slurp|java|wget|curl|Commons\-HttpClient|Python\-urllib|libwww|httpunit|nutch|phpcrawl|msnbot|jyxobot|FAST\-WebCrawler|FAST Enterprise Crawler|biglotron|teoma|convera|seekbot|gigablast|exabot|ngbot|ia_archiver|GingerCrawler|webmon |httrack|webcrawler|grub\.org|UsineNouvelleCrawler|antibot|netresearchserver|speedy|fluffy|bibnum\.bnf|findlink|msrbot|panscient|yacybot|AISearchBot|IOI|ips\-agent|tagoobot|MJ12bot|dotbot|woriobot|yanga|buzzbot|mlbot|yandexbot|purebot|Linguee Bot|Voyager|CyberPatrol|voilabot|baiduspider|citeseerxbot|spbot|twengabot|postrank|turnitinbot|scribdbot|page2rss|sitebot|linkdex|Adidxbot|blekkobot|ezooms|dotbot|Mail\.RU_Bot|discobot|heritrix|findthatfile|europarchive\.org|NerdByNature\.Bot|sistrix crawler|ahrefsbot|Aboundex|domaincrawler|wbsearchbot|summify|ccbot|edisterbot|seznambot|ec2linkfinder|gslfbot|aihitbot|intelium_bot|facebookexternalhit|yeti|RetrevoPageAnalyzer|lb\-spider|sogou|lssbot|careerbot|wotbox|wocbot|ichiro|DuckDuckBot|lssrocketcrawler|drupact|webcompanycrawler|acoonbot|openindexspider|gnam gnam spider|web\-archive\-net\.com\.bot|backlinkcrawler|coccoc|integromedb|content crawler spider|toplistbot|seokicks\-robot|it2media\-domain\-crawler|ip\-web\-crawler\.com|siteexplorer\.info|elisabot|proximic|changedetection|blexbot|arabot|WeSEE:Search|niki\-bot|CrystalSemanticsBot|rogerbot|360Spider|psbot|InterfaxScanBot|Lipperhey SEO Service|CC Metadata Scaper|g00g1e\.net|GrapeshotCrawler|urlappendbot|brainobot|fr\-crawler|binlar|SimpleCrawler|Livelapbot|Twitterbot|cXensebot|smtbot|bnf\.fr_bot|A6\-Indexer|ADmantX|Facebot|Twitterbot|OrangeBot|memorybot|AdvBot|MegaIndex|SemanticScholarBot|ltx71|nerdybot|xovibot|BUbiNG|Qwantify|archive\.org_bot|Applebot|TweetmemeBot|crawler4j|findxbot|SemrushBot|yoozBot|lipperhey|y!j\-asr|Domain Re\-Animator Bot|AddThis|YisouSpider|BLEXBot|YandexBot|SurdotlyBot|AwarioRssBot|FeedlyBot|Barkrowler|Gluten Free Crawler|Cliqzbot)";
    return preg_match("/{$botRegexPattern}/", $user_agent);
}

if ( !is_bot($_SERVER['HTTP_USER_AGENT']) ) {
    // ....code for the call to geoplugin.net
    ?>
    <?php
}
?>
</body>
</html>