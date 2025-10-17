<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\UtmLink;
use Illuminate\Http\Response;

class UtmController extends Controller
{
    public function utmCreator() {
        return view('pages.utm');
    }

    public function customUtmStore(Request $request) {
        // İlave servisleri ad.doubleclick.net'ten sonra virgulle ekleyebilirsin
        // Örn.:
        // starts_with:https://ad.doubleclick.net,https://datasins.com,https://www.ugurakcil.com
        // Emrah veya Uğur'un talebi olmadıkça domain kısıtlamasını asla kaldırmayın!
        // *******************************************************************************************
        $request->validate([
            'campaignAddress' => 'required|starts_with:https://ad.doubleclick.net',
            'shortLink' => 'required|min:3|string',
        ]);

        // Check if the short link already exists
        $existingLink = UtmLink::where('short_link', $request->input('shortLink'))->first();

        if ($existingLink) {
            return response()->json([
                'status' => 'error',
                'errorCode' => 'SHORTLINK',
                'message' => 'Bu kısa link zaten kullanılıyor.'
            ], Response::HTTP_CONFLICT);  // HTTP 409 Conflict
        }

        // If it doesn't exist, create a new record
        $utmLink = UtmLink::create([
            'campaign_address' => $request->input('campaignAddress'),
            'short_link' => $request->input('shortLink'),
        ]);

        return response()->json([
            'status' => 'success',
            'shortLink' => $utmLink->short_link
        ], Response::HTTP_CREATED);
    }

    public function utmStore(Request $request) {
        // Validate the request
        $request->validate([
            'websiteAddress' => 'required|url',
            'campaignSource' => 'required|min:2',
            'campaignMedium' => 'required|min:2',
            'campaignAddress' => 'required|url',
            'shortLink' => 'required|min:3|string',
        ]);

        // Check if the short link already exists
        $existingLink = UtmLink::where('short_link', $request->input('shortLink'))->first();

        if ($existingLink) {
            return response()->json([
                'status' => 'error',
                'errorCode' => 'SHORTLINK',
                'message' => 'Bu kısa link zaten kullanılıyor.'
            ], Response::HTTP_CONFLICT);  // HTTP 409 Conflict
        }

        // If it doesn't exist, create a new record
        $utmLink = UtmLink::create([
            'website_address' => $request->input('websiteAddress'),
            'campaign_id' => $request->input('campaignId'),
            'campaign_source' => $request->input('campaignSource'),
            'campaign_medium' => $request->input('campaignMedium'),
            'campaign_term' => $request->input('campaignTerm'),
            'campaign_content' => $request->input('campaignContent'),
            'campaign_address' => $request->input('campaignAddress'),
            'short_link' => $request->input('shortLink'),
        ]);

        return response()->json([
            'status' => 'success',
            'shortLink' => $utmLink->short_link
        ], Response::HTTP_CREATED);
    }

}
