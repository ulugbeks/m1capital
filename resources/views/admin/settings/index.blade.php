@extends('admin.layout')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="text-2xl font-bold mb-6">Site Settings</h1>
            
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                
                <!-- Contact Information -->
                <div class="mb-8">
                    <h2 class="text-lg font-semibold mb-4">Contact Information</h2>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Phone Number
                        </label>
                        <input type="text" 
                               name="settings[phone]" 
                               value="{{ $settings['phone']->value ?? '' }}"
                               class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Email Address
                        </label>
                        <input type="email" 
                               name="settings[email]" 
                               value="{{ $settings['email']->value ?? '' }}"
                               class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                </div>
                
                <!-- Social Media -->
                <div class="mb-8">
                    <h2 class="text-lg font-semibold mb-4">Social Media</h2>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            LinkedIn URL
                        </label>
                        <input type="url" 
                               name="settings[linkedin]" 
                               value="{{ $settings['linkedin']->value ?? '' }}"
                               class="w-full border-gray-300 rounded-md shadow-sm"
                               placeholder="https://www.linkedin.com/company/...">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Instagram URL
                        </label>
                        <input type="url" 
                               name="settings[instagram]" 
                               value="{{ $settings['instagram']->value ?? '' }}"
                               class="w-full border-gray-300 rounded-md shadow-sm"
                               placeholder="https://www.instagram.com/...">
                    </div>
                </div>
                
                <!-- Language Tabs for Translatable Settings -->
                <div class="mb-8">
                    <h2 class="text-lg font-semibold mb-4">Footer Content</h2>
                    
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
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Footer Description ({{ strtoupper($locale) }})
                                </label>
                                <textarea name="settings[footer_description][{{ $locale }}]" 
                                          rows="3"
                                          class="w-full border-gray-300 rounded-md shadow-sm">{{ isset($settings['footer_description']) && $settings['footer_description']->translate($locale) ? $settings['footer_description']->translate($locale)->value : 'Experts in smart EV charging solutions for residential sites and businesses.' }}</textarea>
                                <p class="text-sm text-gray-500 mt-1">This text appears in the footer of all pages</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- SEO Settings -->
                <div class="mb-8">
                    <h2 class="text-lg font-semibold mb-4">Default SEO Settings</h2>
                    
                    <div class="mb-6">
                        <div class="border-b border-gray-200">
                            <nav class="-mb-px flex" id="seo-tabs">
                                <button type="button" 
                                        class="seo-tab active py-2 px-4 border-b-2 font-medium text-sm border-blue-500 text-blue-600"
                                        data-lang="en">
                                    English
                                </button>
                                <button type="button" 
                                        class="seo-tab py-2 px-4 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300"
                                        data-lang="lv">
                                    Latvian
                                </button>
                            </nav>
                        </div>
                    </div>
                    
                    
                </div>
                
                <div class="mt-6 flex items-center justify-between">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-gray-900">
                        ← Back to Dashboard
                    </a>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Language Tab Switching for Footer
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
    
    // SEO Tab Switching
    document.querySelectorAll('.seo-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            const lang = this.getAttribute('data-lang');
            
            // Update active tab
            document.querySelectorAll('.seo-tab').forEach(t => {
                t.classList.remove('active', 'border-blue-500', 'text-blue-600');
                t.classList.add('border-transparent', 'text-gray-500');
            });
            this.classList.remove('border-transparent', 'text-gray-500');
            this.classList.add('active', 'border-blue-500', 'text-blue-600');
            
            // Show/hide content
            document.querySelectorAll('.seo-content').forEach(content => {
                if (content.getAttribute('data-lang') === lang) {
                    content.classList.remove('hidden');
                } else {
                    content.classList.add('hidden');
                }
            });
        });
    });
</script>
@endpush