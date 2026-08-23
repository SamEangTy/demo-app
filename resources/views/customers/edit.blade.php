@extends('layouts.app')

@section('title', 'Edit Customer')

@section('content')
<h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Customer</h1>

<div class="max-w-xl bg-white rounded-xl shadow p-6">
    @include('customers._form')
</div>
@endsection
