<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use Illuminate\Http\Request;

class SitemapXmlController extends Controller
{
    public function index() {
        $rates = Rate::last_rates();
        return response()->view('sitemap.index', [
            'pages' => $rates
        ])->header('Content-Type', 'text/xml');
    }
}
