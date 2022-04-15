<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\User;
use Carbon\Carbon;
use Doctrine\Inflector\Rules\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

        $user = Auth::user();
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $user = Auth::user();

        $request->validate(
            [
                'name' => 'required|min:2',
                'email' => 'required|email',
                'avatar' => 'nullable|image|max:2048',
                'new_password' => 'nullable|confirmed|min:8' //mostro la confirmed
            ]
        );

        $data = $request->all();

        //aggiorno l'avatar, stesso codice che per i post, tranne che specifico il disk sui cui lavorare
        if (isset($data['avatar'])) {

            if ($user->avatar) {
                Storage::disk('local')->delete($user->avatar);
            }

            $avatar_path = Storage::disk('local')->put('avatars', $data['avatar']);
            $data['avatar'] = $avatar_path;
        }

        //aggiorno la password se definita ed i controlli sono passati
        if ($data['new_password']) {
            $data['password'] = Hash::make($data['new_password']); //mostro la hash
        }

        $user->update($data);

        return redirect()->route('admin.user.edit')->with('message', 'Profilo aggiornato con successo');
    }



    public function downloadPrivateAvatar()
    {

        $user = Auth::user();

        if ($user) {
            $avatar = $user->avatar;
            if ($avatar) {
                //return Storage::disk('local')->download($user->avatar); // => per download del file richiesto
                return response()->file(storage_path('app') .'/' . $user->avatar); // => per stream del file richiesto, più corretto in questo caso
            } else {
                abort(404);
            }
        } else {
            abort(403);
        }
    }
}
