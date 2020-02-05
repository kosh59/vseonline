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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request)
    {
        $this->authorize('isPageOwn', $request->user()->page()->first());

        $validator = \Validator::make($request->all(), [
            'name' => 'required|max:44',
            'url' => 'required|max:44',
//            'logo' => 'image',
        ]);

        $request->user()->page()->update([
            'name' => $request->name,
            'logo' => $request->logo,
            'bgcolor' => $request->bgcolor,
            'url' => $request->url,
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        else {
            return response()->json(['success'=>'ok']);
        }
    }

    /**
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Page $page)
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
