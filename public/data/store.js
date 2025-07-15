const products = {
    'zaptec_go': {
        'title': 'Zaptec Go',
        'subtitle': 'Up to 7.4kW charging speed',
        'description': 'Using leading technology, this award-winning charger is as smart on the inside as it is simple on the outside. It’s Wi-Fi compatible, highly intuitive and available in a choice of six stylish colours',
        'manufacters_standart': '5-year',
        'features': ['Up to 7.4kW charging speed', '4G LTE-M or Wi-Fi connectivity'],
        'applications': ['Holiday parks']
    },

    'eo_mini_pro_3': {
        'title': 'EO Mini Pro 3',
        'subtitle': 'Up to 7.4kW charging speed',
        'description': 'Compact and stylish in design, this robust device has built-in functionality to allow for load management and solar connectivity. Its simple mobile app is straightforward to use, making charging easy and stress-free.',
        'manufacters_standart': '3-year',
        'features': ['Up to 7.4kW charging speed', 'Ethernet, 4G or Wi-Fi connectivity', 'Power balancing capability built in', 'Solar compatible'],
        'applications': ['Holiday parks']
    },

    'easee_one': {
        'title': 'Easee One',
        'subtitle': 'Up to 7.4kW charging speed',
        'description': `This device has superb app functionality to give you full control over your charge point.

Additional units can be installed to work in a cluster arrangement, making it ideal for homes with more than one electric vehicle. You can choose from five different cover colours when you select this futuristic-looking device.`,
        'manufacters_standart': '3-year',
        'features': ['Up to 7.4kW charging speed', '4G LTE-M or Wi-Fi connectivity', 'Ability to add further devices'],
        'applications': ['Holiday parks']
    },

    'eo_genius_2': {
        'title': 'EO Genius 2',
        'subtitle': '7.2kW and 22kW variants',
        'description': 'This device is easy to install and comes with built-in protections required by underwiring regulations, making installation quicker and cheaper than other commercial charge points. An integrated MID meter also allows for different billing options for guests.',
        'manufacters_standart': '3-year',
        'features': [
            '7.2kW and 22kW variants',
            'Power balancing capability built in',
            'Ethernet, 4G or Wi-Fi connectivity'
        ],
        'applications': [
            'Holiday homes',
            'Holiday parks',
            'Workplaces'
        ]
    },

    'zaptec_pro': {
        'title': 'Zaptec Pro',
        'subtitle': 'Up to 22kW charging speed',
        'description': 'With this device, you can create a charging network of multiple charge points off one electrical circuit. With integrated sensors continuously monitoring electricity consumption, it provides a seamless distribution of power among all vehicles, without overloading the facility.',
        'manufacters_standart': '5-year',
        'features': [
            'Up to 22kW charging speed',
            '4G LTE-M, Wi-Fi or Power Line Communication connectivity',
            'Dynamic phase allocation',
            'Dynamic load balancing'
        ],
        'applications': [
            'Apartment buildings',
            'Workplaces'
        ]
    },

    'easee_charge': {
        'title': 'Easee Charge',
        'subtitle': 'Up to 22kW charging speed',
        'description': 'This commercial model retains the sleek and compact look of the home model. Loved by installers for its easy-to-install approach, it’s simple and quick to setup and commission.',
        'manufacters_standart': '3-year',
        'features': [
            'Up to 22kW charging speed',
            '4G LTE-M or Wi-Fi connectivity',
            'Scalable system'
        ],
        'applications': [
            'Apartment buildings',
            'Workplaces'
        ]
    },

    'garo_entity_pro': {
        'title': 'Garo Entity Pro',
        'subtitle': 'Up to 22kW charging speed',
        'description': 'The big brother of the Compact, created with a purpose of installing multiple charging stations that work seamlessly together as one network. Available in 4 colours.',
        'manufacters_standart': '2-year',
        'features': [
            'Up to 22kW charging speed',
            'Smart Phase Balancing',
            'Wireless Load Management',
            'Ethernet & 4G connectivity'
        ],
        'applications': [
            'Apartment buildings',
            'Workplaces'
        ]
    },

    'schneider_evlink_pro_ac': {
        'title': 'Schneider EVlink Pro AC',
        'subtitle': '7.2kW, 11kW and 22kW variants',
        'description': 'Highly reliable, flexible and sustainable, this smart charging device is ideal for semi-public parking facilities in commercial and industrial buildings. The device is easy to install, operate, monitor and maintain through digital capabilities and reinforced safety.',
        'manufacters_standart': '18-month',
        'features': [
            '7.2kW, 11kW and 22kW variants',
            'Ethernet, Bluetooth or 4G connectivity',
            'NFC functionality',
            'Compatible with manufacturer’s Building Management systems'
        ],
        'applications': [
            'Workplaces',
            'Apartment buildings'
        ]
    }

};

