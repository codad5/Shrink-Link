<?php

namespace App\Http\Controllers;
use App\Models\links;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;

class LinkController extends Controller
{
    //
    public function index(){
        return view('index');
    }
    public function add(Request $request){
        // $_REQUEST
        // echo $request->request['url'];
        // dd($_SERVER['HTTP_ORIGIN']);
        // exit;
        $id = (string) uniqid();
        $link = new links();
        $link->url = $request->input('url');
        $link->link_id =  $id;
        // $link->link_id = dd($uuid->time);
        $link->no_of_click = 0;
        $link->save();
        $shortLink = "{$_SERVER['HTTP_ORIGIN']}/go/{$id}";
        return view('welcome', ['url' => $shortLink]);
    }
    public function go($id){
        // $link = new Links();
        $c_link = Links::where('link_id', $id)->first();
        // dd($c_link);
        // return view('welcome', ['link' => $c_link]);
        return redirect($c_link->url ?? '/?err=notfound');

    }
}
