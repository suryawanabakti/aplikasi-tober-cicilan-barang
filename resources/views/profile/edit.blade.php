@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @if (Session::has('status'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('status') }}</p>
        @endif
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <b>Ganti Passsword</b> <br>
                    <form action="/profile" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Password Konfirmasi</label>
                            <input type="text" class="form-control" name="password_confirmation">
                        </div>

                        <button class="btn btn-primary">Ganti Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
