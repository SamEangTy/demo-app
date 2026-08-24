@extends('layouts.app')

@section('title', 'Customer Details')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Customer Details</h1>
    <div class="flex items-center gap-2">
        <a href="{{ route('customers.edit', $customer) }}"
           class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">Edit</a>
        <a href="{{ route('customers.index') }}"
           class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50">Back</a>
    </div>
</div>

<div class="max-w-xl bg-white rounded-xl shadow divide-y divide-gray-200">
    <dl class="divide-y divide-gray-200">
        <div class="px-6 py-4 grid grid-cols-3 gap-4">
            <dt class="text-sm font-medium text-gray-500">#</dt>
            <dd class="col-span-2 text-sm text-gray-900">{{ $customer->id }}</dd>
        </div>
        <div class="px-6 py-4 grid grid-cols-3 gap-4">
            <dt class="text-sm font-medium text-gray-500">Name</dt>
            <dd class="col-span-2 text-sm text-gray-900">{{ $customer->name }}</dd>
        </div>
        <div class="px-6 py-4 grid grid-cols-3 gap-4">
            <dt class="text-sm font-medium text-gray-500">Email</dt>
            <dd class="col-span-2 text-sm text-gray-900">{{ $customer->email }}</dd>
        </div>
        <div class="px-6 py-4 grid grid-cols-3 gap-4">
            <dt class="text-sm font-medium text-gray-500">Phone</dt>
            <dd class="col-span-2 text-sm text-gray-900">{{ $customer->phone ?? '-' }}</dd>
        </div>
        <div class="px-6 py-4 grid grid-cols-3 gap-4">
            <dt class="text-sm font-medium text-gray-500">Address</dt>
            <dd class="col-span-2 text-sm whitespace-pre-line text-gray-900">{{ $customer->address ?? '-' }}</dd>
        </div>
        <div class="px-6 py-4 grid grid-cols-3 gap-4">
            <dt class="text-sm font-medium text-gray-500">Created At</dt>
            <dd class="col-span-2 text-sm text-gray-900">{{ $customer->created_at->format('d M Y H:i') }}</dd>
        </div>
        <div class="px-6 py-4 grid grid-cols-3 gap-4">
            <dt class="text-sm font-medium text-gray-500">Updated At</dt>
            <dd class="col-span-2 text-sm text-gray-900">{{ $customer->updated_at->format('d M Y H:i') }}</dd>
        </div>
    </dl>
</div>
@endsection
