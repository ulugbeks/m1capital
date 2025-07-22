@extends('admin.layout')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="text-2xl font-bold mb-6">Edit Page: {{ $page->title }}</h1>
            
            <form action="{{ route('admin.pages.update', $page) }}" method="POST" enctype="multipart/form-data">
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
                
                @foreach(['en', 'lv'] as $locale)
                    <div class="language-content {{ $locale !== 'en' ? 'hidden' : '' }}" data-lang="{{ $locale }}">
                        <h3 class="text-lg font-semibold mb-4">{{ $locale === 'en' ? 'English' : 'Latvian' }} Content</h3>
                        
                        <!-- Basic Fields -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                SEO Page Title
                            </label>
                            <input type="text" 
                                   name="title[{{ $locale }}]" 
                                   value="{{ old('title.'.$locale, $page->translate($locale)->title ?? '') }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        
                        <!-- SEO Fields -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                SEO Meta Title
                            </label>
                            <input type="text" 
                                   name="meta_title[{{ $locale }}]" 
                                   value="{{ old('meta_title.'.$locale, $page->translate($locale)->meta_title ?? '') }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                               SEO Meta Description
                            </label>
                            <textarea name="meta_description[{{ $locale }}]" 
                                      rows="3"
                                      class="w-full border-gray-300 rounded-md shadow-sm">{{ old('meta_description.'.$locale, $page->translate($locale)->meta_description ?? '') }}</textarea>
                        </div>
                        
                        <hr class="mb-4" style="border: 2px solid #333;">
                        @php
                            $content = $page->translate($locale)->content ?? [];
                        @endphp
                        
                        @if($page->slug === 'home')
                            <!-- Home Page Specific Fields -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Slide Title
                                </label>
                                <input type="text" 
                                       name="hero_title[{{ $locale }}]" 
                                       value="{{ old('hero_title.'.$locale, $page->translate($locale)->hero_title ?? '') }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Slide Subtitle
                                </label>
                                <input type="text" 
                                       name="hero_subtitle[{{ $locale }}]" 
                                       value="{{ old('hero_subtitle.'.$locale, $page->translate($locale)->hero_subtitle ?? '') }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            
                            <!-- Home Page Sections -->
                            <h4 class="text-md font-semibold mt-6 mb-4">Section 1</h4>
                            
                            <!-- Future Proof Section -->
                            <div class="mb-4 p-4 bg-gray-50 rounded">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Section 1 Title
                                </label>
                                <textarea name="content[{{ $locale }}][future_proof][title]" 
                                          rows="2"
                                          class="w-full border-gray-300 rounded-md shadow-sm">{{ old('content.'.$locale.'.future_proof.title', $content['future_proof']['title'] ?? '') }}</textarea>
                            </div>
                            
                            <!-- Help Section -->
                            <div class="mb-4 p-4 bg-gray-50 rounded">
                                <h5 class="font-medium mb-2">Section 2</h5>
                                <input type="text" 
                                       name="content[{{ $locale }}][help][title]" 
                                       value="{{ old('content.'.$locale.'.help.title', $content['help']['title'] ?? '') }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm mb-4">
                                <!-- Tab Names -->
                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Slide Tab Names</label>
                                    @foreach(['expertise', 'guidance', 'support'] as $tabIndex => $tabKey)
                                        <div class="mb-2">
                                            <label class="block text-xs text-gray-600 mb-1">Tab {{ $tabIndex + 1 }}</label>
                                            <input type="text" 
                                                   name="content[{{ $locale }}][help][tabs][{{ $tabIndex }}][title]" 
                                                   value="{{ old('content.'.$locale.'.help.tabs.'.$tabIndex.'.title', $content['help']['tabs'][$tabIndex]['title'] ?? ucfirst($tabKey)) }}"
                                                   class="w-full border-gray-300 rounded-md shadow-sm">
                                            <input type="hidden" 
                                                   name="content[{{ $locale }}][help][tabs][{{ $tabIndex }}][key]" 
                                                   value="{{ $tabKey }}">
                                        </div>
                                    @endforeach
                                </div>

                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Section Title
                                </label>
                                <input type="text" 
                                       name="content[{{ $locale }}][help][title]" 
                                       value="{{ old('content.'.$locale.'.help.title', $content['help']['title'] ?? '') }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm mb-4">
                                
                                <!-- @for($i = 0; $i < 3; $i++)
                                    <div class="mb-3 p-3 bg-white rounded border">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Item {{ $i + 1 }} Title</label>
                                        <input type="text" 
                                               name="content[{{ $locale }}][help][items][{{ $i }}][title]" 
                                               value="{{ old('content.'.$locale.'.help.items.'.$i.'.title', $content['help']['items'][$i]['title'] ?? '') }}"
                                               class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                        
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Item {{ $i + 1 }} Description</label>
                                        <textarea name="content[{{ $locale }}][help][items][{{ $i }}][description]" 
                                                  rows="2"
                                                  class="w-full border-gray-300 rounded-md shadow-sm">{{ old('content.'.$locale.'.help.items.'.$i.'.description', $content['help']['items'][$i]['description'] ?? '') }}</textarea>
                                        
                                        <input type="hidden" 
                                               name="content[{{ $locale }}][help][items][{{ $i }}][number]" 
                                               value="{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}">
                                        
                                        <input type="hidden" 
                                               name="content[{{ $locale }}][help][items][{{ $i }}][tab_key]" 
                                               value="{{ $content['help']['items'][$i]['tab_key'] ?? ['expertise', 'guidance', 'support'][$i] }}">
                                    </div>
                                @endfor -->
                                
                                
                            </div>
                            
                            <!-- Solutions Ad Section -->
                            <div class="mb-4 p-4 bg-gray-50 rounded">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Banner text
                                </label>
                                <textarea name="content[{{ $locale }}][solutions_ad][title]" 
                                          rows="2"
                                          class="w-full border-gray-300 rounded-md shadow-sm">{{ old('content.'.$locale.'.solutions_ad.title', $content['solutions_ad']['title'] ?? '') }}</textarea>
                            </div>
                            
                            <!-- Products Section -->
                            <!-- <div class="mb-4 p-4 bg-gray-50 rounded">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Products Section Title
                                </label>
                                <input type="text" 
                                       name="content[{{ $locale }}][products][title]" 
                                       value="{{ old('content.'.$locale.'.products.title', $content['products']['title'] ?? '') }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm">
                                <p class="text-sm text-gray-500 mt-1">Products are managed separately in the Products section.</p>
                            </div> -->
                            
                            <!-- Partners Section -->
                            <div class="mb-4 p-4 bg-gray-50 rounded">
                                <h5 class="font-medium mb-2">Section 4</h5>
                                
                                <label class="block text-sm font-medium text-gray-700 mb-2">Subtitle</label>
                                <input type="text" 
                                       name="content[{{ $locale }}][partners][subtitle]" 
                                       value="{{ old('content.'.$locale.'.partners.subtitle', $content['partners']['subtitle'] ?? '') }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                
                                <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                                <textarea name="content[{{ $locale }}][partners][title]" 
                                          rows="3"
                                          class="w-full border-gray-300 rounded-md shadow-sm mb-2">{{ old('content.'.$locale.'.partners.title', $content['partners']['title'] ?? '') }}</textarea>
                                
                                <label class="block text-sm font-medium text-gray-700 mb-2">Drag Slider Text</label>
                                <input type="text" 
                                       name="content[{{ $locale }}][partners][drag_text]" 
                                       value="{{ old('content.'.$locale.'.partners.drag_text', $content['partners']['drag_text'] ?? 'Drag slider') }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                
                                <label class="block text-sm font-medium text-gray-700 mb-2">Description Subtitle</label>
                                <input type="text" 
                                       name="content[{{ $locale }}][partners][description_subtitle]" 
                                       value="{{ old('content.'.$locale.'.partners.description_subtitle', $content['partners']['description_subtitle'] ?? '') }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                
                                <label class="block text-sm font-medium text-gray-700 mb-2">Description Text</label>
                                <textarea name="content[{{ $locale }}][partners][description_text]" 
                                          rows="3"
                                          class="w-full border-gray-300 rounded-md shadow-sm">{{ old('content.'.$locale.'.partners.description_text', $content['partners']['description_text'] ?? '') }}</textarea>
                                
                                <!-- <p class="text-sm text-gray-500 mt-1">Partner logos are managed separately in the Partners section.</p> -->
                            </div>
                            
                            <!-- Get Started Section -->
                            <div class="mb-4 p-4 bg-gray-50 rounded">
                                <h5 class="font-medium mb-2">Section 5</h5>
                                
                                <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                                <textarea name="content[{{ $locale }}][get_started][title]" 
                                          rows="2"
                                          class="w-full border-gray-300 rounded-md shadow-sm mb-2">{{ old('content.'.$locale.'.get_started.title', $content['get_started']['title'] ?? '') }}</textarea>
                                
                                <label class="block text-sm font-medium text-gray-700 mb-2">Button Text</label>
                                <input type="text" 
                                       name="content[{{ $locale }}][get_started][button_text]" 
                                       value="{{ old('content.'.$locale.'.get_started.button_text', $content['get_started']['button_text'] ?? 'Contact us') }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                
                                <label class="block text-sm font-medium text-gray-700 mb-2">Subtitle</label>
                                <input type="text" 
                                       name="content[{{ $locale }}][get_started][subtitle]" 
                                       value="{{ old('content.'.$locale.'.get_started.subtitle', $content['get_started']['subtitle'] ?? '') }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                
                                <label class="block text-sm font-medium text-gray-700 mb-2">Text</label>
                                <textarea name="content[{{ $locale }}][get_started][text]" 
                                          rows="3"
                                          class="w-full border-gray-300 rounded-md shadow-sm">{{ old('content.'.$locale.'.get_started.text', $content['get_started']['text'] ?? '') }}</textarea>
                            </div>
                            
                        @elseif($page->type === 'solution')
                            <!-- Solution Page Content -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Hero Title
                                </label>
                                <input type="text" 
                                       name="hero_title[{{ $locale }}]" 
                                       value="{{ old('hero_title.'.$locale, $page->translate($locale)->hero_title ?? '') }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Hero Subtitle
                                </label>
                                <textarea name="hero_subtitle[{{ $locale }}]" 
                                          rows="2"
                                          class="w-full border-gray-300 rounded-md shadow-sm">{{ old('hero_subtitle.'.$locale, $page->translate($locale)->hero_subtitle ?? '') }}</textarea>
                            </div>
                            
                            <!-- Images Section for Solutions -->
                            <div class="mb-6 p-4 bg-yellow-50 rounded border border-yellow-200">
                                <h5 class="font-medium mb-4 text-yellow-900">📸 Images Management</h5>
                                
                                <!-- Rellax Image -->
                                <div class="mb-4 p-3 bg-white rounded">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Top Parallax Image (Rellax)
                                    </label>
                                    @if($page->translate($locale)->rellax_image ?? null)
                                        <div class="mb-3">
                                            <img src="{{ asset('storage/' . $page->translate($locale)->rellax_image) }}" 
                                                 alt="Rellax Image" 
                                                 class="h-32 w-auto rounded shadow">
                                            <label class="flex items-center mt-2 text-red-600">
                                                <input type="checkbox" 
                                                       name="delete_rellax_image[{{ $locale }}]" 
                                                       value="1" 
                                                       class="mr-2">
                                                <span class="text-sm">Delete this image</span>
                                            </label>
                                        </div>
                                    @endif
                                    <input type="file" 
                                           name="rellax_image[{{ $locale }}]" 
                                           accept="image/*"
                                           class="w-full">
                                    <p class="text-xs text-gray-500 mt-1">This image appears at the top with parallax effect when "Show parallax image at top" is checked</p>
                                </div>
                                
                                <!-- Info Section Image -->
                                <div class="mb-4 p-3 bg-white rounded">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Info Section Image
                                    </label>
                                    @if($page->translate($locale)->info_image ?? null)
                                        <div class="mb-3">
                                            <img src="{{ asset('storage/' . $page->translate($locale)->info_image) }}" 
                                                 alt="Info Image" 
                                                 class="h-32 w-auto rounded shadow">
                                            <label class="flex items-center mt-2 text-red-600">
                                                <input type="checkbox" 
                                                       name="delete_info_image[{{ $locale }}]" 
                                                       value="1" 
                                                       class="mr-2">
                                                <span class="text-sm">Delete this image</span>
                                            </label>
                                        </div>
                                    @endif
                                    <input type="file" 
                                           name="info_image[{{ $locale }}]" 
                                           accept="image/*"
                                           class="w-full">
                                    <p class="text-xs text-gray-500 mt-1">This image appears in the info section when "Show image" is checked</p>
                                </div>
                                
                                <!-- Rellax Mini Image -->
                                <div class="mb-4 p-3 bg-white rounded">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Mini Parallax Image
                                    </label>
                                    @if($page->translate($locale)->rellax_mini_image ?? null)
                                        <div class="mb-3">
                                            <img src="{{ asset('storage/' . $page->translate($locale)->rellax_mini_image) }}" 
                                                 alt="Rellax Mini Image" 
                                                 class="h-32 w-auto rounded shadow">
                                            <label class="flex items-center mt-2 text-red-600">
                                                <input type="checkbox" 
                                                       name="delete_rellax_mini_image[{{ $locale }}]" 
                                                       value="1" 
                                                       class="mr-2">
                                                <span class="text-sm">Delete this image</span>
                                            </label>
                                        </div>
                                    @endif
                                    <input type="file" 
                                           name="rellax_mini_image[{{ $locale }}]" 
                                           accept="image/*"
                                           class="w-full">
                                    <p class="text-xs text-gray-500 mt-1">This image appears below the products section when "Show mini parallax image" is checked</p>
                                </div>
                            </div>
                            
                            <!-- Display Settings -->
                            <div class="mb-4 p-4 bg-gray-50 rounded">
                                <h5 class="font-medium mb-2">Display Settings</h5>
                                
                                <label class="flex items-center mb-2">
                                    <input type="checkbox" 
                                           name="content[{{ $locale }}][show_rellax]" 
                                           value="1" 
                                           {{ old('content.'.$locale.'.show_rellax', $content['show_rellax'] ?? false) ? 'checked' : '' }}
                                           class="mr-2">
                                    <span class="text-sm">Show parallax image at top</span>
                                </label>
                                
                                <label class="flex items-center mb-2">
                                    <input type="checkbox" 
                                           name="content[{{ $locale }}][show_rellax_mini]" 
                                           value="1" 
                                           {{ old('content.'.$locale.'.show_rellax_mini', $content['show_rellax_mini'] ?? false) ? 'checked' : '' }}
                                           class="mr-2">
                                    <span class="text-sm">Show mini parallax image</span>
                                </label>
                                
                                <label class="block text-sm font-medium text-gray-700 mb-2 mt-4">Button Text</label>
                                <input type="text" 
                                       name="content[{{ $locale }}][button_text]" 
                                       value="{{ old('content.'.$locale.'.button_text', $content['button_text'] ?? 'Contact us') }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                
                                <label class="block text-sm font-medium text-gray-700 mb-2">Explore Text</label>
                                <input type="text" 
                                       name="content[{{ $locale }}][explore_text]" 
                                       value="{{ old('content.'.$locale.'.explore_text', $content['explore_text'] ?? 'Explore') }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            
                            <!-- Info Sections -->
                            <div class="mb-4 p-4 bg-gray-50 rounded">
                                <h5 class="font-medium mb-2">Info Section</h5>
                                
                                <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                                <input type="text" 
                                       name="content[{{ $locale }}][info][title]" 
                                       value="{{ old('content.'.$locale.'.info.title', $content['info']['title'] ?? '') }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                
                                <label class="block text-sm font-medium text-gray-700 mb-2">Link Text</label>
                                <input type="text" 
                                       name="content[{{ $locale }}][info][link_text]" 
                                       value="{{ old('content.'.$locale.'.info.link_text', $content['info']['link_text'] ?? '') }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                
                                <label class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                                <textarea name="content[{{ $locale }}][info][content]" 
                                          rows="10"
                                          class="w-full border-gray-300 rounded-md shadow-sm tinymce">{{ old('content.'.$locale.'.info.content', $content['info']['content'] ?? '') }}</textarea>
                                
                                <label class="flex items-center mt-2">
                                    <input type="checkbox" 
                                           name="content[{{ $locale }}][info][show_image]" 
                                           value="1" 
                                           {{ old('content.'.$locale.'.info.show_image', $content['info']['show_image'] ?? true) ? 'checked' : '' }}
                                           class="mr-2">
                                    <span class="text-sm">Show image</span>
                                </label>
                            </div>
                            
                            <!-- Deliver Section (Benefits) -->
                            <div class="mb-4 p-4 bg-gray-50 rounded">
                                <h5 class="font-medium mb-2">Deliver/Benefits Section</h5>
                                
                                <label class="block text-sm font-medium text-gray-700 mb-2">Section Title</label>
                                <input type="text" 
                                       name="content[{{ $locale }}][deliver][title]" 
                                       value="{{ old('content.'.$locale.'.deliver.title', $content['deliver']['title'] ?? '') }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm mb-4">
                                
                                <label class="flex items-center mb-4">
                                    <input type="checkbox" 
                                           name="content[{{ $locale }}][deliver][show_numbers]" 
                                           value="1" 
                                           {{ old('content.'.$locale.'.deliver.show_numbers', $content['deliver']['show_numbers'] ?? false) ? 'checked' : '' }}
                                           class="mr-2">
                                    <span class="text-sm">Show numbers</span>
                                </label>
                                
                                @for($i = 0; $i < 6; $i++)
                                    <div class="mb-3 p-3 bg-white rounded border">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Item {{ $i + 1 }} Subtitle</label>
                                        <input type="text" 
                                               name="content[{{ $locale }}][deliver][items][{{ $i }}][subtitle]" 
                                               value="{{ old('content.'.$locale.'.deliver.items.'.$i.'.subtitle', $content['deliver']['items'][$i]['subtitle'] ?? '') }}"
                                               class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                        
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Item {{ $i + 1 }} Text</label>
                                        <textarea name="content[{{ $locale }}][deliver][items][{{ $i }}][text]" 
                                                  rows="2"
                                                  class="w-full border-gray-300 rounded-md shadow-sm">{{ old('content.'.$locale.'.deliver.items.'.$i.'.text', $content['deliver']['items'][$i]['text'] ?? '') }}</textarea>
                                    </div>
                                @endfor
                            </div>
                            
                            <!-- Benefits Section (Alternative) -->
                            <div class="mb-4 p-4 bg-gray-50 rounded">
                                <h5 class="font-medium mb-2">Key Benefits Section (Alternative Layout)</h5>
                                
                                <label class="block text-sm font-medium text-gray-700 mb-2">Section Title</label>
                                <input type="text" 
                                       name="content[{{ $locale }}][benefits][title]" 
                                       value="{{ old('content.'.$locale.'.benefits.title', $content['benefits']['title'] ?? '') }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm mb-4">
                                
                                @for($i = 0; $i < 4; $i++)
                                    <div class="mb-3 p-3 bg-white rounded border">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Benefit {{ $i + 1 }} Title</label>
                                        <input type="text" 
                                               name="content[{{ $locale }}][benefits][items][{{ $i }}][title]" 
                                               value="{{ old('content.'.$locale.'.benefits.items.'.$i.'.title', $content['benefits']['items'][$i]['title'] ?? '') }}"
                                               class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                        
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Benefit {{ $i + 1 }} Text</label>
                                        <textarea name="content[{{ $locale }}][benefits][items][{{ $i }}][text]" 
                                                  rows="2"
                                                  class="w-full border-gray-300 rounded-md shadow-sm">{{ old('content.'.$locale.'.benefits.items.'.$i.'.text', $content['benefits']['items'][$i]['text'] ?? '') }}</textarea>
                                    </div>
                                @endfor
                            </div>
                            
                            <!-- Products Section -->
                            <!-- <div class="mb-4 p-4 bg-gray-50 rounded">
                                <h5 class="font-medium mb-2">Products Section</h5>
                                
                                <label class="block text-sm font-medium text-gray-700 mb-2">Subtitle</label>
                                <input type="text" 
                                       name="content[{{ $locale }}][products][subtitle]" 
                                       value="{{ old('content.'.$locale.'.products.subtitle', $content['products']['subtitle'] ?? '') }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                
                                <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                                <textarea name="content[{{ $locale }}][products][title]" 
                                          rows="2"
                                          class="w-full border-gray-300 rounded-md shadow-sm">{{ old('content.'.$locale.'.products.title', $content['products']['title'] ?? '') }}</textarea>
                                
                                <p class="text-sm text-gray-500">Products are managed separately in the Products section.</p>
                            </div> -->
                            
                            <!-- FAQ Section -->
                            <div class="mb-4 p-4 bg-gray-50 rounded">
                                <h5 class="font-medium mb-2">FAQ Section</h5>
                                
                                <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                                <textarea name="content[{{ $locale }}][faq][title]" 
                                          rows="2"
                                          class="w-full border-gray-300 rounded-md shadow-sm mb-2">{{ old('content.'.$locale.'.faq.title', $content['faq']['title'] ?? '') }}</textarea>
                                
                                <label class="block text-sm font-medium text-gray-700 mb-2">Subtitle</label>
                                <input type="text" 
                                       name="content[{{ $locale }}][faq][subtitle]" 
                                       value="{{ old('content.'.$locale.'.faq.subtitle', $content['faq']['subtitle'] ?? 'Frequently asked questions') }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm mb-4">
                                
                                @for($i = 0; $i < 6; $i++)
                                    <div class="mb-3 p-3 bg-white rounded border">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Question {{ $i + 1 }}</label>
                                        <input type="text" 
                                               name="content[{{ $locale }}][faq][items][{{ $i }}][question]" 
                                               value="{{ old('content.'.$locale.'.faq.items.'.$i.'.question', $content['faq']['items'][$i]['question'] ?? '') }}"
                                               class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                        
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Answer {{ $i + 1 }}</label>
                                        <textarea name="content[{{ $locale }}][faq][items][{{ $i }}][answer]" 
                                                  rows="3"
                                                  class="w-full border-gray-300 rounded-md shadow-sm tinymce">{{ old('content.'.$locale.'.faq.items.'.$i.'.answer', $content['faq']['items'][$i]['answer'] ?? '') }}</textarea>
                                    </div>
                                @endfor
                            </div>
                            
                            <!-- Get Started Section -->
                            <div class="mb-4 p-4 bg-gray-50 rounded">
                                <h5 class="font-medium mb-2">Get Started Section</h5>
                                
                                <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                                <textarea name="content[{{ $locale }}][get_started][title]" 
                                          rows="2"
                                          class="w-full border-gray-300 rounded-md shadow-sm mb-2">{{ old('content.'.$locale.'.get_started.title', $content['get_started']['title'] ?? '') }}</textarea>
                                
                                <label class="block text-sm font-medium text-gray-700 mb-2">Button Text</label>
                                <input type="text" 
                                       name="content[{{ $locale }}][get_started][button_text]" 
                                       value="{{ old('content.'.$locale.'.get_started.button_text', $content['get_started']['button_text'] ?? 'Contact us') }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                
                                <label class="block text-sm font-medium text-gray-700 mb-2">Subtitle</label>
                                <input type="text" 
                                       name="content[{{ $locale }}][get_started][subtitle]" 
                                       value="{{ old('content.'.$locale.'.get_started.subtitle', $content['get_started']['subtitle'] ?? '') }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                
                                <label class="block text-sm font-medium text-gray-700 mb-2">Text</label>
                                <textarea name="content[{{ $locale }}][get_started][text]" 
                                          rows="3"
                                          class="w-full border-gray-300 rounded-md shadow-sm">{{ old('content.'.$locale.'.get_started.text', $content['get_started']['text'] ?? '') }}</textarea>
                            </div>
                            
                        @elseif($page->slug === 'solutions')
                            <!-- Solutions Page Specific Content -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Hero Title
                                </label>
                                <input type="text" 
                                       name="hero_title[{{ $locale }}]" 
                                       value="{{ old('hero_title.'.$locale, $page->translate($locale)->hero_title ?? '') }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Hero Subtitle
                                </label>
                                <textarea name="hero_subtitle[{{ $locale }}]" 
                                          rows="2"
                                          class="w-full border-gray-300 rounded-md shadow-sm">{{ old('hero_subtitle.'.$locale, $page->translate($locale)->hero_subtitle ?? '') }}</textarea>
                            </div>
                            
                            <div class="mb-4 p-4 bg-gray-50 rounded">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Pick Your Use Case Title
                                </label>
                                <input type="text" 
                                       name="content[{{ $locale }}][pick_use_case_title]" 
                                       value="{{ old('content.'.$locale.'.pick_use_case_title', $content['pick_use_case_title'] ?? 'Pick your use case') }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            
                            <!-- Solution Cards Content -->
                            <div class="mb-4 p-4 bg-blue-50 rounded">
                                <h5 class="font-medium mb-4 text-blue-800">Solution Cards Content</h5>
                                
                                @php
                                    // Получаем все страницы решений
                                    $solutionPages = \App\Models\Page::where('type', 'solution')->ordered()->get();
                                @endphp
                                
                                @foreach($solutionPages as $index => $solution)
                                    <div class="mb-6 p-4 bg-white rounded border border-blue-200">
                                        <h6 class="font-semibold mb-3 text-blue-700">
                                            {{ $index + 1 }}. {{ $solution->title }} ({{ $solution->slug }})
                                        </h6>
                                        
                                        <div class="mb-3">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Card Title
                                            </label>
                                            <input type="text" 
                                                   name="content[{{ $locale }}][solutions][{{ $solution->slug }}][card_title]" 
                                                   value="{{ old('content.'.$locale.'.solutions.'.$solution->slug.'.card_title', $content['solutions'][$solution->slug]['card_title'] ?? '') }}"
                                                   class="w-full border-gray-300 rounded-md shadow-sm"
                                                   placeholder="Title shown next to the solution card">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Card Text
                                            </label>
                                            <textarea name="content[{{ $locale }}][solutions][{{ $solution->slug }}][card_text]" 
                                                      rows="3"
                                                      class="w-full border-gray-300 rounded-md shadow-sm"
                                                      placeholder="Text shown next to the solution card">{{ old('content.'.$locale.'.solutions.'.$solution->slug.'.card_text', $content['solutions'][$solution->slug]['card_text'] ?? '') }}</textarea>
                                        </div>
                                    </div>
                                @endforeach
                                
                                <p class="text-sm text-gray-600 mt-2">
                                    These fields control how each solution appears on this Solutions page in a chess-like pattern
                                </p>
                            </div>
                            
                        @elseif(in_array($page->slug, ['about', 'contact', 'news']))
                            <!-- Static Pages with Hero -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Hero Title
                                </label>
                                <input type="text" 
                                       name="hero_title[{{ $locale }}]" 
                                       value="{{ old('hero_title.'.$locale, $page->translate($locale)->hero_title ?? '') }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Hero Subtitle
                                </label>
                                <textarea name="hero_subtitle[{{ $locale }}]" 
                                          rows="2"
                                          class="w-full border-gray-300 rounded-md shadow-sm">{{ old('hero_subtitle.'.$locale, $page->translate($locale)->hero_subtitle ?? '') }}</textarea>
                            </div>
                            
                            @if($page->slug === 'about')
                                <!-- About Page Sections -->
                                <div class="mb-4 p-4 bg-gray-50 rounded">
                                    <h5 class="font-medium mb-2">First Info Section</h5>
                                    
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                                    <input type="text" 
                                           name="content[{{ $locale }}][info][title]" 
                                           value="{{ old('content.'.$locale.'.info.title', $content['info']['title'] ?? '') }}"
                                           class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                    
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Paragraphs (use editor for formatting)</label>
                                    <textarea name="content[{{ $locale }}][info][paragraphs]" 
                                              rows="6"
                                              class="w-full border-gray-300 rounded-md shadow-sm tinymce">{{ old('content.'.$locale.'.info.paragraphs', is_array($content['info']['paragraphs'] ?? null) ? implode("\n\n", $content['info']['paragraphs']) : ($content['info']['paragraphs'] ?? '')) }}</textarea>
                                </div>
                                
                                <div class="mb-4 p-4 bg-gray-50 rounded">
                                    <h5 class="font-medium mb-2">Second Info Section</h5>
                                    
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                                    <input type="text" 
                                           name="content[{{ $locale }}][info2][title]" 
                                           value="{{ old('content.'.$locale.'.info2.title', $content['info2']['title'] ?? '') }}"
                                           class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                    
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Link Text</label>
                                    <input type="text" 
                                           name="content[{{ $locale }}][info2][link_text]" 
                                           value="{{ old('content.'.$locale.'.info2.link_text', $content['info2']['link_text'] ?? '') }}"
                                           class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                    
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Paragraphs</label>
                                    <textarea name="content[{{ $locale }}][info2][paragraphs]" 
                                              rows="6"
                                              class="w-full border-gray-300 rounded-md shadow-sm">{{ old('content.'.$locale.'.info2.paragraphs', is_array($content['info2']['paragraphs'] ?? null) ? implode("\n\n", $content['info2']['paragraphs']) : ($content['info2']['paragraphs'] ?? '')) }}</textarea>
                                </div>
                                
                                <div class="mb-4 p-4 bg-gray-50 rounded">
                                    <h5 class="font-medium mb-2">Partners Section</h5>
                                    
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                                    <textarea name="content[{{ $locale }}][partners][title]" 
                                              rows="2"
                                              class="w-full border-gray-300 rounded-md shadow-sm mb-2">{{ old('content.'.$locale.'.partners.title', $content['partners']['title'] ?? '') }}</textarea>
                                    
                                    <!-- Partner Categories Info -->
                                    @php
                                        $partnerCategories = [
                                            [
                                                'key' => 'partners',
                                                'default_title' => 'Partners',
                                                'default_subtitle' => 'We partner with the best',
                                                'default_text' => 'We\'ve teamed up with leading businesses to provide a comprehensive service.'
                                            ],
                                            [
                                                'key' => 'charity',
                                                'default_title' => 'Charity',
                                                'default_subtitle' => 'Proud to support charities',
                                                'default_text' => 'We\'re proud to be supporting various charitable organizations.'
                                            ],
                                            [
                                                'key' => 'hardware',
                                                'default_title' => 'Hardware',
                                                'default_subtitle' => 'We\'re approved installers of hardware',
                                                'default_text' => 'We have close relationships with our equipment partners.'
                                            ]
                                        ];
                                    @endphp
                                    
                                    <label class="block text-sm font-medium text-gray-700 mb-2 mt-4">Partner Categories</label>
                                    @foreach($partnerCategories as $catIndex => $category)
                                        <div class="mb-4 p-3 bg-white rounded border">
                                            <h6 class="font-medium mb-2">{{ $category['default_title'] }} Category</h6>
                                            
                                            <label class="block text-xs text-gray-600 mb-1">Category Name</label>
                                            <input type="text" 
                                                   name="content[{{ $locale }}][partners][categories][{{ $catIndex }}][title]" 
                                                   value="{{ old('content.'.$locale.'.partners.categories.'.$catIndex.'.title', $content['partners']['categories'][$catIndex]['title'] ?? $category['default_title']) }}"
                                                   class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                            
                                            <label class="block text-xs text-gray-600 mb-1">Info Subtitle</label>
                                            <input type="text" 
                                                   name="content[{{ $locale }}][partners][info][{{ $category['key'] }}][subtitle]" 
                                                   value="{{ old('content.'.$locale.'.partners.info.'.$category['key'].'.subtitle', $content['partners']['info'][$category['key']]['subtitle'] ?? $category['default_subtitle']) }}"
                                                   class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                            
                                            <label class="block text-xs text-gray-600 mb-1">Info Text</label>
                                            <textarea name="content[{{ $locale }}][partners][info][{{ $category['key'] }}][text]" 
                                                      rows="2"
                                                      class="w-full border-gray-300 rounded-md shadow-sm">{{ old('content.'.$locale.'.partners.info.'.$category['key'].'.text', $content['partners']['info'][$category['key']]['text'] ?? $category['default_text']) }}</textarea>
                                            
                                            <input type="hidden" 
                                                   name="content[{{ $locale }}][partners][categories][{{ $catIndex }}][key]" 
                                                   value="{{ $category['key'] }}">
                                        </div>
                                    @endforeach
                                </div>
                                
                                <div class="mb-4 p-4 bg-gray-50 rounded">
                                    <h5 class="font-medium mb-2">Get Started Section</h5>
                                    
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                                    <textarea name="content[{{ $locale }}][get_started][title]" 
                                              rows="2"
                                              class="w-full border-gray-300 rounded-md shadow-sm mb-2">{{ old('content.'.$locale.'.get_started.title', $content['get_started']['title'] ?? '') }}</textarea>
                                    
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Button Text</label>
                                    <input type="text" 
                                           name="content[{{ $locale }}][get_started][button_text]" 
                                           value="{{ old('content.'.$locale.'.get_started.button_text', $content['get_started']['button_text'] ?? 'Contact us') }}"
                                           class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                    
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Subtitle</label>
                                    <input type="text" 
                                           name="content[{{ $locale }}][get_started][subtitle]" 
                                           value="{{ old('content.'.$locale.'.get_started.subtitle', $content['get_started']['subtitle'] ?? '') }}"
                                           class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                    
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Text</label>
                                    <textarea name="content[{{ $locale }}][get_started][text]" 
                                              rows="3"
                                              class="w-full border-gray-300 rounded-md shadow-sm">{{ old('content.'.$locale.'.get_started.text', $content['get_started']['text'] ?? '') }}</textarea>
                                </div>
                                
                            @elseif($page->slug === 'contact')
                                <!-- Contact Page Content -->
                                <div class="mb-4 p-4 bg-gray-50 rounded">
                                    <h5 class="font-medium mb-2">Contact Details</h5>
                                    
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                                    <input type="text" 
                                           name="content[{{ $locale }}][contact_details][title]" 
                                           value="{{ old('content.'.$locale.'.contact_details.title', $content['contact_details']['title'] ?? '') }}"
                                           class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                    
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Office Address</label>
                                    <textarea name="content[{{ $locale }}][contact_details][office_address]" 
                                              rows="6"
                                              class="w-full border-gray-300 rounded-md shadow-sm mb-2">{{ old('content.'.$locale.'.contact_details.office_address', $content['contact_details']['office_address'] ?? '') }}</textarea>
                                    
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Registered Address Label</label>
                                    <input type="text" 
                                           name="content[{{ $locale }}][contact_details][registered_label]" 
                                           value="{{ old('content.'.$locale.'.contact_details.registered_label', $content['contact_details']['registered_label'] ?? '') }}"
                                           class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                    
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Registered Address</label>
                                    <textarea name="content[{{ $locale }}][contact_details][registered_address]" 
                                              rows="6"
                                              class="w-full border-gray-300 rounded-md shadow-sm">{{ old('content.'.$locale.'.contact_details.registered_address', $content['contact_details']['registered_address'] ?? '') }}</textarea>
                                </div>
                                
                                <!-- Form Labels -->
                                <div class="mb-4 p-4 bg-gray-50 rounded">
                                    <h5 class="font-medium mb-2">Contact Form Labels</h5>
                                    
                                    @php
                                        $formFields = [
                                            'first_name' => 'First name',
                                            'last_name' => 'Last name',
                                            'company' => 'Company',
                                            'your_site' => 'Your site',
                                            'address' => 'Address',
                                            'city' => 'City',
                                            'post_code' => 'Post code',
                                            'email' => 'Email',
                                            'telephone' => 'Telephone',
                                            'message' => 'Please tell us a bit about your site',
                                            'privacy' => 'I agree with the privacy statement',
                                            'send_button' => 'Send message'
                                        ];
                                    @endphp
                                    
                                    @foreach($formFields as $fieldKey => $defaultLabel)
                                        <div class="mb-2">
                                            <label class="block text-xs text-gray-600 mb-1">{{ $defaultLabel }} Label</label>
                                            <input type="text" 
                                                   name="content[{{ $locale }}][form_labels][{{ $fieldKey }}]" 
                                                   value="{{ old('content.'.$locale.'.form_labels.'.$fieldKey, $content['form_labels'][$fieldKey] ?? $defaultLabel) }}"
                                                   class="w-full border-gray-300 rounded-md shadow-sm">
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            @elseif($page->type === 'legal')
                                <!-- Legal Pages Content -->
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Page Content
                                    </label>
                                    <textarea name="content[{{ $locale }}][main_content]" 
                                              rows="20"
                                              class="w-full border-gray-300 rounded-md shadow-sm tinymce">{{ old('content.'.$locale.'.main_content', $content['main_content'] ?? '') }}</textarea>
                                    <p class="text-sm text-gray-500 mt-1">Use the rich text editor to format your legal content. You can add headings, lists, links, and other formatting.</p>
                                </div>
                            
                        @else
                            <!-- Generic Page Content -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Page Content
                                </label>
                                <textarea name="content[{{ $locale }}][main_content]" 
                                          rows="10"
                                          class="w-full border-gray-300 rounded-md shadow-sm tinymce">{{ old('content.'.$locale.'.main_content', $content['main_content'] ?? '') }}</textarea>
                            </div>
                        @endif
                    </div>
                @endforeach
                
                <div class="mt-6 flex items-center justify-between">
                    <a href="{{ route('admin.pages.index') }}" class="text-gray-600 hover:text-gray-900">
                        ← Back to Pages
                    </a>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Save Changes
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
    
    // Initialize TinyMCE
    tinymce.init({
      selector: '.tinymce',
      plugins: 'advlist autolink lists link charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount',
      toolbar: `undo redo | blocks | bold italic underline strikethrough | 
                forecolor backcolor | alignleft aligncenter alignright alignjustify | 
                bullist numlist outdent indent | removeformat | link anchor | 
                table | code fullscreen preview | help`,
      height: 400,
      menubar: false,
      branding: false
    });
</script>
@endpush