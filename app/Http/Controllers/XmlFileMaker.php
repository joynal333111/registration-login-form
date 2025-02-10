<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class XmlFileMaker extends Controller
{

    public function xmlMaker()
    {
        $urls24 = [];
        $urlsAMPM = [];

        // Generate URLs for 24-hour format
        for ($hour = 0; $hour < 24; $hour++) {
            for ($minute = 0; $minute < 60; $minute++) {
                $urls24[] = "https://setalarmfor.com/{$hour}/{$minute}";
            }
        }

        // Generate URLs for 12-hour format (AM & PM)
        foreach (['am', 'pm'] as $period) {
            for ($hour = 1; $hour <= 12; $hour++) {
                for ($minute = 0; $minute < 60; $minute++) {
                    $urlsAMPM[] = "https://setalarmfor.com/{$period}/{$hour}/{$minute}";
                }
            }
        }

        // Function to generate XML content
        function generateXML($urls)
        {
            $sitemap = "<sitemapindex xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

            foreach ($urls as $url) {
                $sitemap .= "    <sitemap>\n";
                $sitemap .= "        <loc>" . htmlspecialchars($url) . "</loc>\n";
                $sitemap .= "    </sitemap>\n";
            }

            $sitemap .= "</sitemapindex>\n";

            return $sitemap;
        }

        // Generate and save AM/PM sitemap
        $sitemapAmPm = generateXML($urlsAMPM);
        Storage::disk('local')->put('sitemaps/sitemapAmPm.xml', $sitemapAmPm);

        // Generate and save 24-hour format sitemap
        $sitemap24 = generateXML($urls24);
        Storage::disk('local')->put('sitemaps/sitemapTwentyFour.xml', $sitemap24);

        return response()->json([
            'message' => 'Sitemap generated successfully!',
            'files' => [
                'sitemapAmPm' => storage_path('app/sitemaps/sitemapAmPm.xml'),
                'sitemapTwentyFour' => storage_path('app/sitemaps/sitemapTwentyFour.xml'),
            ],
        ]);
    }

}
