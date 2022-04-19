<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Lead;
use App\Mail\NewContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request) {
        $data = $request->all();

        // validiamo i dati "a mano" per poter gestire la risposta
        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        // salviamo a db i dati inseriti nel form di contatto
        $lead = new Lead();
        $lead->fill($data);
        $lead->save();

        // inviamo la mail all'admin del sito, passando il nuovo oggetto Lead
        Mail::to('info@boolpress.com')->send(new NewContact($lead));

        return response()->json([
            'success' => true,
        ]);
    }
}
