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
            
            if ($page->slug === 'home') {
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
            'solutions' => $request->input("content.{$locale}.solutions", []),
            'help' => [
                'title' => $request->input("content.{$locale}.help.title"),
                'items' => $request->input("content.{$locale}.help.items", []),
                'tabs' => [
                    ['key' => 'expertise', 'title' => 'Expertise'],
                    ['key' => 'guidance', 'title' => 'Guidance'],
                    ['key' => 'support', 'title' => 'Support']
                ]
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
                'description_subtitle' => $request->input("content.{$locale}.partners.description_subtitle"),
                'description_text' => $request->input("content.{$locale}.partners.description_text"),
                'items' => [] // Управляется через отдельную таблицу
            ],
            'get_started' => [
                'title' => $request->input("content.{$locale}.get_started.title"),
                'subtitle' => $request->input("content.{$locale}.get_started.subtitle"),
                'text' => $request->input("content.{$locale}.get_started.text")
            ]
        ];
    }
    
    private function getSolutionPageContent($request, $locale)
    {
        return [
            'description' => $request->input("content.{$locale}.description"),
            'features' => $request->input("content.{$locale}.features", []),
            'benefits' => $request->input("content.{$locale}.benefits", [])
        ];
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
            'team' => [
                'title' => $request->input("content.{$locale}.team.title"),
                'categories' => [
                    ['key' => 'leadership', 'title' => 'Leadership Team'],
                    ['key' => 'customer-services', 'title' => 'Customer Services'],
                    ['key' => 'sales-marketing', 'title' => 'Sales & Marketing'],
                    ['key' => 'installations', 'title' => 'Installations'],
                    ['key' => 'central-services', 'title' => 'Central Services']
                ]
            ],
            'partners' => [
                'title' => $request->input("content.{$locale}.partners.title"),
                'categories' => [
                    ['key' => 'partners', 'title' => 'Partners'],
                    ['key' => 'charity', 'title' => 'Charity'],
                    ['key' => 'hardware', 'title' => 'Hardware']
                ]
            ],
            'get_started' => [
                'title' => $request->input("content.{$locale}.get_started.title"),
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
            ]
        ];
    }
}