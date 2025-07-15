<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

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
                    'pick_use_case_title' => $request->input("content.{$locale}.pick_use_case_title")
                ];
            } elseif ($page->type === 'solution') {
                $content = $this->getSolutionPageContent($request, $locale);
            } else {
                $content = $request->input("content.{$locale}", []);
            }
            
            $page->translateOrNew($locale)->content = $content;
        }
        
        $page->save();
        
        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully!');
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
                'show_image' => $request->boolean("content.{$locale}.info.show_image")
            ],
            'deliver' => [
                'title' => $request->input("content.{$locale}.deliver.title"),
                'show_numbers' => $request->boolean("content.{$locale}.deliver.show_numbers"),
                'items' => $request->input("content.{$locale}.deliver.items", [])
            ],
            'benefits' => [
                'title' => $request->input("content.{$locale}.benefits.title"),
                'items' => $request->input("content.{$locale}.benefits.items", [])
            ],
            'products' => [
                'subtitle' => $request->input("content.{$locale}.products.subtitle"),
                'title' => $request->input("content.{$locale}.products.title")
            ],
            'faq' => [
                'title' => $request->input("content.{$locale}.faq.title"),
                'subtitle' => $request->input("content.{$locale}.faq.subtitle"),
                'items' => $request->input("content.{$locale}.faq.items", [])
            ],
            'get_started' => [
                'title' => $request->input("content.{$locale}.get_started.title"),
                'button_text' => $request->input("content.{$locale}.get_started.button_text"),
                'subtitle' => $request->input("content.{$locale}.get_started.subtitle"),
                'text' => $request->input("content.{$locale}.get_started.text")
            ]
        ];
        
        return $content;
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