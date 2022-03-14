@extends('master')
@section('content')


    <main class="px-3 mb-5">
        <h1>Login</h1>
        <div class="form-group mt-3">
            <form action="/admin/login" method="POST">
                @csrf
                <div class="input-group mb-2">
                    <input type="text" name="username" class="form-control" placeholder="username">
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="password">
                </div>
                <div class="input-group">
                    <button type="submit" style="width: 100%" class="btn btn-secondary fw-bold border-white bg-white">Login</button>
                </div>
            </form>
        </div>
    </main>
    

@endsection