<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Page;

return new class extends Migration
{
    public function up()
    {
        // Обновляем существующие страницы решений с полным контентом
        $solutions = [
            'energy-storage' => [
                'en' => [
                    'content' => [
                        'button_text' => 'Contact us',
                        'explore_text' => 'Explore',
                        'show_rellax' => true,
                        'show_rellax_mini' => false,
                        'info' => [
                            'title' => 'Advanced Energy Storage Solutions',
                            'link_text' => 'Ready to get started? Contact us',
                            'content' => '<p class="section-subtitle">Maximize your energy efficiency</p>
                            <p class="section-text">Our cutting-edge energy storage solutions help you store excess energy during low-demand periods and use it when needed most. This not only reduces your energy costs but also provides backup power during outages.</p>
                            <p class="section-subtitle">Smart integration</p>
                            <p class="section-text">Our systems seamlessly integrate with your existing infrastructure and renewable energy sources, providing intelligent energy management that adapts to your usage patterns.</p>',
                            'show_image' => true
                        ],
                        'deliver' => [
                            'title' => 'What our energy storage solutions deliver:',
                            'show_numbers' => true,
                            'items' => [
                                ['subtitle' => 'Cost reduction', 'text' => 'Store energy during off-peak hours for use during peak pricing'],
                                ['subtitle' => 'Energy independence', 'text' => 'Reduce reliance on the grid with stored renewable energy'],
                                ['subtitle' => 'Backup power', 'text' => 'Maintain operations during power outages'],
                                ['subtitle' => 'Grid services', 'text' => 'Participate in demand response programs'],
                                ['subtitle' => 'Scalability', 'text' => 'Modular design allows for easy expansion'],
                                ['subtitle' => 'Smart monitoring', 'text' => 'Real-time analytics and remote management']
                            ]
                        ],
                        'products' => [
                            'subtitle' => 'Our storage solutions',
                            'title' => 'We offer a range of battery storage systems to meet your needs.'
                        ],
                        'faq' => [
                            'title' => 'Energy storage<br>questions?',
                            'subtitle' => 'Frequently asked questions',
                            'items' => [
                                [
                                    'question' => 'What types of batteries do you use?',
                                    'answer' => 'We primarily use lithium-ion batteries for their efficiency, longevity, and safety features. We can also provide other battery technologies based on specific requirements.'
                                ],
                                [
                                    'question' => 'How long do the batteries last?',
                                    'answer' => 'Our battery systems typically have a lifespan of 10-15 years with proper maintenance, backed by comprehensive warranties.'
                                ],
                                [
                                    'question' => 'Can I expand my system later?',
                                    'answer' => 'Yes, our modular design allows for easy expansion as your energy needs grow.'
                                ],
                                [
                                    'question' => 'What maintenance is required?',
                                    'answer' => 'Our systems require minimal maintenance - mainly periodic inspections and software updates, which we handle remotely.'
                                ],
                                [
                                    'question' => 'How quickly can the system respond?',
                                    'answer' => 'Our systems can switch from charge to discharge mode in milliseconds, ensuring seamless power delivery.'
                                ],
                                [
                                    'question' => 'Is it safe?',
                                    'answer' => 'Safety is our top priority. All systems include multiple safety features including thermal management, fire suppression, and remote monitoring.'
                                ]
                            ]
                        ],
                        'get_started' => [
                            'title' => 'Ready to store<br>smarter?',
                            'button_text' => 'Contact us',
                            'subtitle' => 'Advanced energy storage solutions for businesses.',
                            'text' => 'Let us design a custom energy storage solution that meets your specific needs and helps you achieve energy independence.'
                        ]
                    ]
                ],
                'lv' => [
                    'content' => [
                        'button_text' => 'Sazinieties ar mums',
                        'explore_text' => 'Uzzināt vairāk',
                        'show_rellax' => true,
                        'show_rellax_mini' => false,
                        'info' => [
                            'title' => 'Progresīvi enerģijas uzglabāšanas risinājumi',
                            'link_text' => 'Gatavi sākt? Sazinieties ar mums',
                            'content' => '<p class="section-subtitle">Maksimizējiet savu enerģijas efektivitāti</p>
                            <p class="section-text">Mūsu modernākie enerģijas uzglabāšanas risinājumi palīdz jums uzglabāt lieko enerģiju zema pieprasījuma periodos un izmantot to, kad tas visvairāk nepieciešams.</p>',
                            'show_image' => true
                        ],
                        'deliver' => [
                            'title' => 'Ko sniedz mūsu enerģijas uzglabāšanas risinājumi:',
                            'show_numbers' => true,
                            'items' => [
                                ['subtitle' => 'Izmaksu samazināšana', 'text' => 'Uzglabājiet enerģiju ārpus pīķa stundās'],
                                ['subtitle' => 'Enerģijas neatkarība', 'text' => 'Samaziniet atkarību no tīkla'],
                                ['subtitle' => 'Rezerves barošana', 'text' => 'Uzturiet darbību strāvas padeves pārtraukumu laikā'],
                                ['subtitle' => 'Tīkla pakalpojumi', 'text' => 'Piedalieties pieprasījuma reakcijas programmās'],
                                ['subtitle' => 'Mērogojamība', 'text' => 'Modulārs dizains ļauj viegli paplašināt'],
                                ['subtitle' => 'Vieda uzraudzība', 'text' => 'Reāllaika analītika un attālināta pārvaldība']
                            ]
                        ],
                        'products' => [
                            'subtitle' => 'Mūsu uzglabāšanas risinājumi',
                            'title' => 'Mēs piedāvājam plašu akumulatoru uzglabāšanas sistēmu klāstu.'
                        ],
                        'faq' => [
                            'title' => 'Jautājumi par<br>enerģijas uzglabāšanu?',
                            'subtitle' => 'Bieži uzdotie jautājumi',
                            'items' => [
                                [
                                    'question' => 'Kāda veida akumulatorus jūs izmantojat?',
                                    'answer' => 'Mēs galvenokārt izmantojam litija jonu akumulatorus to efektivitātes, ilgmūžības un drošības funkciju dēļ.'
                                ],
                                [
                                    'question' => 'Cik ilgi kalpo akumulatori?',
                                    'answer' => 'Mūsu akumulatoru sistēmu kalpošanas laiks parasti ir 10-15 gadi ar pareizu apkopi.'
                                ],
                                [
                                    'question' => 'Vai es varu paplašināt savu sistēmu vēlāk?',
                                    'answer' => 'Jā, mūsu modulārais dizains ļauj viegli paplašināt, kad pieaug jūsu enerģijas vajadzības.'
                                ],
                                [
                                    'question' => 'Kāda apkope ir nepieciešama?',
                                    'answer' => 'Mūsu sistēmām nepieciešama minimāla apkope - galvenokārt periodiskas pārbaudes un programmatūras atjauninājumi.'
                                ],
                                [
                                    'question' => 'Cik ātri sistēma var reaģēt?',
                                    'answer' => 'Mūsu sistēmas var pārslēgties no uzlādes uz izlādes režīmu milisekundēs.'
                                ],
                                [
                                    'question' => 'Vai tas ir droši?',
                                    'answer' => 'Drošība ir mūsu galvenā prioritāte. Visas sistēmas ietver vairākas drošības funkcijas.'
                                ]
                            ]
                        ],
                        'get_started' => [
                            'title' => 'Gatavi uzglabāt<br>gudrāk?',
                            'button_text' => 'Sazinieties ar mums',
                            'subtitle' => 'Progresīvi enerģijas uzglabāšanas risinājumi uzņēmumiem.',
                            'text' => 'Ļaujiet mums izveidot pielāgotu enerģijas uzglabāšanas risinājumu, kas atbilst jūsu īpašajām vajadzībām.'
                        ]
                    ]
                ]
            ],
            'energy-trading' => [
                'en' => [
                    'content' => [
                        'button_text' => 'Contact us',
                        'explore_text' => 'Explore',
                        'show_rellax' => true,
                        'show_rellax_mini' => false,
                        'info' => [
                            'title' => 'Smart Energy Trading Platform',
                            'link_text' => 'Start trading today',
                            'content' => '<p class="section-subtitle">Optimize your energy value</p>
                            <p class="section-text">Our advanced energy trading platform enables you to buy and sell energy at optimal prices, maximizing the value of your renewable generation and storage assets.</p>
                            <p class="section-subtitle">AI-powered trading</p>
                            <p class="section-text">Using sophisticated algorithms and real-time market data, our platform automatically executes trades to ensure you get the best prices while maintaining grid stability.</p>',
                            'show_image' => true
                        ],
                        'deliver' => [
                            'title' => 'Benefits of our energy trading platform:',
                            'show_numbers' => true,
                            'items' => [
                                ['subtitle' => 'Revenue optimization', 'text' => 'Maximize income from your energy assets'],
                                ['subtitle' => 'Automated trading', 'text' => 'AI-driven decisions execute trades 24/7'],
                                ['subtitle' => 'Market access', 'text' => 'Connect to multiple energy markets'],
                                ['subtitle' => 'Risk management', 'text' => 'Built-in safeguards protect your investments'],
                                ['subtitle' => 'Real-time analytics', 'text' => 'Monitor performance and market conditions'],
                                ['subtitle' => 'Regulatory compliance', 'text' => 'Fully compliant with market regulations']
                            ]
                        ],
                        'products' => [
                            'subtitle' => 'Trading solutions',
                            'title' => 'Comprehensive platform for all your energy trading needs.'
                        ],
                        'faq' => [
                            'title' => 'Energy trading<br>questions?',
                            'subtitle' => 'Common queries answered',
                            'items' => [
                                [
                                    'question' => 'Do I need trading experience?',
                                    'answer' => 'No, our platform handles all trading automatically based on your preferences and market conditions.'
                                ],
                                [
                                    'question' => 'Which markets can I access?',
                                    'answer' => 'We provide access to day-ahead, intraday, and balancing markets across multiple regions.'
                                ],
                                [
                                    'question' => 'How are trades executed?',
                                    'answer' => 'Our AI algorithms analyze market conditions and execute trades automatically to maximize your returns.'
                                ],
                                [
                                    'question' => 'What about market risks?',
                                    'answer' => 'We have comprehensive risk management tools including price limits, volume controls, and hedging strategies.'
                                ],
                                [
                                    'question' => 'Can I set my own parameters?',
                                    'answer' => 'Yes, you can define your trading preferences, risk tolerance, and price thresholds.'
                                ],
                                [
                                    'question' => 'How do I track performance?',
                                    'answer' => 'Our dashboard provides real-time analytics, historical performance data, and detailed reporting.'
                                ]
                            ]
                        ],
                        'get_started' => [
                            'title' => 'Ready to trade<br>smarter?',
                            'button_text' => 'Get started',
                            'subtitle' => 'Intelligent energy trading for the modern grid.',
                            'text' => 'Join the energy trading revolution and unlock the full value of your energy assets.'
                        ]
                    ]
                ],
                'lv' => [
                    'content' => [
                        'button_text' => 'Sazinieties ar mums',
                        'explore_text' => 'Uzzināt vairāk',
                        'show_rellax' => true,
                        'show_rellax_mini' => false,
                        'info' => [
                            'title' => 'Vieda enerģijas tirdzniecības platforma',
                            'link_text' => 'Sāciet tirgot šodien',
                            'content' => '<p class="section-subtitle">Optimizējiet savu enerģijas vērtību</p>
                            <p class="section-text">Mūsu progresīvā enerģijas tirdzniecības platforma ļauj jums pirkt un pārdot enerģiju par optimālām cenām.</p>',
                            'show_image' => true
                        ],
                        'deliver' => [
                            'title' => 'Mūsu enerģijas tirdzniecības platformas priekšrocības:',
                            'show_numbers' => true,
                            'items' => [
                                ['subtitle' => 'Ieņēmumu optimizācija', 'text' => 'Maksimizējiet ienākumus no enerģijas aktīviem'],
                                ['subtitle' => 'Automatizēta tirdzniecība', 'text' => 'AI vadīti lēmumi veic darījumus 24/7'],
                                ['subtitle' => 'Tirgus pieeja', 'text' => 'Savienojieties ar vairākiem enerģijas tirgiem'],
                                ['subtitle' => 'Riska pārvaldība', 'text' => 'Iebūvēti drošības pasākumi aizsargā jūsu ieguldījumus'],
                                ['subtitle' => 'Reāllaika analītika', 'text' => 'Uzraugiet veiktspēju un tirgus apstākļus'],
                                ['subtitle' => 'Normatīvā atbilstība', 'text' => 'Pilnībā atbilst tirgus noteikumiem']
                            ]
                        ],
                        'products' => [
                            'subtitle' => 'Tirdzniecības risinājumi',
                            'title' => 'Visaptveroša platforma visām jūsu enerģijas tirdzniecības vajadzībām.'
                        ],
                        'faq' => [
                            'title' => 'Jautājumi par<br>enerģijas tirdzniecību?',
                            'subtitle' => 'Atbildes uz biežākajiem jautājumiem',
                            'items' => [
                                [
                                    'question' => 'Vai man nepieciešama tirdzniecības pieredze?',
                                    'answer' => 'Nē, mūsu platforma apstrādā visu tirdzniecību automātiski, pamatojoties uz jūsu preferences.'
                                ],
                                [
                                    'question' => 'Kuriem tirgiem es varu piekļūt?',
                                    'answer' => 'Mēs nodrošinām piekļuvi nākamās dienas, dienas iekšējiem un balansēšanas tirgiem.'
                                ],
                                [
                                    'question' => 'Kā tiek veikti darījumi?',
                                    'answer' => 'Mūsu AI algoritmi analizē tirgus apstākļus un automātiski veic darījumus.'
                                ],
                                [
                                    'question' => 'Kā ar tirgus riskiem?',
                                    'answer' => 'Mums ir visaptveroši riska pārvaldības rīki, tostarp cenu limiti un apjoma kontrole.'
                                ],
                                [
                                    'question' => 'Vai es varu iestatīt savus parametrus?',
                                    'answer' => 'Jā, jūs varat definēt savas tirdzniecības preferences un riska toleranci.'
                                ],
                                [
                                    'question' => 'Kā es varu izsekot veiktspēju?',
                                    'answer' => 'Mūsu vadības panelis nodrošina reāllaika analītiku un detalizētus pārskatus.'
                                ]
                            ]
                        ],
                        'get_started' => [
                            'title' => 'Gatavi tirgot<br>gudrāk?',
                            'button_text' => 'Sākt',
                            'subtitle' => 'Inteliģenta enerģijas tirdzniecība modernajam tīklam.',
                            'text' => 'Pievienojieties enerģijas tirdzniecības revolūcijai un atbloķējiet savu enerģijas aktīvu pilnu vērtību.'
                        ]
                    ]
                ]
            ],
            'fcr' => [
                'en' => [
                    'content' => [
                        'button_text' => 'Contact us',
                        'explore_text' => 'Explore',
                        'show_rellax' => true,
                        'show_rellax_mini' => false,
                        'info' => [
                            'title' => 'Frequency Containment Reserve Services',
                            'link_text' => 'Join the FCR market',
                            'content' => '<p class="section-subtitle">Grid stability services</p>
                            <p class="section-text">Participate in the FCR market by providing fast-responding frequency regulation services. Our systems automatically respond to grid frequency deviations within seconds, helping maintain grid stability while generating revenue.</p>
                            <p class="section-subtitle">Proven technology</p>
                            <p class="section-text">Our FCR solutions are certified and proven in multiple markets, delivering reliable performance and consistent revenue streams for asset owners.</p>',
                            'show_image' => true
                        ],
                        'deliver' => [
                            'title' => 'FCR service benefits:',
                            'show_numbers' => true,
                            'items' => [
                                ['subtitle' => 'Fast response', 'text' => 'Sub-second response to frequency deviations'],
                                ['subtitle' => 'Revenue generation', 'text' => 'Earn income from grid stability services'],
                                ['subtitle' => 'Automated operation', 'text' => 'Fully automatic response without manual intervention'],
                                ['subtitle' => 'Market certified', 'text' => 'Meets all TSO requirements and standards'],
                                ['subtitle' => 'Asset optimization', 'text' => 'Maximize value from existing assets'],
                                ['subtitle' => 'Performance monitoring', 'text' => 'Real-time tracking and reporting']
                            ]
                        ],
                        'products' => [
                            'subtitle' => 'FCR solutions',
                            'title' => 'Complete systems for frequency containment reserve participation.'
                        ],
                        'faq' => [
                            'title' => 'FCR service<br>questions?',
                            'subtitle' => 'Understanding FCR',
                            'items' => [
                                [
                                    'question' => 'What is FCR?',
                                    'answer' => 'Frequency Containment Reserve is a grid balancing service that responds automatically to frequency deviations, helping maintain grid stability at 50 Hz.'
                                ],
                                [
                                    'question' => 'What response time is required?',
                                    'answer' => 'FCR services must begin responding within seconds and reach full activation within 30 seconds of a frequency deviation.'
                                ],
                                [
                                    'question' => 'What assets can provide FCR?',
                                    'answer' => 'Battery storage systems, EVs, and flexible loads can all provide FCR services with the right control systems.'
                                ],
                                [
                                    'question' => 'How is FCR compensated?',
                                    'answer' => 'FCR providers receive capacity payments for being available and may receive additional energy payments for actual activations.'
                                ],
                                [
                                    'question' => 'What are the technical requirements?',
                                    'answer' => 'Assets must meet specific technical requirements including response time, accuracy, and availability set by the TSO.'
                                ],
                                [
                                    'question' => 'Can I stack FCR with other services?',
                                    'answer' => 'Yes, many assets can provide FCR while also participating in energy trading or other ancillary services.'
                                ]
                            ]
                        ],
                        'get_started' => [
                            'title' => 'Ready for<br>FCR?',
                            'button_text' => 'Learn more',
                            'subtitle' => 'Turn your assets into grid stability providers.',
                            'text' => 'Start earning revenue by helping maintain grid frequency with our certified FCR solutions.'
                        ]
                    ]
                ],
                'lv' => [
                    'content' => [
                        'button_text' => 'Sazinieties ar mums',
                        'explore_text' => 'Uzzināt vairāk',
                        'show_rellax' => true,
                        'show_rellax_mini' => false,
                        'info' => [
                            'title' => 'Frekvences ierobežošanas rezerves pakalpojumi',
                            'link_text' => 'Pievienojieties FCR tirgum',
                            'content' => '<p class="section-subtitle">Tīkla stabilitātes pakalpojumi</p>
                            <p class="section-text">Piedalieties FCR tirgū, sniedzot ātri reaģējošus frekvences regulēšanas pakalpojumus.</p>',
                            'show_image' => true
                        ],
                        'deliver' => [
                            'title' => 'FCR pakalpojuma priekšrocības:',
                            'show_numbers' => true,
                            'items' => [
                                ['subtitle' => 'Ātra reakcija', 'text' => 'Reakcija uz frekvences novirzēm sekundes daļās'],
                                ['subtitle' => 'Ieņēmumu ģenerēšana', 'text' => 'Pelniet ienākumus no tīkla stabilitātes pakalpojumiem'],
                                ['subtitle' => 'Automatizēta darbība', 'text' => 'Pilnībā automātiska reakcija bez manuālas iejaukšanās'],
                                ['subtitle' => 'Tirgus sertificēts', 'text' => 'Atbilst visām TSO prasībām un standartiem'],
                                ['subtitle' => 'Aktīvu optimizācija', 'text' => 'Maksimizējiet vērtību no esošajiem aktīviem'],
                                ['subtitle' => 'Veiktspējas uzraudzība', 'text' => 'Reāllaika izsekošana un ziņošana']
                            ]
                        ],
                        'products' => [
                            'subtitle' => 'FCR risinājumi',
                            'title' => 'Pilnīgas sistēmas frekvences ierobežošanas rezerves dalībai.'
                        ],
                        'faq' => [
                            'title' => 'Jautājumi par<br>FCR?',
                            'subtitle' => 'FCR izpratne',
                            'items' => [
                                [
                                    'question' => 'Kas ir FCR?',
                                    'answer' => 'Frekvences ierobežošanas rezerve ir tīkla balansēšanas pakalpojums, kas automātiski reaģē uz frekvences novirzēm.'
                                ],
                                [
                                    'question' => 'Kāds reakcijas laiks ir nepieciešams?',
                                    'answer' => 'FCR pakalpojumiem jāsāk reaģēt sekunžu laikā un jāsasniedz pilna aktivizācija 30 sekunžu laikā.'
                                ],
                                [
                                    'question' => 'Kādi aktīvi var nodrošināt FCR?',
                                    'answer' => 'Akumulatoru uzglabāšanas sistēmas, EV un elastīgas slodzes var nodrošināt FCR pakalpojumus.'
                                ],
                                [
                                    'question' => 'Kā tiek kompensēts FCR?',
                                    'answer' => 'FCR pakalpojumu sniedzēji saņem jaudas maksājumus par pieejamību.'
                                ],
                                [
                                    'question' => 'Kādas ir tehniskās prasības?',
                                    'answer' => 'Aktīviem jāatbilst īpašām tehniskām prasībām, ko nosaka TSO.'
                                ],
                                [
                                    'question' => 'Vai es varu apvienot FCR ar citiem pakalpojumiem?',
                                    'answer' => 'Jā, daudzi aktīvi var nodrošināt FCR, vienlaikus piedaloties enerģijas tirdzniecībā.'
                                ]
                            ]
                        ],
                        'get_started' => [
                            'title' => 'Gatavi<br>FCR?',
                            'button_text' => 'Uzzināt vairāk',
                            'subtitle' => 'Pārvērtiet savus aktīvus par tīkla stabilitātes nodrošinātājiem.',
                            'text' => 'Sāciet pelnīt ieņēmumus, palīdzot uzturēt tīkla frekvenci ar mūsu sertificētiem FCR risinājumiem.'
                        ]
                    ]
                ]
            ],
            'mfrr' => [
                'en' => [
                    'content' => [
                        'button_text' => 'Contact us',
                        'explore_text' => 'Explore',
                        'show_rellax' => true,
                        'show_rellax_mini' => false,
                        'info' => [
                            'title' => 'Manual Frequency Restoration Reserve',
                            'link_text' => 'Explore mFRR opportunities',
                            'content' => '<p class="section-subtitle">Balancing market participation</p>
                            <p class="section-text">mFRR services help restore grid frequency after major imbalances. With activation times of 12.5 minutes, your assets can provide valuable balancing services while maintaining operational flexibility.</p>
                            <p class="section-subtitle">Strategic dispatch</p>
                            <p class="section-text">Our platform optimizes your mFRR participation, ensuring you bid competitively while respecting your operational constraints and maximizing revenue opportunities.</p>',
                            'show_image' => true
                        ],
                        'deliver' => [
                            'title' => 'mFRR service advantages:',
                            'show_numbers' => true,
                            'items' => [
                                ['subtitle' => 'Flexible participation', 'text' => 'Choose when and how much capacity to offer'],
                                ['subtitle' => 'High value service', 'text' => 'Premium pricing for balancing energy'],
                                ['subtitle' => 'Operational control', 'text' => 'Maintain control over your assets'],
                                ['subtitle' => 'Market integration', 'text' => 'Seamless integration with TSO systems'],
                                ['subtitle' => 'Revenue stacking', 'text' => 'Combine with other market opportunities'],
                                ['subtitle' => 'Risk management', 'text' => 'Smart bidding strategies minimize risks']
                            ]
                        ],
                        'products' => [
                            'subtitle' => 'mFRR solutions',
                            'title' => 'Intelligent systems for manual frequency restoration.'
                        ],
                        'faq' => [
                            'title' => 'mFRR<br>explained',
                            'subtitle' => 'Key questions answered',
                            'items' => [
                                [
                                    'question' => 'What is mFRR?',
                                    'answer' => 'Manual Frequency Restoration Reserve is a balancing service activated by TSOs to restore frequency after it has been stabilized by faster reserves.'
                                ],
                                [
                                    'question' => 'What\'s the activation time?',
                                    'answer' => 'mFRR must be fully activated within 12.5 minutes of receiving a dispatch signal from the TSO.'
                                ],
                                [
                                    'question' => 'How often is mFRR activated?',
                                    'answer' => 'Activation frequency varies by market and system conditions, typically several times per day during peak periods.'
                                ],
                                [
                                    'question' => 'What\'s the minimum bid size?',
                                    'answer' => 'Minimum bid sizes vary by market, typically ranging from 1 MW to 5 MW depending on the TSO.'
                                ],
                                [
                                    'question' => 'How is pricing determined?',
                                    'answer' => 'mFRR is typically priced through pay-as-bid or marginal pricing mechanisms, depending on the market design.'
                                ],
                                [
                                    'question' => 'Can I participate in other markets?',
                                    'answer' => 'Yes, assets can participate in energy markets and other ancillary services when not activated for mFRR.'
                                ]
                            ]
                        ],
                        'get_started' => [
                            'title' => 'Join the<br>mFRR market',
                            'button_text' => 'Get started',
                            'subtitle' => 'Transform your flexible assets into grid resources.',
                            'text' => 'Unlock new revenue streams by providing manual frequency restoration services.'
                        ]
                    ]
                ],
                'lv' => [
                    'content' => [
                        'button_text' => 'Sazinieties ar mums',
                        'explore_text' => 'Uzzināt vairāk',
                        'show_rellax' => true,
                        'show_rellax_mini' => false,
                        'info' => [
                            'title' => 'Manuālā frekvences atjaunošanas rezerve',
                            'link_text' => 'Izpētiet mFRR iespējas',
                            'content' => '<p class="section-subtitle">Balansēšanas tirgus dalība</p>
                            <p class="section-text">mFRR pakalpojumi palīdz atjaunot tīkla frekvenci pēc lielām nelīdzsvarotībām.</p>',
                            'show_image' => true
                        ],
                        'deliver' => [
                            'title' => 'mFRR pakalpojuma priekšrocības:',
                            'show_numbers' => true,
                            'items' => [
                                ['subtitle' => 'Elastīga dalība', 'text' => 'Izvēlieties, kad un cik daudz jaudas piedāvāt'],
                                ['subtitle' => 'Augstas vērtības pakalpojums', 'text' => 'Premium cenas par balansēšanas enerģiju'],
                                ['subtitle' => 'Operacionālā kontrole', 'text' => 'Saglabājiet kontroli pār saviem aktīviem'],
                                ['subtitle' => 'Tirgus integrācija', 'text' => 'Netraucēta integrācija ar TSO sistēmām'],
                                ['subtitle' => 'Ieņēmumu apvienošana', 'text' => 'Apvienojiet ar citām tirgus iespējām'],
                                ['subtitle' => 'Riska pārvaldība', 'text' => 'Viedas piedāvājumu stratēģijas minimizē riskus']
                            ]
                        ],
                        'products' => [
                            'subtitle' => 'mFRR risinājumi',
                            'title' => 'Inteliģentas sistēmas manuālai frekvences atjaunošanai.'
                        ],
                        'faq' => [
                            'title' => 'mFRR<br>skaidrojums',
                            'subtitle' => 'Atbildes uz galvenajiem jautājumiem',
                            'items' => [
                                [
                                    'question' => 'Kas ir mFRR?',
                                    'answer' => 'Manuālā frekvences atjaunošanas rezerve ir balansēšanas pakalpojums, ko aktivizē TSO.'
                                ],
                                [
                                    'question' => 'Kāds ir aktivizācijas laiks?',
                                    'answer' => 'mFRR jābūt pilnībā aktivizētam 12,5 minūšu laikā pēc signāla saņemšanas.'
                                ],
                                [
                                    'question' => 'Cik bieži tiek aktivizēts mFRR?',
                                    'answer' => 'Aktivizācijas biežums atšķiras atkarībā no tirgus un sistēmas apstākļiem.'
                                ],
                                [
                                    'question' => 'Kāds ir minimālais piedāvājuma lielums?',
                                    'answer' => 'Minimālie piedāvājuma lielumi atšķiras atkarībā no tirgus, parasti no 1 MW līdz 5 MW.'
                                ],
                                [
                                    'question' => 'Kā tiek noteikta cena?',
                                    'answer' => 'mFRR parasti tiek noteikta cena, izmantojot maksu par piedāvājumu vai marginālās cenas mehānismus.'
                                ],
                                [
                                    'question' => 'Vai es varu piedalīties citos tirgos?',
                                    'answer' => 'Jā, aktīvi var piedalīties enerģijas tirgos, kad nav aktivizēti mFRR.'
                                ]
                            ]
                        ],
                        'get_started' => [
                            'title' => 'Pievienojieties<br>mFRR tirgum',
                            'button_text' => 'Sākt',
                            'subtitle' => 'Pārvērtiet savus elastīgos aktīvus par tīkla resursiem.',
                            'text' => 'Atbloķējiet jaunus ieņēmumu avotus, sniedzot manuālās frekvences atjaunošanas pakalpojumus.'
                        ]
                    ]
                ]
            ],
            'afrr' => [
                'en' => [
                    'content' => [
                        'button_text' => 'Contact us',
                        'explore_text' => 'Explore',
                        'show_rellax' => true,
                        'show_rellax_mini' => false,
                        'info' => [
                            'title' => 'Automatic Frequency Restoration Reserve',
                            'link_text' => 'Enable aFRR participation',
                            'content' => '<p class="section-subtitle">Fast automatic balancing</p>
                            <p class="section-text">aFRR provides automatic frequency restoration within 5 minutes, bridging the gap between FCR and mFRR. This high-value service requires sophisticated control systems but offers excellent revenue opportunities.</p>
                            <p class="section-subtitle">Continuous optimization</p>
                            <p class="section-text">Our aFRR platform continuously optimizes your asset response, ensuring reliable service delivery while maximizing revenue and preserving asset lifetime.</p>',
                            'show_image' => true
                        ],
                        'deliver' => [
                            'title' => 'aFRR implementation benefits:',
                            'show_numbers' => true,
                            'items' => [
                                ['subtitle' => 'Premium revenue', 'text' => 'High-value automatic balancing service'],
                                ['subtitle' => 'Fast response', 'text' => 'Full activation within 5 minutes'],
                                ['subtitle' => 'Automatic control', 'text' => 'No manual intervention required'],
                                ['subtitle' => 'Continuous operation', 'text' => 'Provide service 24/7 with high availability'],
                                ['subtitle' => 'Asset protection', 'text' => 'Intelligent control preserves equipment'],
                                ['subtitle' => 'Market compliance', 'text' => 'Fully compliant with TSO requirements']
                            ]
                        ],
                        'products' => [
                            'subtitle' => 'aFRR technology',
                            'title' => 'Advanced control systems for automatic frequency restoration.'
                        ],
                        'faq' => [
                            'title' => 'Understanding<br>aFRR',
                            'subtitle' => 'Technical details explained',
                            'items' => [
                                [
                                    'question' => 'What is aFRR?',
                                    'answer' => 'Automatic Frequency Restoration Reserve automatically restores frequency to nominal values within 5 minutes through continuous power adjustments.'
                                ],
                                [
                                    'question' => 'How does aFRR differ from FCR?',
                                    'answer' => 'While FCR stabilizes frequency immediately, aFRR restores it to exactly 50 Hz and relieves FCR resources for the next event.'
                                ],
                                [
                                    'question' => 'What\'s required for aFRR?',
                                    'answer' => 'Assets need fast ramping capability, reliable communication systems, and sophisticated control algorithms to participate.'
                                ],
                                [
                                    'question' => 'How is aFRR activated?',
                                    'answer' => 'aFRR is activated automatically by TSO control signals sent every few seconds based on system frequency.'
                                ],
                                [
                                    'question' => 'What about availability requirements?',
                                    'answer' => 'aFRR typically requires 95%+ availability during contracted periods to ensure reliable system operation.'
                                ],
                                [
                                    'question' => 'Can batteries provide aFRR?',
                                    'answer' => 'Yes, battery storage systems are ideal for aFRR due to their fast response and precise control capabilities.'
                                ]
                            ]
                        ],
                        'get_started' => [
                            'title' => 'Ready for<br>aFRR?',
                            'button_text' => 'Learn more',
                            'subtitle' => 'Premium balancing services for advanced assets.',
                            'text' => 'Maximize your asset value with automatic frequency restoration capabilities.'
                        ]
                    ]
                ],
                'lv' => [
                    'content' => [
                        'button_text' => 'Sazinieties ar mums',
                        'explore_text' => 'Uzzināt vairāk',
                        'show_rellax' => true,
                        'show_rellax_mini' => false,
                        'info' => [
                            'title' => 'Automātiskā frekvences atjaunošanas rezerve',
                            'link_text' => 'Iespējot aFRR dalību',
                            'content' => '<p class="section-subtitle">Ātra automātiska balansēšana</p>
                            <p class="section-text">aFRR nodrošina automātisku frekvences atjaunošanu 5 minūšu laikā.</p>',
                            'show_image' => true
                        ],
                        'deliver' => [
                            'title' => 'aFRR ieviešanas priekšrocības:',
                            'show_numbers' => true,
                            'items' => [
                                ['subtitle' => 'Premium ieņēmumi', 'text' => 'Augstas vērtības automātisks balansēšanas pakalpojums'],
                                ['subtitle' => 'Ātra reakcija', 'text' => 'Pilna aktivizācija 5 minūšu laikā'],
                                ['subtitle' => 'Automātiska kontrole', 'text' => 'Nav nepieciešama manuāla iejaukšanās'],
                                ['subtitle' => 'Nepārtraukta darbība', 'text' => 'Nodrošiniet pakalpojumu 24/7'],
                                ['subtitle' => 'Aktīvu aizsardzība', 'text' => 'Inteliģenta kontrole saglabā aprīkojumu'],
                                ['subtitle' => 'Tirgus atbilstība', 'text' => 'Pilnībā atbilst TSO prasībām']
                            ]
                        ],
                        'products' => [
                            'subtitle' => 'aFRR tehnoloģija',
                            'title' => 'Progresīvas kontroles sistēmas automātiskai frekvences atjaunošanai.'
                        ],
                        'faq' => [
                            'title' => 'Izprotot<br>aFRR',
                            'subtitle' => 'Tehniskie detaļi paskaidroti',
                            'items' => [
                                [
                                    'question' => 'Kas ir aFRR?',
                                    'answer' => 'Automātiskā frekvences atjaunošanas rezerve automātiski atjauno frekvenci līdz nominālajām vērtībām.'
                                ],
                                [
                                    'question' => 'Kā aFRR atšķiras no FCR?',
                                    'answer' => 'Kamēr FCR stabilizē frekvenci nekavējoties, aFRR atjauno to tieši līdz 50 Hz.'
                                ],
                                [
                                    'question' => 'Kas nepieciešams aFRR?',
                                    'answer' => 'Aktīviem nepieciešama ātra jaudas regulēšanas spēja un uzticamas komunikācijas sistēmas.'
                                ],
                                [
                                    'question' => 'Kā tiek aktivizēts aFRR?',
                                    'answer' => 'aFRR tiek aktivizēts automātiski ar TSO kontroles signāliem.'
                                ],
                                [
                                    'question' => 'Kādas ir pieejamības prasības?',
                                    'answer' => 'aFRR parasti prasa 95%+ pieejamību līguma periodos.'
                                ],
                                [
                                    'question' => 'Vai akumulatori var nodrošināt aFRR?',
                                    'answer' => 'Jā, akumulatoru uzglabāšanas sistēmas ir ideālas aFRR dēļ to ātrās reakcijas.'
                                ]
                            ]
                        ],
                        'get_started' => [
                            'title' => 'Gatavi<br>aFRR?',
                            'button_text' => 'Uzzināt vairāk',
                            'subtitle' => 'Premium balansēšanas pakalpojumi progresīviem aktīviem.',
                            'text' => 'Maksimizējiet savu aktīvu vērtību ar automātiskās frekvences atjaunošanas iespējām.'
                        ]
                    ]
                ]
            ]
        ];
        
        // Обновляем контент для каждой существующей страницы решения
        foreach ($solutions as $slug => $data) {
            $page = Page::where('slug', $slug)->where('type', 'solution')->first();
            
            if ($page) {
                foreach (['en', 'lv'] as $locale) {
                    $translation = $page->translateOrNew($locale);
                    $translation->content = $data[$locale]['content'];
                }
                
                $page->save();
            }
        }
    }

    public function down()
    {
        // При откате просто очищаем контент
        $pages = Page::where('type', 'solution')->get();
        
        foreach ($pages as $page) {
            foreach (['en', 'lv'] as $locale) {
                $translation = $page->translateOrNew($locale);
                $translation->content = [];
            }
            $page->save();
        }
    }
};