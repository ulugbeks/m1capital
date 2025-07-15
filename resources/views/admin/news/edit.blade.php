@extends('admin.layout')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="text-2xl font-bold mb-6">Edit News Article</h1>
            
            <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
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
                
                <!-- Image Upload -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Featured Image
                    </label>
                    @if($news->image)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="h-32 w-auto rounded">
                            <p class="text-sm text-gray-500 mt-2">Current image</p>
                        </div>
                    @endif
                    <input type="file" 
                           name="image" 
                           accept="image/*"
                           class="w-full">
                    <p class="text-sm text-gray-500 mt-1">Leave empty to keep current image</p>
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Status -->
                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_published" value="1" {{ $news->is_published ? 'checked' : '' }} class="mr-2">
                        <span class="text-sm font-medium text-gray-700">Published</span>
                    </label>
                    @if($news->published_at)
                        <p class="text-sm text-gray-500 mt-1">Published at: {{ $news->published_at->format('M d, Y H:i') }}</p>
                    @endif
                </div>
                
                @foreach(['en', 'lv'] as $locale)
                    <div class="language-content {{ $locale !== 'en' ? 'hidden' : '' }}" data-lang="{{ $locale }}">
                        <h3 class="text-lg font-semibold mb-4">{{ $locale === 'en' ? 'English' : 'Latvian' }} Content</h3>
                        
                        <!-- Title -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="title[{{ $locale }}]" 
                                   value="{{ old('title.'.$locale, $news->translate($locale)->title ?? '') }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm"
                                   required>
                            @error('title.'.$locale)
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Excerpt -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Excerpt (Short Description)
                            </label>
                            <textarea name="excerpt[{{ $locale }}]" 
                                      rows="3"
                                      class="w-full border-gray-300 rounded-md shadow-sm">{{ old('excerpt.'.$locale, $news->translate($locale)->excerpt ?? '') }}</textarea>
                        </div>
                        
                        <!-- Content -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Content <span class="text-red-500">*</span>
                            </label>
                            <textarea name="content[{{ $locale }}]" 
                                      rows="10"
                                      class="w-full border-gray-300 rounded-md shadow-sm tinymce"
                                      required>{{ old('content.'.$locale, $news->translate($locale)->content ?? '') }}</textarea>
                            @error('content.'.$locale)
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- SEO Fields -->
                        <h4 class="text-md font-semibold mt-6 mb-4">SEO Settings</h4>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Meta Title
                            </label>
                            <input type="text" 
                                   name="meta_title[{{ $locale }}]" 
                                   value="{{ old('meta_title.'.$locale, $news->translate($locale)->meta_title ?? '') }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm"
                                   placeholder="Leave empty to use article title">
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Meta Description
                            </label>
                            <textarea name="meta_description[{{ $locale }}]" 
                                      rows="3"
                                      class="w-full border-gray-300 rounded-md shadow-sm"
                                      placeholder="Leave empty to auto-generate from content">{{ old('meta_description.'.$locale, $news->translate($locale)->meta_description ?? '') }}</textarea>
                        </div>
                    </div>
                @endforeach
                
                <div class="mt-6 flex items-center justify-between">
                    <a href="{{ route('admin.news.index') }}" class="text-gray-600 hover:text-gray-900">
                        ← Back to News
                    </a>
                    <div class="flex space-x-4">
                        @if($news->is_published)
                            <a href="{{ route('news.show', ['locale' => 'en', 'news' => $news]) }}" 
                               target="_blank"
                               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                                View Article
                            </a>
                        @endif
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Update Article
                        </button>
                    </div>
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
    
    // Initialize TinyMCE
    tinymce.init({
        selector: '.tinymce',
        plugins: 'link lists image',
        toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist | link image',
        height: 400
    });
</script>
@endpush