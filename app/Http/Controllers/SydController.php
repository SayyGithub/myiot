<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SydController extends Controller
{
    
    public function index()
    {
        return view('syd'); 
    }

   
    public function store(Request $request)
    {
        return "minarsi";
    }

 
    public function showSapii($sapii)
    {
        return "<p style='font-size: 300px; font-weight: bold;'>Halo Aku Sapi'i</p>";
    }

    public function showSapiiPi($sapii, $pi)
    {
        return "<p style='font-size: 300px; font-weight: bold;'>Asli cirebon</p>";
    }

   
    public function syd2(Request $request)
    {
        return 'Selamat datang Sapii ' . $request->page . ' dan ' . $request->page2;
    }


    public function article(Request $request)
    {
        $article = [
            "title" => $request->articlel,
            "content" => $request->description,
        ];

        return $article;
    }
}
