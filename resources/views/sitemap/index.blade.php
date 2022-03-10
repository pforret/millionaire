<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ date("c",strtotime("1 hour ago")) }}</lastmod>
        <changefreq>hourly</changefreq>
        <priority>0.9</priority>
    </url>
    @foreach ($pages as $page)
        <url>
            <loc>{{ url('/') }}/in/{{ $page->code }}</loc>
            <lastmod>{{ date("c",strtotime($page->date)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>