const how_we_can_help = {
    'expertise': ['Leaders in residential EV charging solutions', "Backed by the UK Government's Charging Infrastructure Investment Fund (CIIF), Energy Park brings you a team of highly trained professionals."],
    'guidance': ['A consultative approach', 'We work closely with you throughout the design and installation process to ensure the infrastructure meets your unique requirements'],
    'support': ['Ongoing management and maintenance', "We can take care of all ongoing operations, including maintenance and customer service, so there's no need for your day-to-day involvement."]
}

const partner_count = 6;

const apartmentDelivers = [
    {
        subtitle: 'Cost-efficient solutions',
        text: 'We offer property owners fully funded solutions with no upfront capital required, ensuring cost-free installation for you and your residents.'
    },
    {
        subtitle: 'Proactive support',
        text: 'We work closely with you throughout the entire process, offering expert guidance to ensure the EV charging infrastructure meets your unique needs and goals.'
    },
    {
        subtitle: 'A fully managed service',
        text: 'We take care of all ongoing operations, eliminating the need for you to manage day-to-day tasks or invest in additional resource.'
    },
    {
        subtitle: 'Future-proof designs',
        text: 'Every Energy Park installation is thoughtfully designed by our in-house design team to support rising EV ownership and evolving energy needs.'
    },
    {
        subtitle: 'Added value',
        text: 'Installing uniform EV charging infrastructure will add value to your sites and boost their appeal to future tenants.'
    },
    {
        subtitle: 'Guaranteed expertise',
        text: "Energy Park is backed by the UK Government's Charging Infrastructure Investment Fund (CIIF) and brings together a team of highly trained professionals to deliver best-in-class EV charging solutions."
    }
]

const apartmentResidents = [
    {
        subtitle: 'Low-cost charging',
        text: 'Your residents will receive competitive home charging pricing without any costs for installation, maintenance or testing.'
    },
    {
        subtitle: 'Convenience and flexibility',
        text: 'With EV charging on their doorstep, residents will have the freedom to charge their vehicle at home whenever they need to.'
    },
    {
        subtitle: 'Fast, efficient charging',
        text: 'With charging up to 22kW, residents can relax knowing that their vehicle will charge quickly and efficiently.'
    },
    {
        subtitle: 'Good accessibility',
        text: 'Our charge points are proactively maintained with any faults detected and fixed quickly, keeping them accessible and ready to use.'
    }
]

const apartmentProductsIds = ['zaptec_pro', 'easee_charge'];
const apartmentProducts = apartmentProductsIds.reduce((acc, id) => {
    if (products[id]) acc[id] = products[id];
    return acc;
}, {});
const apartmentQuestions = [
    {
        'title': 'Do you offer a funded solution for residential landlords?',
        'answer': `Yes, for residential landlords we offer a fully funded, maintained and managed EV charging solution.<br><br><a href="/contact" class="underline-anim">Get in touch</a> to find out more.`
    },
    {
        'title': 'Will the EV charge points work with every electric vehicle?',
        'answer': `Yes, the EV charge point connecters we use are compatible with all new electric vehicles currently available in the UK.`
    },
    {
        'title': 'How do you know there will be sufficient electrical capacity for the EV charge points at my residential site?',
        'answer': `Before we install your EV charge points, we’ll visit your site to get a full understanding of your site’s electrical capacity. Once we’ve installed your charge points, we’ll then monitor your usage on our online platform and distribute electricity to the charge points in a smart and balanced way.`
    },
    {
        'title': 'Can you help with the ongoing management and maintenance of the EV charge points?',
        'answer': `Yes, we provide ongoing maintenance, as well as service support for you and customer support for drivers. We’ll carry out periodic testing, and if issues arise that can’t be rectified remotely, we’ll send a technician to the site.`
    }
]



const holidayParksProductsIds = ['easee_one', 'eo_mini_pro_3', 'zaptec_go', 'eo_genius_2'];
const holidayParksProducts = holidayParksProductsIds.reduce((acc, id) => {
    if (products[id]) acc[id] = products[id];
    return acc;
}, {});
const holidayParksQuestions = [
    {
        'title': 'Can you recommend which charge point to use?',
        'answer': `Yes, once we’ve received your survey response and spoken to you via our video consultation, we’ll recommend the best charge point to suit your needs.`
    },
    {
        'title': 'How can I get a quote from you?',
        'answer': `To get started, fill out our form on our contact page <a href="/contact" class="section-subtitle">here</a>. We’ll send you an online survey to fill in so we can understand more about your property, and then we’ll be in touch to arrange a video consultation to give you more detail on our pricing and installation process.`
    }
]

