@extends('admin.layout')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="text-2xl font-bold mb-6">Create New Partner</h1>
            
            <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Partner Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           value="{{ old('name') }}"
                           class="w-full border-gray-300 rounded-md shadow-sm"
                           required>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Logo <span class="text-red-500">*</span>
                    </label>
                    <input type="file" 
                           name="logo" 
                           accept="image/*"
                           class="w-full"
                           required>
                    @error('logo')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-sm text-gray-500 mt-1">Recommended size: 200x100px</p>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Category
                    </label>
                    <select name="category" class="w-full border-gray-300 rounded-md shadow-sm">
                        <option value="partners" {{ old('category') === 'partners' ? 'selected' : '' }}>Partners</option>
                        <option value="charity" {{ old('category') === 'charity' ? 'selected' : '' }}>Charity</option>
                        <option value="hardware" {{ old('category') === 'hardware' ? 'selected' : '' }}>Hardware</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Order
                    </label>
                    <input type="number" 
                           name="order" 
                           value="{{ old('order', 0) }}"
                           class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
                
                <div class="mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" checked class="mr-2">
                        <span class="text-sm font-medium text-gray-700">Active</span>
                    </label>
                </div>
                
                <div class="mt-6 flex items-center justify-between">
                    <a href="{{ route('admin.partners.index') }}" class="text-gray-600 hover:text-gray-900">
                        ← Back to Partners
                    </a>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Create Partner
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection