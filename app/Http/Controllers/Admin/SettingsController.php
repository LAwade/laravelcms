<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $configs = Setting::get();
        $settings = [];

        if(!$configs){
            Session::flash('warning', 'Nenhuma configuração de página encontrado!');
            return redirect()->route('settings.index');
        }

        foreach ($configs as $setgs) {
            $settings[$setgs['name']] = $setgs['content'];
        }

        return view('admin.settings.index', ['settings' => $settings]);
    }

    public function save(Request $request)
    {
        $data = $request->only([
            'name',
            'content',
            'email',
            'bgcolor',
            'textcolor'
        ]);

        $validator = Validator::make($data, [
            'title' => ['string', 'min:5', 'max:30'],
            'subtitle' => ['string', 'min:5', 'max:100'],
            'email' => ['string', 'email', 'min:10', 'max:100'],
            'bgcolor' => ['string', 'min:4', 'max:16', 'regex:/#[A-Z0-9]{6}/i'],
            'textcolor' => ['string', 'min:4', 'max:16', 'regex:/#[A-Z0-9]{6}/i']
        ]);

        if ($validator->fails()) {
            return redirect()->route('settings')->withErrors($validator);
        }

        foreach($data as $item => $value){
            Setting::where('name', $item)->update([
                'content' => $value
            ]);
        }

        Session::flash('info', 'As configurações foram editadas!');
        return redirect()->route('settings');
    }
}
