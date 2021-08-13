<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;

class HomeController extends Controller
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
    public function index(Request $request)
    {
        $data = $request->only(['filter']);
        $daysFilter = [10, 20, 30, 40, 60];

        if (isset($data['filter']) && in_array($data['filter'], $daysFilter)) {
            $filter = $data['filter'];
        } else {
            $filter = $daysFilter[0];
        }

        $dataFilter = date('Y-m-d', strtotime("-" . $filter . " days"));
        $onlineCount = Visitor::select('ip')->where('date_access', '>=', date('Y-m-d H:i:s', strtotime('-5 minutes')))->groupBy('ip')->count();
        $visitsAll = Visitor::selectRaw('page, count(page) as c')->where('date_access', '>=', $dataFilter)->groupBy('page')->get();
        
        $pagePie = [];
        foreach ($visitsAll as $visit) {
            $visit['page'] = 'index';
            $visit['c'] = 3;
            $pagePie[$visit['page']] = intval($visit['c']);
        }

        $pageLabels = json_encode(array_keys($pagePie));
        $pageValues = json_encode(array_values($pagePie));

        return view('admin.home', [
            'daysfilter' => $daysFilter,
            'visitsCount' => Visitor::where('date_access', '>=', $dataFilter)->count(),
            'onlineCount' => $onlineCount,
            'pageCount' => Page::count(),
            'userCount' => User::count(),
            'pageLabels' => $pageLabels,
            'pageValues' => $pageValues,
            'filter' => $filter
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
