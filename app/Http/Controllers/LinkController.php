<?php

namespace App\Http\Controllers;
use App\Link;
use App\Page;
use App\Links_stat;
use Browser;
use Illuminate\Http\Request;
use App\Repositories\LinkRepository;

class LinkController extends Controller
{
    /**
     * The link repository instance.
     *
     * @var LinkRepository
     */
    protected $links;
    /**
     * Create a new controller instance.
     *
     * @param  LinkRepository  $links
     * @return void
     */
    public function __construct(LinkRepository $links)
    {

    }
    /**
     * Create a new link.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->middleware('auth');
        $this->authorize('isPageOwn', Page::find($request->page_id));

        $this->validate($request, [
            'name' => 'required|max:255',
            'value' => 'required|max:255',
        ]);

         switch ($request->type) {
             case 'vk': //;
             case 'fb': //;
             case 'wta': //;
             case 'lnk': $url = $request->value;
         }

        $request->user()->links()->create([
            'name' => $request->name,
            'value' => $request->value,
            'type' => $request->type,
            'color' => $request->color,
            'url' => $url,
            'page_id' => $request->page_id,
            'order_no' => 99,
        ]);

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param Link $link
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */

    public function update(Request $request, Link $link)
    {
        $this->middleware('auth');
        $this->authorize('DestroyOrUpdate', $link);

        $this->validate($request, [
            'name' => 'required|max:255',
            'value' => 'required|max:255',
        ]);

        switch ($request->type) {
            case 'vk': //;
            case 'fb': //;
            case 'wta': //;
            case 'lnk': $url = $request->value;
        }
        ($request->visible)? $visible = true : $visible =false;
        $link->update([
            'name' => $request->name,
            'value' => $request->value,
            'type' => $request->type,
            'color' => $request->color,
            'url' => $url,
            'order_no' => $request->order_no,
            'visible' => $visible,
        ]);

        return redirect()->back();
    }
    /**
     * Destroy the given link.
     *
     * @param  Request  $request
     * @param  Link  $link
     * @return Response
     */
    public function destroy(Request $request, Link $link)
    {
        $this->middleware('auth');
        $this->authorize('DestroyOrUpdate', $link);

        $link->delete();

        return redirect()->back();
    }

    /**
     * Redirect to link URL with saved statistics
     * @param Request $request
     * @param Link $link
     */
    public function redirect(Request $request, Link $link)
    {

        $url = 'http://ip-api.com/json/'.$request->ip().'?lang=ru&fields=status,country,city';
        $ip_result = json_decode(file_get_contents($url),true);
        if ($ip_result['status'] != 'fail') {
            $ip_city = $ip_result['city'];
            $ip_country = $ip_result['country'];
        }
        else {
            $ip_city= null; $ip_country = null;
        }

        $link->increment('clicks');

        if (Browser::isMobile()) {
            $device_platform = Browser::deviceFamily();
            $type = 'mobile';
        }
        elseif (Browser::isTablet()) {
            $device_platform = Browser::platformFamily();
            $type = 'tablet';
        }
        elseif (Browser::isDesktop()) {
            $device_platform = Browser::platformFamily();
            $type = 'desktop';
        }

        $browser_family = Browser::browserFamily();

        $link->stat()->create([
            'device_platform' => $device_platform,
            'browser_family' => $browser_family,
            'type' => $type,
            'city' => $ip_city,
            'country' => $ip_country,
            'ip' => $request->ip(),
        ]);

        return redirect($link->url,307);
    }
}