const hotelsProductsIds = ['zaptec_pro', 'easee_charge', 'eo_genius_2'];
const hotelsProducts = hotelsProductsIds.reduce((acc, id) => {
    if (products[id]) acc[id] = products[id];
    return acc;
}, {});
const hotelsQuestions = [
    {
        'title': 'Will the EV charge points work with every electric vehicle?',
        'answer': `Yes, the EV charge point connecters we use are compatible with all new electric vehicles currently available in the UK.`
    },
    {
        'title': 'How do you know there will be sufficient electrical capacity for the EV charge points at my site?',
        'answer': `Before we install your EV charge points, we’ll visit your site to get a full understanding of your site’s electrical capacity. Once we’ve installed your EV charge points, we’ll then monitor your usage on our online platform and distribute electricity to the charge points in a smart and balanced way.`
    },
    {
        'title': 'Can guests see if we provide EV charge point facilities before they visit?',
        'answer': `Yes, you can make your EV charge points visible on maps. This will help to inform your current customers, as well attracting more potential customers looking for a place to charge.`
    },
    {
        'title': 'Can I generate revenue from the EV charge points?',
        'answer': `Yes, you can set your desired tariff to cover the cost of the electricity and generate additional revenue.`
    },
    {
        'title': 'Can you help with the ongoing management and maintenance of the EV charge points?',
        'answer': `Yes, via our cloud-based software platform we can provide ongoing maintenance, as well as service support for you and customer support for drivers. We’ll carry out in-person periodic testing, and if issues arise that can’t be rectified remotely, we’ll send a technician to the site.`
    },
    {
        'title': 'How can I get a quote from you?',
        'answer': `To get started, fill out our form on our contact page <a href="/contact" class="section-subtitle">here</a>. We’ll send you a quick online survey to fill in so we can understand more about your site, and then we’ll be in touch to give you more detail on our pricing and installation process.`
    }
]

const hotelsBenefits = [
    {
        subtitle: 'Attract more customers',
        text: 'By making your EV charge points visible on maps, you’ll attract more people looking for a hotel with charging facilities. And you could even choose to offer free charging as an incentive.'
    },
    {
        subtitle: 'Generate revenue',
        text: 'Charging fees for the use of your EV charge points can quickly create an additional revenue stream. This will soon cover the costs of installation and generate ongoing revenue.'
    },
    {
        subtitle: 'Hit sustainability targets',
        text: 'Reach your sustainability targets while boosting your company’s image and reputation.'
    },
    {
        subtitle: 'Maintain a uniform look',
        text: 'Using one EV charge point supplier will help to maintain a smart, consistent look around your site. A less uniform approach could undermine the site’s visual appeal.'
    }
]



const workplaceProductsIds = ['Zaptec Pro', 'eo_genius_2', 'Easee Charge', 'Easee One'];
const workplaceProducts = workplaceProductsIds.reduce((acc, idx) => {
    id = idx.toLowerCase().replace(' ', '_');
    if (products[id]) acc[id] = products[id];
    return acc;
}, {});
const workplaceQuestions = [
    {
        'title': 'Will the EV charge points work with every electric vehicle?',
        'answer': `Yes, the EV charge point connectors we use are compatible with all new electric vehicles currently available in the UK.`
    },
    {
        'title': 'How do you know there will be sufficient electrical capacity for the EV charge points at my workplace?',
        'answer': `Before we install your EV charge points, we’ll visit your site to get a full understanding of your site’s electrical capacity. Once we’ve installed your charge points, we’ll then monitor your usage on our online platform and distribute electricity to the charge points in a smart and balanced way.`
    },
    {
        'title': 'How can I control who uses the EV charge points?',
        'answer': `You can either open up the EV charge points for use by all staff and visitors to your site, or you can use a key to allow access to authorised drivers only. You can also choose to issue approved drivers with an RFID (Radio Frequency Identification) access card.`
    },
    {
        'title': 'Can you help with the ongoing management and maintenance of the EV charge points?',
        'answer': `Yes, via our cloud-based software platform we can provide ongoing maintenance, as well as service support for you and customer support for drivers. We’ll carry out in-person periodic testing, and if issues arise that can’t be rectified remotely, we’ll send a technician to your site.`
    },
    {
        'title': 'How can I get a quote from you?',
        'answer': `To get started, fill out our form on our contact page <a href="/contact" class="section-subtitle">here</a>. We’ll send you a quick online survey to fill in so we can understand more about your site, and then we’ll be in touch to give you more details on our pricing and installation process.`
    }
]

