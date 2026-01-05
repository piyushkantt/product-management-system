@extends('layouts.app')

@section('content')
<h2>Admin Dashboard</h2>

<p>Welcome, {{ auth()->user()->name }}</p>

<ul class="list-group mb-3">
    <li class="list-group-item">
        <a href="{{ route('admin.products.index') }}">Manage Products</a>
    </li>
   
</ul>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button class="btn btn-danger">Logout</button>
</form>
@endsection
