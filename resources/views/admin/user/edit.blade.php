@extends('admin.layouts.base')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <h1>Modifica utente</h1>


                @if (\Session::has('message'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('message') !!}</li>
                        </ul>
                    </div>
                @endif


                <form method="POST" action={{route('admin.user.update')}} enctype="multipart/form-data">

                    <input autocomplete="false" name="hidden" type="text" style="display:none;">

                    @csrf
                    @method('PUT')

                    @if ($user->avatar)
                        <p>Avatar attuale</p>
                        <img class="img-thumbnail" src="{{route('admin.user.getAvatar')}}" alt="{{$user->name}}">
                    @endif

                    <div class="form-group">
                        <label for="avatar">Carica un nuovo avatar</label>
                        <input class="form-control" type="file" name="avatar" id="avatar">
                    </div>

                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old('name', $user->name)}}">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{old('email', $user->email)}}">
                    </div>


                    <div class="card p-3">
                        <h4>Aggiorna password - lascia vuota per non aggiornare</h4>

                        <div class="form-group">
                            <label for="new_password">Nuova password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" autocomplete="new-password">
                        </div>

                        <div class="form-group">
                            <label for="new_password_confirmation">Conferma nuova password</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" autocomplete="new-password">
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary mt-5">Salva</button>

                  </form>

            </div>
        </div>
    </div>
@endsection


