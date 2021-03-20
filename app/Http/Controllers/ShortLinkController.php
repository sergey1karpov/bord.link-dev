<?php

namespace App\Http\Controllers;

use App\Link;
use App\Services\ShortLinkService;
use Illuminate\Http\Request;

class ShortLinkController extends Controller {
    /**
     * Short link service
     */
    public function index() {
        return view('short_link.index');
    }

    /**
     * Generate short link
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function generateShortLink(Request $request) {
        $shortLink = ShortLinkService::generate($request->old_link);
        return response()->json('bord.link/cc/'. $shortLink);
    }

    /**
     * Show shortlink content
     * @param $link
     * @return \Illuminate\Http\RedirectResponse
     */
    public function shortLink($link) {
        $findUrl = Link::where('short_link', $link)->first();
        if($findUrl) {
            $old_link = $findUrl->old_link;
        } else {
            return abort(404);
        }
        return redirect()->to($old_link);
    }
}
