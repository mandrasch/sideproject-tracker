<?php

namespace App\Http\Controllers;

use App\Models\PageView;
use App\Models\Website;
use Illuminate\Http\Request;

class TrackPageViewController extends Controller
{
    public function trackPageView(Request $request): \Illuminate\Http\JsonResponse
    {
        // The server (domain which called our endpoint, e.g. "example.com"
        $requestHost = $request->host();

        $trackingScriptKey = $request->input('trackingScriptKey');
        if(!$trackingScriptKey){
            return response()->json(['message' => 'Not tracked'],400);
        }

        // Check if we have the tracking script key in our websites list
        $trackingScriptKey = trim($trackingScriptKey);
        $website = Website::where('tracking_script_key','=',$trackingScriptKey )->first();
        if(!$website){
            return response()->json(['message' => 'Not tracked'],404);
        }

        // The other post params we receive from the tracking script
        // TODO: is sanitization already handled by laravel?
        // Get the referrer and target information from the request
        $referrer = $request->input('referrer'); //
        // strip path from referrer for privacy
        if($referrer !== null && $referrer !== ''){
            // Use parse_url to extract the host (domain) from the referrer URL
            $referrer = parse_url($referrer, PHP_URL_HOST);
            if($referrer===false){
                // throw bad request, we could not figure out the referrer base domain (edge case)
                return response()->json(['message' => 'Not tracked'], 400);
            }
        }
        $target = $request->input('target');

        // Log the page view with referrer and target information
        // You can use Laravel's logging system or save it to a database
        \Log::info("Page View - Referrer: $referrer, Target: $target, Received from: $requestHost");

        // Create a new PageView record, created_at handled by laravel
        $pageView = new PageView();
        $pageView->referrer = $referrer;
        $pageView->target = $target;
        $pageView->website_id = $website->id;

        // Save the record to the database
        $pageView->save();

        // Return a success response with HTTP 200
        return response()->json(['message' => 'Page view tracked successfully']);
    }
}
