<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Image;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\IdentificationType;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{

    public function formImage(Client $client){
        return view('livewire.clients.form', compact('client'));
    }

    public function storeImage(Request $request)
    {     
        foreach($request->file('file') as $key => $img) {
            $imgUrl = $img->store('public/clients');
            $imgUrl = Storage::url($imgUrl);
            $imgSave =  new Image();
            $imgSave->url = $imgUrl;
            $imgSave->imageable_id = $request->clientId;
            $imgSave->imageable_type = "App\Models\Client";
            $imgSave->save();
        }
        return response()->json([ 'message' => "Imagenes subidas con exito"]);	
    } //storeImage

    public function show($id)
    {
        $client = Client::where('id',$id)->first();
        $cities = City::all();
        $ptypes = IdentificationType::all();
        //dd($client);
        return view('livewire.clients.show', compact('client', 'cities', 'ptypes'));
    }

  
} //class
