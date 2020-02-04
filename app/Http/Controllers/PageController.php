<?php

namespace App\Http\Controllers;
use App\Page;
use App\Repositories\LinkRepository;
use Illuminate\Http\Request;



class PageController extends Controller
{
    protected $links, $page;

    public function __construct(LinkRepository $links)
    {
        $this->links = $links;
    }

    /**
     *  Возвращает коллекцию ссылок для быстрой страницы пользователя
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $page = $request->user()->page()->firstOrCreate(['user_id' => $request->user()->id]);
        return view('page.index', [
            'links' => $this->links->forPage($page),
            'page' => $page,
        ]);
    }
    /**
     * Update users_page.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        $this->authorize('isPageOwn', $request->user()->page()->first());

        $this->validate($request, [
            'name' => 'required|max:255',
            'url' => 'required|max:255',
        ]);

        $request->user()->page()->update([
            'name' => $request->name,
            'logo' => $request->logo,
            'bgcolor' => $request->bgcolor,
            'url' => $request->url,
        ]);

        return redirect()->back();
    }

    public function show(Request $request, Page $page)
    {
        if ($page->status) {
            return view('page.show', [
                'links' => $this->links->forPage($page)->where('visible', true),
                'page' => $page,
            ]);
        }
        else {
            return view('page.needpaid');
        }
    }
}
