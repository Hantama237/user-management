@extends('master')
@section('content')
@if($errors->any())
<script>
    swal("Oops","{!! implode('', $errors->all(':message \n')) !!}","error")
</script>
@endif

    <main class="px-3 mb-5">
        <h1>Login</h1>
        <form action="/login" method="POST">
            @csrf
            <div class="form-group mt-3">
                <div class="input-group mb-2">
                    <input type="text" name="email" class="form-control" placeholder="email">
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="password">
                </div>
                <div class="input-group">
                    <button type="submit" style="width: 100%" class="btn btn-secondary fw-bold border-white bg-white">Login</button>
                </div>
            </div>
        </form>
    </main>
    

@endsection