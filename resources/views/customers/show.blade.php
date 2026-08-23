@extends('layouts.app')

@section('title', 'Customer Details')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Customer Details</h1>
    <div class="flex items-center gap-2">
        <a href="{{ route('cart.index', $customer) }}"
           class="rounded-lg bg-gray-800 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700">View Cart ({{ $customer->carts()->count() }})</a>
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

<h2 class="text-xl font-bold text-gray-900 mt-10 mb-4">Products — Place an Order</h2>

<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">#</th>
                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Name</th>
                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Price</th>
                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Stock</th>
                <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($products as $product)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $product->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Rp {{ number_format($product->price, 2) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <span class="{{ $product->stock > 0 ? 'text-green-700 bg-green-50' : 'text-red-700 bg-red-50' }} rounded-full px-2.5 py-0.5 font-medium">
                            {{ $product->stock }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-right">
                        <form action="{{ route('cart.store', $customer) }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" {{ $product->stock < 1 ? 'disabled' : '' }}
                                    class="rounded-lg {{ $product->stock < 1 ? 'bg-gray-300 cursor-not-allowed' : 'bg-indigo-600 hover:bg-indigo-500' }} px-3 py-1.5 text-sm font-semibold text-white">
                                Order
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-sm text-gray-500">
                        No products available. <a href="{{ route('products.create') }}" class="text-indigo-600 hover:underline">Add a product</a>.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
