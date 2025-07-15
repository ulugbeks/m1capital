<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Page;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        // Проверяем, есть ли уже продукты
        if (Product::count() > 0) {
            return;
        }

        $products = [
            [
                'key' => 'zaptec_go',
                'order' => 1,
                'en' => [
                    'title' => 'Zaptec Go',
                    'subtitle' => 'Up to 7.4kW charging speed',
                    'description' => 'Using leading technology, this award-winning charger is as smart on the inside as it is simple on the outside. It\'s Wi-Fi compatible, highly intuitive and available in a choice of six stylish colours',
                    'manufacturers_standard' => '5-year',
                    'features' => ['Up to 7.4kW charging speed', '4G LTE-M or Wi-Fi connectivity'],
                    'applications' => ['Holiday parks']
                ],
                'lv' => [
                    'title' => 'Zaptec Go',
                    'subtitle' => 'Līdz 7.4kW uzlādes ātrums',
                    'description' => 'Izmantojot vadošo tehnoloģiju, šis apbalvotais lādētājs ir tikpat gudrs iekšpusē, cik vienkāršs ārpusē. Tas ir Wi-Fi saderīgs, ļoti intuitīvs un pieejams sešās stilīgās krāsās',
                    'manufacturers_standard' => '5 gadi',
                    'features' => ['Līdz 7.4kW uzlādes ātrums', '4G LTE-M vai Wi-Fi savienojamība'],
                    'applications' => ['Brīvdienu parki']
                ]
            ],
            [
                'key' => 'eo_mini_pro_3',
                'order' => 2,
                'en' => [
                    'title' => 'EO Mini Pro 3',
                    'subtitle' => 'Up to 7.4kW charging speed',
                    'description' => 'Compact and stylish in design, this robust device has built-in functionality to allow for load management and solar connectivity. Its simple mobile app is straightforward to use, making charging easy and stress-free.',
                    'manufacturers_standard' => '3-year',
                    'features' => ['Up to 7.4kW charging speed', 'Ethernet, 4G or Wi-Fi connectivity', 'Power balancing capability built in', 'Solar compatible'],
                    'applications' => ['Holiday parks']
                ],
                'lv' => [
                    'title' => 'EO Mini Pro 3',
                    'subtitle' => 'Līdz 7.4kW uzlādes ātrums',
                    'description' => 'Kompakts un stilīgs dizains, šai robustajai ierīcei ir iebūvēta funkcionalitāte, kas ļauj veikt slodzes pārvaldību un saules enerģijas savienojamību.',
                    'manufacturers_standard' => '3 gadi',
                    'features' => ['Līdz 7.4kW uzlādes ātrums', 'Ethernet, 4G vai Wi-Fi savienojamība', 'Iebūvēta jaudas līdzsvarošana', 'Saules enerģijas saderīgs'],
                    'applications' => ['Brīvdienu parki']
                ]
            ],
            [
                'key' => 'zaptec_pro',
                'order' => 3,
                'en' => [
                    'title' => 'Zaptec Pro',
                    'subtitle' => 'Up to 22kW charging speed',
                    'description' => 'With this device, you can create a charging network of multiple charge points off one electrical circuit. With integrated sensors continuously monitoring electricity consumption, it provides a seamless distribution of power among all vehicles, without overloading the facility.',
                    'manufacturers_standard' => '5-year',
                    'features' => [
                        'Up to 22kW charging speed',
                        '4G LTE-M, Wi-Fi or Power Line Communication connectivity',
                        'Dynamic phase allocation',
                        'Dynamic load balancing'
                    ],
                    'applications' => ['Apartment buildings', 'Workplaces']
                ],
                'lv' => [
                    'title' => 'Zaptec Pro',
                    'subtitle' => 'Līdz 22kW uzlādes ātrums',
                    'description' => 'Ar šo ierīci jūs varat izveidot uzlādes tīklu ar vairākiem uzlādes punktiem no vienas elektriskās ķēdes.',
                    'manufacturers_standard' => '5 gadi',
                    'features' => [
                        'Līdz 22kW uzlādes ātrums',
                        '4G LTE-M, Wi-Fi vai Power Line Communication savienojamība',
                        'Dinamiska fāžu piešķiršana',
                        'Dinamiska slodzes līdzsvarošana'
                    ],
                    'applications' => ['Daudzdzīvokļu mājas', 'Darba vietas']
                ]
            ],
            [
                'key' => 'easee_charge',
                'order' => 4,
                'en' => [
                    'title' => 'Easee Charge',
                    'subtitle' => 'Up to 22kW charging speed',
                    'description' => 'This commercial model retains the sleek and compact look of the home model. Loved by installers for its easy-to-install approach, it\'s simple and quick to setup and commission.',
                    'manufacturers_standard' => '3-year',
                    'features' => [
                        'Up to 22kW charging speed',
                        '4G LTE-M or Wi-Fi connectivity',
                        'Scalable system'
                    ],
                    'applications' => ['Apartment buildings', 'Workplaces']
                ],
                'lv' => [
                    'title' => 'Easee Charge',
                    'subtitle' => 'Līdz 22kW uzlādes ātrums',
                    'description' => 'Šis komerciālais modelis saglabā mājas modeļa eleganto un kompakto izskatu.',
                    'manufacturers_standard' => '3 gadi',
                    'features' => [
                        'Līdz 22kW uzlādes ātrums',
                        '4G LTE-M vai Wi-Fi savienojamība',
                        'Mērogojama sistēma'
                    ],
                    'applications' => ['Daudzdzīvokļu mājas', 'Darba vietas']
                ]
            ]
        ];

        foreach ($products as $productData) {
            $product = Product::create([
                'key' => $productData['key'],
                'order' => $productData['order'],
                'is_active' => true
            ]);

            foreach (['en', 'lv'] as $locale) {
                $product->translateOrNew($locale)->title = $productData[$locale]['title'];
                $product->translateOrNew($locale)->subtitle = $productData[$locale]['subtitle'];
                $product->translateOrNew($locale)->description = $productData[$locale]['description'];
                $product->translateOrNew($locale)->manufacturers_standard = $productData[$locale]['manufacturers_standard'];
                $product->translateOrNew($locale)->features = $productData[$locale]['features'];
                $product->translateOrNew($locale)->applications = $productData[$locale]['applications'];
            }

            $product->save();

            // Привязываем к главной странице
            $homePage = Page::where('slug', 'home')->first();
            if ($homePage) {
                $product->pages()->attach($homePage->id);
            }

            // Привязываем к странице решений в зависимости от applications
            foreach ($productData['en']['applications'] as $application) {
                $slug = match($application) {
                    'Holiday parks' => 'holiday-parks',
                    'Apartment buildings' => 'apartment-buildings',
                    'Workplaces' => 'workplace',
                    'Hotels' => 'hotels',
                    default => null
                };

                if ($slug) {
                    $page = Page::where('slug', $slug)->first();
                    if ($page) {
                        $product->pages()->attach($page->id);
                    }
                }
            }
        }
    }
}