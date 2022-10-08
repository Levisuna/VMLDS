<?php

namespace App\Http\Controllers\Website;


use App\Codes\Models\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $data;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;

        $getPage = Page::pluck('value', 'key')->toArray();

        $listPage = [];
        foreach($getPage as $key => $value) {
            $listPage[$key] = json_decode($value, true);
        }


        $this->data = [
            'page' => $listPage
        ];
    }

    public function index()
    {
        $data = $this->data;

        return view(env('WEBSITE_TEMPLATE').'.page.home', $data);
    }

}
