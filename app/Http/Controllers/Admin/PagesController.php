<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::paginate(10);
        return view('admin.pages.index', ['pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['title', 'body']);
        $data['slug'] = Str::slug($data['title'], '-');

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'min:3', 'max:100'],
            'body' => ['string'],
            'slug' => ['required', 'string', 'min:3', 'max:100', 'unique:pages']
        ]);

        if ($validator->fails()) {
            return redirect()->route('pages.create')->withErrors($validator)->withInput();
        }

        $page = new Page();
        $page->title = $data['title'];
        $page->slug = $data['slug'];
        $page->body = $data['body'];
        if ($page->save()) {
            Session::flash('success', "Página criada!");
            return redirect()->route('pages.index');
        } else {
            Session::flash('error', "Não foi possível criar a página!");
            return redirect()->route('pages.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::find($id);
        if ($page) {
            return view('admin.pages.edit', ['page' => $page]);
        }

        Session::flash('warning', 'Nenhuma página encontrada com esse identificador!');
        return redirect()->route('pages.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $page = Page::find($id);

        if (!$page) {
            Session::flash('warning', "Não foi encontrar a página!");
            return redirect()->route('pages.create');
        }

        $data = $request->only(['title', 'body']);

        if ($page['title'] !== $data['title']) {
            $data['slug'] = Str::slug($data['title'], '-');
            $page->slug = $data['slug'];
        }

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'min:3', 'max:100'],
            'body' => ['string'],
            'slug' => ['string', 'min:3', 'max:100', 'unique:pages,slug,' . $id]
        ]);

        if ($validator->fails()) {
            return redirect()->route('pages.edit', ['page' => $id])->withErrors($validator)->withInput();
        }

        $page->title = $data['title'];
        $page->body = $data['body'];

        if ($page->save()) {
            Session::flash('success', "Página criada!");
            return redirect()->route('pages.index');
        } else {
            Session::flash('error', "Não foi possível criar a página!");
            return redirect()->route('pages.create');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);
        if($page){
            $page->delete();
            Session::flash('success', 'Página excluida!');
        }
        return redirect()->route('pages.index');
    }
}
