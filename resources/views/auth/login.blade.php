@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <h3 class="mb-3">Login</h3>

        <form method="POST">
            @csrf

            <input class="form-control mb-2" type="email" name="email" placeholder="Email">
            <input class="form-control mb-2" type="password" name="password" placeholder="Password">

            <button class="btn btn-primary w-100">Login</button>
        </form>

        <p class="mt-3 text-center">
            <a href="/register">Create account</a>
        </p>
    </div>
</div>
@endsection