const workplaceBenefits = [
    {
        subtitle: 'Boost recruitment',
        text: 'Providing workplace charging will show your commitment to employees, increase staff satisfaction and help to attract the best future candidates.'
    },
    {
        subtitle: 'Hit sustainability targets',
        text: 'Reducing the environmental impact of your employees’ commute will help you achieve your sustainability goals.'
    },
    {
        subtitle: 'Boost your reputation',
        text: 'With climate change high on today’s agenda, providing charge point access at your workplace demonstrates your commitment to sustainability to both customers and staff.'
    }
]


const aboutPersons = [
    {
        name: 'Giles Desforges',
        post: 'Chief Executive Officer',
        category: 'leadership'
    },
    {
        name: 'Gavin Malone',
        post: 'Founder & Chief Operating Officer',
        category: 'leadership'
    },
    {
        name: 'Adam Grant',
        post: 'Chief Financial Officer',
        category: 'leadership'
    },
    {
        name: 'George Lipczynski',
        post: 'Investment Manager, Zouk Capital',
        category: 'leadership'
    },
    {
        name: 'George Ridd',
        post: 'Partner, Zouk Capital',
        category: 'leadership'
    },
    {
        name: 'Chris White',
        post: 'Non-Executive Director',
        category: 'leadership'
    },
    {
        name: 'Catherine Gabriel',
        post: 'Head of Customer Success',
        category: 'customer-services'
    },
    {
        name: 'Sarah Guy',
        post: 'Customer Service Advisor',
        category: 'customer-services'
    },
    {
        name: 'Mayella Zorzin',
        post: 'Customer Service Advisor',
        category: 'customer-services'
    },
    {
        name: 'Toby Crane-Buck',
        post: 'Head of Commercial',
        category: 'sales-marketing'
    },
    {
        name: 'Mat Peters',
        post: 'Senior Business Development Manager',
        category: 'sales-marketing'
    },
    {
        name: 'Miranda Flack',
        post: 'Head of Brand & Communications',
        category: 'sales-marketing'
    },
    {
        name: 'Leah Hickman',
        post: 'Commercial Executive',
        category: 'sales-marketing'
    },
    {
        name: 'Aaron Yule',
        post: 'Head of EV Infrastructure',
        category: 'installations'
    },
    {
        name: 'Barry Nichols',
        post: 'Lead Surveyor',
        category: 'installations'
    },
    {
        name: 'Mike Pearson',
        post: 'Programme Manager',
        category: 'installations'
    },
    {
        name: 'Alex Brown',
        post: 'Programme Manager',
        category: 'installations'
    },
    {
        name: 'Ricky Trewick',
        post: 'Programme Manager',
        category: 'installations'
    },
    {
        name: 'Marcus Rowbotham',
        post: 'Design Manager',
        category: 'installations'
    },
    {
        name: 'Chelsea Albers',
        post: 'Programme Coordinator',
        category: 'installations'
    },
    {
        name: 'Tia Slade',
        post: 'Programme Coordinator',
        category: 'installations'
    },
    {
        name: 'John Esin',
        post: 'Computer Aided Design Technician',
        category: 'installations'
    },
    {
        name: 'Andrew Milne',
        post: 'Head of Compliance',
        category: 'central-services'
    },
    {
        name: 'Annabel Moore',
        post: 'Executive Assistant',
        category: 'central-services'
    },
    {
        name: 'James Gifford',
        post: 'Analyst',
        category: 'central-services'
    },
    {
        name: 'Kate Nicol',
        post: 'Office Manager',
        category: 'central-services'
    },
];

const aboutPartners = {
    partners: [
        'We partner with the best',
        'We’ve teamed up with leading businesses to provide a comprehensive service for installing and operating EV charge points across residential sites, including apartment buildings, holiday parks and hotels.'
    ],
    charity: [
        'Proud to support charities',
        'We’re proud to be Great Ormond Street Hospital Charity’s EV partner, creating solutions that help to drive donations towards lifesaving research projects and support programmes for families and staff.'
    ],
    hardware: [
        "We're approved installers of hardware",
        'We have close relationships with our equipment partners, which means we are well informed about new product sets and installation methods, and that we can provide you with the best options available.'
    ]
};


const how_find_best_solution = {
    'listen': ['We listen carefully', "Our experienced team will listen carefully to the requirements of your end-users and what you’re looking to achieve by installing EV charge points."],
    'research': ['We do our research', 'Our team will carry out a full site visit and complete a review of the electricity supply to calculate the capacity available for charge points.'],
    'design': ['We create a bespoke design', "Based on our conversations and site visit, we’ll create a scheme design that meets the needs of your site and end-users."]
}


// Для удобства, текст новостей вынес в /data/news.js
// Чтобы не занимать много места здесь
const news = {
    'energy-park-becomes-a-certified-b-corporation': {
        'date': '30th May 2025',
        'title': 'Energy Park becomes a Certified B Corporation',
        'text': energyParkBecomesACertifiedBCorporation
    }
}