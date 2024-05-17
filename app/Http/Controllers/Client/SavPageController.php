<?php

namespace App\Http\Controllers\Client;

use App\Models\Sav;
use App\Models\Lead;
use App\Models\SavGravada;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class SavPageController extends Controller
{
    public function index(){

        $sav = Sav::active()->first();
        $savGravadas = SavGravada::sorting()->active()->paginate(6);
        return view('Client.pages.savs', [
            'sav' => $sav,
            'savGravadas' => $savGravadas,
        ]);
    }

    public function leadSave(Request $request){
        $name = $request->name;
        $link = $request->link;
        $email = $request->email;
        $video_title = $request->video_title;
        $video_id = $request->video_id;

        // dd($video_title, $video_id);
        $lead = Lead::create([
            'name' => $name,
            'email' => $email,
            'video_title' => $video_title,
            'video_id' => $video_id
        ]);

        if ($lead) {
            // URL externa para onde você deseja redirecionar o usuário
            $externalUrl = $link;
    
            // Redirecionar o usuário para a URL externa
            return new RedirectResponse($externalUrl);
        } else {
            // Em caso de erro ao salvar o lead, redirecione para uma rota específica, por exemplo
            return redirect()->route('erro');
        }
    }
}
