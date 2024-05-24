<?php
return [
    'banner-heading' => [
        'field_name' => [
            'top_title' => 'text',
            'main_title' => 'text',
            'image' => 'file',
        ],
        'validation' => [
            'top_title.*' => 'required|max:191',
            'main_title.*' => 'required|max:191',
            'image.*' => 'nullable|max:3072|image|mimes:jpg,jpeg,png',
        ]
    ],

    'about-us' => [
        'field_name' => [
            'title' => 'text',
            'sub_title' => 'text',
            'description' => 'textarea',
            'image' => 'file'
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'sub_title.*' => 'required|max:191',
            'description.*' => 'required|max:3000',
            'image.*' => 'nullable|max:3072|image|mimes:jpg,jpeg,png',
        ]
    ],

    'popular-listing' => [
        'field_name' => [
            'title' => 'text',
            'sub_title' => 'text',
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'sub_title.*' => 'required|max:191',
        ]
    ],

    'how-it-work' => [
        'field_name' => [
            'title' => 'text',
            'sub_title' => 'text',
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'sub_title.*' => 'required|max:100',
        ]
    ],


    'testimonial' => [
        'field_name' => [
            'title' => 'text',
            'sub_title' => 'text',
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'sub_title.*' => 'required|max:2000',
        ]
    ],

    'news-letter' => [
        'field_name' => [
            'title' => 'text',
            'sub_title' => 'text'
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'sub_title.*' => 'required|max:2000'
        ]
    ],

    'blog' => [
        'field_name' => [
            'title' => 'text',
            'sub_title' => 'text',
            'short_title' => 'text',
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'sub_title.*' => 'required|max:2000',
            'short_title.*' => 'required|max:2000'
        ]
    ],
    'package' => [
        'field_name' => [
            'title' => 'text',
            'short_details' => 'text',
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'short_details.*' => 'required|max:2000'
        ]
    ],
    'faq' => [
        'field_name' => [
            'title' => 'text',
            'sub_title' => 'text',
            'short_details' => 'textarea',
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'sub_title.*' => 'required|max:100',
            'short_details.*' => 'required|max:2000'
        ]
    ],

    'cookie-consent' => [
        'field_name' => [
            'title' => 'text',
            'popup_short_description' => 'textarea',
            'description' => 'textarea',
        ],
        'validation' => [
            'title.*' => 'required|min:2|max:180',
            'popup_short_description.*' => 'required|min:2|max:300',
            'description.*' => 'required|min:2|max:100000',
        ],
    ],
    'contact-us' => [
        'field_name' => [
            'left_title' => 'text',
            'left_details' => 'textarea',
            'heading' => 'text',
            'short_details' => 'textarea',
            'address' => 'text',
            'email' => 'text',
            'phone' => 'text',
            'footer_short_details' => 'textarea'
        ],
        'validation' => [
            'left_title.*' => 'required|max:100',
            'heading.*' => 'required|max:100',
            'address.*' => 'required|max:2000',
            'email.*' => 'required|max:2000',
            'phone.*' => 'required|max:2000'
        ]
    ],
    'maintenance-page' => [
        'field_name' => [
            'title' => 'text',
            'sub_title' => 'text',
            'short_description' => 'textarea',
            'image' => 'file',
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'sub_title.*' => 'required|max:100',
            'short_description.*' => 'required|max:5000',
            'image.*' => 'nullable|max:3072|image|mimes:jpg,jpeg,png',
        ]
    ],

    'message' => [
        'required' => 'This field is required.',
        'min' => 'This field must be at least :min characters.',
        'max' => 'This field may not be greater than :max characters.',
        'image' => 'This field must be image.',
        'mimes' => 'This image must be a file of type: jpg, jpeg, png.',
    ],
    'template_media' => [
        'image' => 'file',
        'thumbnail' => 'file',
        'youtube_link' => 'url',
        'button_link' => 'url',
    ]
];
