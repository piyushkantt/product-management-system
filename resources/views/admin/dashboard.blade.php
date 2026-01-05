@extends('layouts.app')

@section('content')
<h2>Admin Dashboard</h2>

<p>Welcome, {{ auth()->user()->name }}</p>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button class="btn btn-danger">Logout</button>
</form>
@endsection
