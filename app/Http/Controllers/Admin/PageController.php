<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::with('translations')->ordered()->paginate(20);
        return view('admin.pages.index', compact('pages'));
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $locales = config('app.available_locales', ['en', 'lv']);
        
        foreach ($locales as $locale) {
            $page->translateOrNew($locale)->title = $request->input("title.{$locale}");
            $page->translateOrNew($locale)->meta_title = $request->input("meta_title.{$locale}");
            $page->translateOrNew($locale)->meta_description = $request->input("meta_description.{$locale}");
            $page->translateOrNew($locale)->meta_keywords = $request->input("meta_keywords.{$locale}");
            
            if (in_array($page->slug, ['home', 'about', 'contact', 'news', 'solutions']) || $page->type === 'solution') {
                $page->translateOrNew($locale)->hero_title = $request->input("hero_title.{$locale}");
                $page->translateOrNew($locale)->hero_subtitle = $request->input("hero_subtitle.{$locale}");
            }
            
            // Добавляем обработку card_title и card_text для страниц решений
            if ($page->type === 'solution') {
                $page->translateOrNew($locale)->card_title = $request->input("card_title.{$locale}");
                $page->translateOrNew($locale)->card_text = $request->input("card_text.{$locale}");
                
                // Обработка изображений для страниц решений
                // Rellax Image
                if ($request->hasFile("rellax_image.{$locale}")) {
                    // Удаляем старое изображение
                    if ($page->translate($locale)->rellax_image ?? null) {
                        Storage::disk('public')->delete($page->translate($locale)->rellax_image);
                    }
                    
                    $path = $request->file("rellax_image.{$locale}")->store('solution-images', 'public');
                    $page->translateOrNew($locale)->rellax_image = $path;
                } elseif ($request->input("delete_rellax_image.{$locale}")) {
                    if ($page->translate($locale)->rellax_image ?? null) {
                        Storage::disk('public')->delete($page->translate($locale)->rellax_image);
                        $page->translateOrNew($locale)->rellax_image = null;
                    }
                }
                
                // Info Image
                if ($request->hasFile("info_image.{$locale}")) {
                    // Удаляем старое изображение
                    if ($page->translate($locale)->info_image ?? null) {
                        Storage::disk('public')->delete($page->translate($locale)->info_image);
                    }
                    
                    $path = $request->file("info_image.{$locale}")->store('solution-images', 'public');
                    $page->translateOrNew($locale)->info_image = $path;
                } elseif ($request->input("delete_info_image.{$locale}")) {
                    if ($page->translate($locale)->info_image ?? null) {
                        Storage::disk('public')->delete($page->translate($locale)->info_image);
                        $page->translateOrNew($locale)->info_image = null;
                    }
                }
                
                // Rellax Mini Image
                if ($request->hasFile("rellax_mini_image.{$locale}")) {
                    // Удаляем старое изображение
                    if ($page->translate($locale)->rellax_mini_image ?? null) {
                        Storage::disk('public')->delete($page->translate($locale)->rellax_mini_image);
                    }
                    
                    $path = $request->file("rellax_mini_image.{$locale}")->store('solution-images', 'public');
                    $page->translateOrNew($locale)->rellax_mini_image = $path;
                } elseif ($request->input("delete_rellax_mini_image.{$locale}")) {
                    if ($page->translate($locale)->rellax_mini_image ?? null) {
                        Storage::disk('public')->delete($page->translate($locale)->rellax_mini_image);
                        $page->translateOrNew($locale)->rellax_mini_image = null;
                    }
                }
            }
            
            // Сохраняем контент в зависимости от типа страницы
            $content = [];
            
            if ($page->slug === 'home') {
                $content = $this->getHomePageContent($request, $locale);
            } elseif ($page->slug === 'about') {
                $content = $this->getAboutPageContent($request, $locale);
            } elseif ($page->slug === 'contact') {
                $content = $this->getContactPageContent($request, $locale);
            } elseif ($page->slug === 'solutions') {
                $content = [
                    'pick_use_case_title' => $request->input("content.{$locale}.pick_use_case_title"),
                    'solutions' => $request->input("content.{$locale}.solutions", [])
                ];
            } elseif ($page->type === 'solution') {
                $content = $this->getSolutionPageContent($request, $locale);
            } elseif ($page->type === 'legal') {
                // Для legal страниц сохраняем HTML контент
                $content = [
                    'main_content' => $request->input("content.{$locale}.main_content")
                ];
            } else {
                $content = $request->input("content.{$locale}", []);
            }
            
            $page->translateOrNew($locale)->content = $content;
        }
        
        $page->save();
        
        return redirect()->back()->with('success', 'Page updated successfully!');
    }
    
    private function getHomePageContent($request, $locale)
    {
        return [
            'future_proof' => [
                'title' => $request->input("content.{$locale}.future_proof.title")
            ],
            'help' => [
                'title' => $request->input("content.{$locale}.help.title"),
                'items' => $request->input("content.{$locale}.help.items", []),
                'tabs' => $request->input("content.{$locale}.help.tabs", [])
            ],
            'solutions_ad' => [
                'title' => $request->input("content.{$locale}.solutions_ad.title")
            ],
            'products' => [
                'title' => $request->input("content.{$locale}.products.title"),
                'items' => [] // Управляется через отдельную таблицу
            ],
            'partners' => [
                'subtitle' => $request->input("content.{$locale}.partners.subtitle"),
                'title' => $request->input("content.{$locale}.partners.title"),
                'drag_text' => $request->input("content.{$locale}.partners.drag_text"),
                'description_subtitle' => $request->input("content.{$locale}.partners.description_subtitle"),
                'description_text' => $request->input("content.{$locale}.partners.description_text"),
                'items' => [] // Управляется через отдельную таблицу
            ],
            'get_started' => [
                'title' => $request->input("content.{$locale}.get_started.title"),
                'button_text' => $request->input("content.{$locale}.get_started.button_text"),
                'subtitle' => $request->input("content.{$locale}.get_started.subtitle"),
                'text' => $request->input("content.{$locale}.get_started.text")
            ]
        ];
    }
    
    private function getSolutionPageContent($request, $locale)
    {
        $content = [
            'button_text' => $request->input("content.{$locale}.button_text"),
            'explore_text' => $request->input("content.{$locale}.explore_text"),
            'show_rellax' => $request->boolean("content.{$locale}.show_rellax"),
            'show_rellax_mini' => $request->boolean("content.{$locale}.show_rellax_mini"),
            'info' => [
                'title' => $request->input("content.{$locale}.info.title"),
                'link_text' => $request->input("content.{$locale}.info.link_text"),
                'content' => $request->input("content.{$locale}.info.content"),
            ],
            'deliver' => [
                'title' => $request->input("content.{$locale}.deliver.title"),
                'items' => []
            ],
            'get_started' => [
                'title' => $request->input("content.{$locale}.get_started.title"),
                'button_text' => $request->input("content.{$locale}.get_started.button_text"),
                'subtitle' => $request->input("content.{$locale}.get_started.subtitle"),
                'text' => $request->input("content.{$locale}.get_started.text")
            ]
        ];
        
        // Обработка элементов deliver с изображениями
        $deliverItems = $request->input("content.{$locale}.deliver.items", []);
        foreach ($deliverItems as $index => $item) {
            $itemData = [
                'subtitle' => $item['subtitle'] ?? '',
                'text' => $item['text'] ?? '',
            ];
            
            // Сохраняем существующее изображение
            $existingContent = $this->getExistingContent($request->route('page'), $locale);
            if (isset($existingContent['deliver']['items'][$index]['image'])) {
                $itemData['image'] = $existingContent['deliver']['items'][$index]['image'];
            }
            
            // Проверяем, нужно ли удалить изображение
            if ($request->input("content.{$locale}.deliver.items.{$index}.delete_image")) {
                if (isset($itemData['image'])) {
                    Storage::disk('public')->delete($itemData['image']);
                    unset($itemData['image']);
                }
            }
            
            // Загружаем новое изображение
            if ($request->hasFile("content.{$locale}.deliver.items.{$index}.image")) {
                // Удаляем старое изображение
                if (isset($itemData['image'])) {
                    Storage::disk('public')->delete($itemData['image']);
                }
                
                $path = $request->file("content.{$locale}.deliver.items.{$index}.image")->store('solution-items', 'public');
                $itemData['image'] = $path;
            }
            
            $content['deliver']['items'][] = $itemData;
        }
        
        return $content;
    }
    
    private function getExistingContent($page, $locale)
    {
        if ($page && $page->translate($locale)) {
            return $page->translate($locale)->content ?? [];
        }
        return [];
    }
    
    private function getAboutPageContent($request, $locale)
    {
        // Обработка параграфов для первой секции
        $infoParagraphs = $request->input("content.{$locale}.info.paragraphs");
        if (is_string($infoParagraphs)) {
            $infoParagraphs = array_filter(array_map('trim', explode("\n\n", $infoParagraphs)));
        }
        
        // Обработка параграфов для второй секции
        $info2Paragraphs = $request->input("content.{$locale}.info2.paragraphs");
        if (is_string($info2Paragraphs)) {
            $info2Paragraphs = array_filter(array_map('trim', explode("\n\n", $info2Paragraphs)));
        }
        
        return [
            'info' => [
                'title' => $request->input("content.{$locale}.info.title"),
                'paragraphs' => $infoParagraphs
            ],
            'info2' => [
                'title' => $request->input("content.{$locale}.info2.title"),
                'link_text' => $request->input("content.{$locale}.info2.link_text"),
                'paragraphs' => $info2Paragraphs
            ],
            'partners' => [
                'title' => $request->input("content.{$locale}.partners.title"),
                'categories' => $request->input("content.{$locale}.partners.categories", []),
                'info' => $request->input("content.{$locale}.partners.info", [])
            ],
            'get_started' => [
                'title' => $request->input("content.{$locale}.get_started.title"),
                'button_text' => $request->input("content.{$locale}.get_started.button_text"),
                'subtitle' => $request->input("content.{$locale}.get_started.subtitle"),
                'text' => $request->input("content.{$locale}.get_started.text")
            ]
        ];
    }
    
    private function getContactPageContent($request, $locale)
    {
        return [
            'contact_details' => [
                'title' => $request->input("content.{$locale}.contact_details.title"),
                'office_address' => $request->input("content.{$locale}.contact_details.office_address"),
                'registered_label' => $request->input("content.{$locale}.contact_details.registered_label"),
                'registered_address' => $request->input("content.{$locale}.contact_details.registered_address")
            ],
            'form_labels' => $request->input("content.{$locale}.form_labels", []),
            'site_types' => $request->input("content.{$locale}.site_types", [])
        ];
    }
}