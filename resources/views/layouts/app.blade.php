<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('page_title') &bull; {{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@2BAmillionai_re">
        <meta name="twitter:creator" content="@2BAmillionai_re">
        <meta name="twitter:title" content="@yield('page_title')">
        <meta name="twitter:description" content="@yield('page_subtitle')">
        <meta name="twitter:image" content="@yield('page_img')">
        <meta name="twitter:image:alt" content="@yield('page_title')">
        <meta property="og:url"                content="@yield('page_url')" />
        <meta property="og:type"               content="article" />
        <meta property="og:title"              content="@yield('page_title')" />
        <meta property="og:description"        content="@yield('page_subtitle')" />
        <meta property="og:image"              content="@yield('page_img')" />
        <meta property="og:image:alt"          content="@yield('page_title')" />

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')
            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8" style="font-family: Nunito">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <footer>
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-xs text-center">
                    &copy; 2022
                    &bull; Website by <a href="https://blog.forret.com">Peter Forret</a>
                    &bull; Rates via <a href="https://www.ecb.europa.eu">European Central Bank</a>
                    &bull; <code>v @include("VERSION")</code>
                </div>
            </footer>
        </div>
        <!-- Matomo -->
        <script>
            var _paq = window._paq = window._paq || [];
            /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
            _paq.push(['trackPageView']);
            _paq.push(['enableLinkTracking']);
            (function() {
                var u="//matomo.forret.com/";
                _paq.push(['setTrackerUrl', u+'matomo.php']);
                _paq.push(['setSiteId', '8']);
                var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
                g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
            })();
        </script>
        <!-- End Matomo Code -->
    </body>
</html>
