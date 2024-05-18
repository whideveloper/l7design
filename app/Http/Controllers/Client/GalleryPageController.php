<?php

namespace App\Http\Controllers\Client;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryPageController extends Controller
{
    public function index(){
        $galleries = Gallery::with('galleryImage')->sorting()->active()->paginate(20);
   
        return view('Client.pages.galeria', [
            'galleries' => $galleries
        ]);
    }

    public function galeriaInterna($gallery)
    {
        $galleryImages = Gallery::with(['galleryImage' => function ($query) {
            $query->orderBy('sorting', 'ASC');
        }])
        ->where('slug', $gallery)
        ->active()
        ->first();
    

        return view('Client.pages.galeria-interna', [
            'galleryImages' => $galleryImages
        ]);
    }

}
