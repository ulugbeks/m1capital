@extends('admin.layout')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="text-2xl font-bold mb-6">Edit Product: {{ $product->key }}</h1>
            
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- Basic Info -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-4">Basic Information</h3>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Product Key <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="key" 
                                   value="{{ old('key', $product->key) }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm"
                                   required>
                            @error('key')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Order
                            </label>
                            <input type="number" 
                                   name="order" 
                                   value="{{ old('order', $product->order) }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Product Image
                        </label>
                        @if($product->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="h-32 object-contain">
                                <p class="text-sm text-gray-500 mt-1">Current image</p>
                            </div>
                        @endif
                        <input type="file" 
                               name="image" 
                               accept="image/*"
                               class="w-full">
                        <p class="text-sm text-gray-500 mt-1">Leave empty to keep current image</p>
                    </div>
                    
                    <div class="mb-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }} class="mr-2">
                            <span class="text-sm font-medium text-gray-700">Active</span>
                        </label>
                    </div>
                </div>
                
                <!-- Language Tabs -->
                <div class="mb-6">
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex" id="language-tabs">
                            <button type="button" 
                                    class="language-tab active py-2 px-4 border-b-2 font-medium text-sm border-blue-500 text-blue-600"
                                    data-lang="en">
                                English
                            </button>
                            <button type="button" 
                                    class="language-tab py-2 px-4 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300"
                                    data-lang="lv">
                                Latvian
                            </button>
                        </nav>
                    </div>
                </div>
                
                @foreach(['en', 'lv'] as $locale)
                    <div class="language-content {{ $locale !== 'en' ? 'hidden' : '' }}" data-lang="{{ $locale }}">
                        <h3 class="text-lg font-semibold mb-4">{{ $locale === 'en' ? 'English' : 'Latvian' }} Content</h3>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="title[{{ $locale }}]" 
                                   value="{{ old('title.'.$locale, $product->translate($locale)->title ?? '') }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm"
                                   required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Subtitle
                            </label>
                            <input type="text" 
                                   name="subtitle[{{ $locale }}]" 
                                   value="{{ old('subtitle.'.$locale, $product->translate($locale)->subtitle ?? '') }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Description
                            </label>
                            <textarea name="description[{{ $locale }}]" 
                                      rows="4"
                                      class="w-full border-gray-300 rounded-md shadow-sm">{{ old('description.'.$locale, $product->translate($locale)->description ?? '') }}</textarea>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Manufacturer's Standard
                            </label>
                            <input type="text" 
                                   name="manufacturers_standard[{{ $locale }}]" 
                                   value="{{ old('manufacturers_standard.'.$locale, $product->translate($locale)->manufacturers_standard ?? '') }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Features (one per line)
                            </label>
                            @php
                                $features = $product->translate($locale)->features ?? [];
                                $featuresText = is_array($features) ? implode("\n", $features) : '';
                            @endphp
                            <textarea name="features[{{ $locale }}][]" 
                                      rows="4"
                                      class="w-full border-gray-300 rounded-md shadow-sm">{{ old('features.'.$locale, $featuresText) }}</textarea>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Applications (one per line)
                            </label>
                            @php
                                $applications = $product->translate($locale)->applications ?? [];
                                $applicationsText = is_array($applications) ? implode("\n", $applications) : '';
                            @endphp
                            <textarea name="applications[{{ $locale }}][]" 
                                      rows="3"
                                      class="w-full border-gray-300 rounded-md shadow-sm">{{ old('applications.'.$locale, $applicationsText) }}</textarea>
                        </div>
                    </div>
                @endforeach
                
                <!-- Page associations -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-4">Display on Pages</h3>
                    <div class="space-y-2">
                        @foreach($pages as $page)
                            <label class="flex items-center">
                                <input type="checkbox" 
                                       name="pages[]" 
                                       value="{{ $page->id }}"
                                       {{ in_array($page->id, $selectedPages) ? 'checked' : '' }}
                                       class="mr-2">
                                <span class="text-sm">{{ $page->title }} ({{ $page->slug }})</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                
                <div class="mt-6 flex items-center justify-between">
                    <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:text-gray-900">
                        ← Back to Products
                    </a>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Language Tab Switching
    document.querySelectorAll('.language-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            const lang = this.getAttribute('data-lang');
            
            // Update active tab
            document.querySelectorAll('.language-tab').forEach(t => {
                t.classList.remove('active', 'border-blue-500', 'text-blue-600');
                t.classList.add('border-transparent', 'text-gray-500');
            });
            this.classList.remove('border-transparent', 'text-gray-500');
            this.classList.add('active', 'border-blue-500', 'text-blue-600');
            
            // Show/hide content
            document.querySelectorAll('.language-content').forEach(content => {
                if (content.getAttribute('data-lang') === lang) {
                    content.classList.remove('hidden');
                } else {
                    content.classList.add('hidden');
                }
            });
        });
    });
    
    // Process features and applications textareas
    document.querySelector('form').addEventListener('submit', function(e) {
        // Convert textarea lines to array
        document.querySelectorAll('textarea[name^="features"], textarea[name^="applications"]').forEach(textarea => {
            const lines = textarea.value.split('\n').filter(line => line.trim());
            const hiddenContainer = document.createElement('div');
            
            lines.forEach(line => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = textarea.name;
                input.value = line.trim();
                hiddenContainer.appendChild(input);
            });
            
            textarea.parentNode.appendChild(hiddenContainer);
            textarea.disabled = true;
        });
    });
</script>
@endpush