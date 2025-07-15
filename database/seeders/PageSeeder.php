<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Setting;

class PageSeeder extends Seeder
{
    public function run()
    {
        // Проверяем, есть ли уже страницы
        if (Page::count() > 0) {
            return; // Если страницы уже есть, не создаем дубликаты
        }
        
        // Создаем главную страницу
        $homePage = Page::create([
            'slug' => 'home',
            'type' => 'static',
            'is_active' => true,
            'order' => 1
        ]);

        // Английский перевод
        $homePage->translateOrNew('en')->title = 'Home';
        $homePage->translateOrNew('en')->meta_title = 'Energy Park - EV Charging Solutions';
        $homePage->translateOrNew('en')->meta_description = 'Energy Park provides tailored EV charging solutions for apartment buildings, hotels, holiday parks and workplaces.';
        $homePage->translateOrNew('en')->hero_title = 'Get set for an electric future';
        $homePage->translateOrNew('en')->hero_subtitle = 'Powering peace of mind through tailored EV charging solutions.';
        $homePage->translateOrNew('en')->content = [
            'future_proof' => [
                'title' => 'Future-proof your residential site or business with our scalable EV charging solutions'
            ],
            'solutions' => [
                ['title' => 'Apartment buildings', 'slug' => 'apartment-buildings'],
                ['title' => 'Holiday parks', 'slug' => 'holiday-parks'],
                ['title' => 'Hotels', 'slug' => 'hotels'],
                ['title' => 'Workplace', 'slug' => 'workplace']
            ],
            'help' => [
                'title' => 'How we can help',
                'items' => [
                    [
                        'number' => '01',
                        'title' => 'Leaders in residential EV charging solutions',
                        'description' => 'Backed by the UK Government\'s Charging Infrastructure Investment Fund (CIIF), Energy Park brings you a team of highly trained professionals.',
                        'tab_key' => 'expertise'
                    ],
                    [
                        'number' => '02',
                        'title' => 'A consultative approach',
                        'description' => 'We work closely with you throughout the design and installation process to ensure the infrastructure meets your unique requirements.',
                        'tab_key' => 'guidance'
                    ],
                    [
                        'number' => '03',
                        'title' => 'Ongoing management and maintenance',
                        'description' => 'We can take care of all ongoing operations, including maintenance and customer service, so there\'s no need for your day-to-day involvement.',
                        'tab_key' => 'support'
                    ]
                ],
                'tabs' => [
                    ['key' => 'expertise', 'title' => 'Expertise'],
                    ['key' => 'guidance', 'title' => 'Guidance'],
                    ['key' => 'support', 'title' => 'Support']
                ]
            ],
            'solutions_ad' => [
                'title' => 'Smart EV charging solutions <br> for residential sites and business'
            ],
            'products' => [
                'title' => 'We offer a range of charge points to choose from.',
                'items' => [] // Будут добавлены через отдельную таблицу
            ],
            'partners' => [
                'subtitle' => 'We partner with the best.',
                'title' => 'Working with leading <br> equipment manufacturers <br> gives us access to a wide <br> range of hardware solutions.',
                'description_subtitle' => 'EV charging solutions for residential sites and businesses',
                'description_text' => 'We work with a select group of leading equipment manufacturers, so we have access to a wide range of hardware solutions. This means we can always find the best fit for your project.',
                'items' => [] // Будут добавлены через отдельную таблицу
            ],
            'get_started' => [
                'title' => 'Ready to get <br> started?',
                'subtitle' => 'EV charging solutions for residential sites and businesses.',
                'text' => 'We\'ll listen to your needs, identify the best approach, and then <br> create a bespoke smart EV charging solution that\'s right for you.'
            ]
        ];

        // Латышский перевод
        $homePage->translateOrNew('lv')->title = 'Sākums';
        $homePage->translateOrNew('lv')->meta_title = 'Energy Park - EV uzlādes risinājumi';
        $homePage->translateOrNew('lv')->meta_description = 'Energy Park nodrošina pielāgotus EV uzlādes risinājumus daudzdzīvokļu mājām, viesnīcām, brīvdienu parkiem un darba vietām.';
        $homePage->translateOrNew('lv')->hero_title = 'Sagatavojieties elektriskajam nākotnes';
        $homePage->translateOrNew('lv')->hero_subtitle = 'Nodrošinām mieru ar pielāgotiem EV uzlādes risinājumiem.';
        $homePage->translateOrNew('lv')->content = [
            'future_proof' => [
                'title' => 'Padariet savu dzīvojamo objektu vai biznesu gatavu nākotnei ar mūsu mērogojamiem EV uzlādes risinājumiem'
            ],
            'solutions' => [
                ['title' => 'Daudzdzīvokļu mājas', 'slug' => 'apartment-buildings'],
                ['title' => 'Brīvdienu parki', 'slug' => 'holiday-parks'],
                ['title' => 'Viesnīcas', 'slug' => 'hotels'],
                ['title' => 'Darba vietas', 'slug' => 'workplace']
            ],
            'help' => [
                'title' => 'Kā mēs varam palīdzēt',
                'items' => [
                    [
                        'number' => '01',
                        'title' => 'Līderi dzīvojamo ēku EV uzlādes risinājumos',
                        'description' => 'Ar Apvienotās Karalistes valdības Uzlādes infrastruktūras investīciju fonda (CIIF) atbalstu, Energy Park piedāvā augsti kvalificētu profesionāļu komandu.',
                        'tab_key' => 'expertise'
                    ],
                    [
                        'number' => '02',
                        'title' => 'Konsultatīva pieeja',
                        'description' => 'Mēs cieši sadarbojamies ar jums visa projektēšanas un uzstādīšanas procesa laikā, lai nodrošinātu, ka infrastruktūra atbilst jūsu unikālajām prasībām.',
                        'tab_key' => 'guidance'
                    ],
                    [
                        'number' => '03',
                        'title' => 'Pastāvīga pārvaldība un apkope',
                        'description' => 'Mēs varam rūpēties par visām ikdienas darbībām, tostarp apkopi un klientu apkalpošanu, tāpēc jums nav jāiesaistās ikdienas darbībās.',
                        'tab_key' => 'support'
                    ]
                ],
                'tabs' => [
                    ['key' => 'expertise', 'title' => 'Ekspertīze'],
                    ['key' => 'guidance', 'title' => 'Vadība'],
                    ['key' => 'support', 'title' => 'Atbalsts']
                ]
            ],
            'solutions_ad' => [
                'title' => 'Viedās EV uzlādes risinājumi <br> dzīvojamiem objektiem un uzņēmumiem'
            ],
            'products' => [
                'title' => 'Mēs piedāvājam plašu uzlādes punktu klāstu.'
            ],
            'partners' => [
                'subtitle' => 'Mēs sadarbojamies ar labākajiem.',
                'title' => 'Sadarbība ar vadošajiem <br> iekārtu ražotājiem <br> nodrošina mums piekļuvi plašam <br> aparatūras risinājumu klāstam.',
                'description_subtitle' => 'EV uzlādes risinājumi dzīvojamiem objektiem un uzņēmumiem',
                'description_text' => 'Mēs sadarbojamies ar atlasītu vadošo iekārtu ražotāju grupu, tāpēc mums ir pieeja plašam aparatūras risinājumu klāstam. Tas nozīmē, ka mēs vienmēr varam atrast labāko risinājumu jūsu projektam.'
            ],
            'get_started' => [
                'title' => 'Gatavi sākt?',
                'subtitle' => 'EV uzlādes risinājumi dzīvojamiem objektiem un uzņēmumiem.',
                'text' => 'Mēs uzklausīsim jūsu vajadzības, identificēsim labāko pieeju un pēc tam <br> izveidosim pielāgotu viedo EV uzlādes risinājumu, kas ir piemērots tieši jums.'
            ]
        ];

        $homePage->save();

        // Создаем страницы решений (обновленные типы)
        $solutionTypes = [
            [
                'slug' => 'energy-storage',
                'order' => 1,
                'en' => [
                    'title' => 'Energy Storage',
                    'hero_title' => 'Energy storage solutions',
                    'hero_subtitle' => 'Optimize your energy usage with our advanced storage solutions.'
                ],
                'lv' => [
                    'title' => 'Enerģijas uzglabāšana',
                    'hero_title' => 'Enerģijas uzglabāšanas risinājumi',
                    'hero_subtitle' => 'Optimizējiet savu enerģijas patēriņu ar mūsu progresīvajiem uzglabāšanas risinājumiem.'
                ]
            ],
            [
                'slug' => 'energy-trading',
                'order' => 2,
                'en' => [
                    'title' => 'Energy Trading',
                    'hero_title' => 'Energy trading solutions',
                    'hero_subtitle' => 'Maximize your energy value through intelligent trading systems.'
                ],
                'lv' => [
                    'title' => 'Enerģijas tirdzniecība',
                    'hero_title' => 'Enerģijas tirdzniecības risinājumi',
                    'hero_subtitle' => 'Maksimizējiet savu enerģijas vērtību ar inteliģentām tirdzniecības sistēmām.'
                ]
            ],
            [
                'slug' => 'fcr',
                'order' => 3,
                'en' => [
                    'title' => 'FCR',
                    'hero_title' => 'Frequency Containment Reserve',
                    'hero_subtitle' => 'Provide grid stability services with our FCR solutions.'
                ],
                'lv' => [
                    'title' => 'FCR',
                    'hero_title' => 'Frekvences ierobežošanas rezerve',
                    'hero_subtitle' => 'Nodrošiniet tīkla stabilitātes pakalpojumus ar mūsu FCR risinājumiem.'
                ]
            ],
            [
                'slug' => 'mfrr',
                'order' => 4,
                'en' => [
                    'title' => 'mFRR',
                    'hero_title' => 'Manual Frequency Restoration Reserve',
                    'hero_subtitle' => 'Participate in manual frequency restoration with our mFRR solutions.'
                ],
                'lv' => [
                    'title' => 'mFRR',
                    'hero_title' => 'Manuālā frekvences atjaunošanas rezerve',
                    'hero_subtitle' => 'Piedalieties manuālajā frekvences atjaunošanā ar mūsu mFRR risinājumiem.'
                ]
            ],
            [
                'slug' => 'afrr',
                'order' => 5,
                'en' => [
                    'title' => 'aFRR',
                    'hero_title' => 'Automatic Frequency Restoration Reserve',
                    'hero_subtitle' => 'Enable automatic frequency restoration with our aFRR technology.'
                ],
                'lv' => [
                    'title' => 'aFRR',
                    'hero_title' => 'Automātiskā frekvences atjaunošanas rezerve',
                    'hero_subtitle' => 'Iespējojiet automātisko frekvences atjaunošanu ar mūsu aFRR tehnoloģiju.'
                ]
            ]
        ];

        foreach ($solutionTypes as $solution) {
            $page = Page::create([
                'slug' => $solution['slug'],
                'type' => 'solution',
                'is_active' => true,
                'order' => $solution['order']
            ]);

            $page->translateOrNew('en')->title = $solution['en']['title'];
            $page->translateOrNew('en')->hero_title = $solution['en']['hero_title'];
            $page->translateOrNew('en')->hero_subtitle = $solution['en']['hero_subtitle'];
            
            $page->translateOrNew('lv')->title = $solution['lv']['title'];
            $page->translateOrNew('lv')->hero_title = $solution['lv']['hero_title'];
            $page->translateOrNew('lv')->hero_subtitle = $solution['lv']['hero_subtitle'];
            
            $page->save();
        }

        // Создаем другие страницы
        $pages = [
            [
                'slug' => 'about', 
                'en' => [
                    'title' => 'About Us',
                    'hero_title' => 'Facilitating fairer, more accessible EV charging',
                    'hero_subtitle' => 'Powering peace of mind through tailored EV charging solutions.'
                ],
                'lv' => [
                    'title' => 'Par mums',
                    'hero_title' => 'Veicinām taisnīgāku, pieejamāku EV uzlādi',
                    'hero_subtitle' => 'Nodrošinām mieru ar pielāgotiem EV uzlādes risinājumiem.'
                ]
            ],
            [
                'slug' => 'solutions', 
                'en' => [
                    'title' => 'Solutions',
                    'hero_title' => 'Charging solutions',
                    'hero_subtitle' => ''
                ],
                'lv' => [
                    'title' => 'Risinājumi',
                    'hero_title' => 'Uzlādes risinājumi',
                    'hero_subtitle' => ''
                ]
            ],
            [
                'slug' => 'news',
                'en' => [
                    'title' => 'News',
                    'hero_title' => 'Latest news',
                    'hero_subtitle' => 'All the latest news and articles from Energy Park.'
                ],
                'lv' => [
                    'title' => 'Jaunumi',
                    'hero_title' => 'Jaunākie jaunumi',
                    'hero_subtitle' => 'Visi jaunākie jaunumi un raksti no Energy Park.'
                ]
            ],
            [
                'slug' => 'contact',
                'en' => [
                    'title' => 'Contact',
                    'hero_title' => 'Get in touch',
                    'hero_subtitle' => ''
                ],
                'lv' => [
                    'title' => 'Kontakti',
                    'hero_title' => 'Sazinieties ar mums',
                    'hero_subtitle' => ''
                ]
            ],
            [
                'slug' => 'how-we-work',
                'en' => [
                    'title' => 'How We Work',
                    'hero_title' => 'How we find the best solution for you',
                    'hero_subtitle' => ''
                ],
                'lv' => [
                    'title' => 'Kā mēs strādājam',
                    'hero_title' => 'Kā mēs atrodam labāko risinājumu jums',
                    'hero_subtitle' => ''
                ]
            ]
        ];

        foreach ($pages as $index => $pageData) {
            $page = Page::create([
                'slug' => $pageData['slug'],
                'type' => 'static',
                'is_active' => true,
                'order' => $index + 10
            ]);

            $page->translateOrNew('en')->title = $pageData['en']['title'];
            $page->translateOrNew('en')->hero_title = $pageData['en']['hero_title'] ?? '';
            $page->translateOrNew('en')->hero_subtitle = $pageData['en']['hero_subtitle'] ?? '';
            
            $page->translateOrNew('lv')->title = $pageData['lv']['title'];
            $page->translateOrNew('lv')->hero_title = $pageData['lv']['hero_title'] ?? '';
            $page->translateOrNew('lv')->hero_subtitle = $pageData['lv']['hero_subtitle'] ?? '';
            
            $page->save();
        }
    }
}