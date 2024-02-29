<?php

use App\View\Components;

return [
    'components' => [
        'badge' => [
            'class' => Components\Badge::class,
            'themes' => [
                'default' => 'inline-flex items-center px-2.5 py-0.5 rounded-full font-medium bg-gray-100 text-gray-800',
                'red' => 'inline-flex items-center px-2.5 py-0.5 rounded-full font-medium bg-red-100 text-red-800',
                'yellow' => 'inline-flex items-center px-2.5 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800',
                'green' => 'inline-flex items-center px-2.5 py-0.5 rounded-full font-medium bg-green-100 text-green-800',
                'blue' => 'inline-flex items-center px-2.5 py-0.5 rounded-full font-medium bg-blue-100 text-blue-800',
                'indigo' => 'inline-flex items-center px-2.5 py-0.5 rounded-full font-medium bg-indigo-100 text-indigo-800',
                'purple' => 'inline-flex items-center px-2.5 py-0.5 rounded-full font-medium bg-purple-100 text-purple-800',
                'pink' => 'inline-flex items-center px-2.5 py-0.5 rounded-full font-medium bg-pink-100 text-pink-800',
            ],
        ],

        'nav' => [
            'class' => Components\Nav::class,
            'themes' => [
                'default' => 'nav',
            ],
        ],

        'menu-item' => [
            'class' => Components\MenuItem::class,
            'themes' => [
                'default' => [
                    'normal' => 'block text-gray-700 block px-4 py-2 text-sm',
                    'active' => 'block bg-gray-100 text-gray-900 block px-4 py-2 text-sm',
                ],
            ],
        ],
        'form' => [
            'class' => Components\Form::class,

            'field' => [
                'class' => Components\Form\Field::class,
                'themes' => [
                    'default' => 'flex-col lg:flex-row flex gap-x-2 text-white rounded-md px-3 py-[10px] lg:py-[20px] shadow-sm ring-1 ring-inset ring-primary focus-within:ring-2 focus-within:ring-accent',
                    // 'default' => 'flex items-center border border-primary rounded-[5px] p-[20px] gap-x-[10px] flex',
                ],
            ],

            'input' => [
                'class' => Components\Form\Input::class,
                'themes' => [
                    'default' => [
                        'normal' => 'p-0 lg-pl-[12px] bg-transparent block w-full rounded-md border-0 py-0 pr-10   text-[18px] focus:ring-2 focus:ring-inset focus:ring-[transparent] lg:text-[24px] sm:leading-6',
                        // 'normal'   => 'font-display p-0 bg-transparent border-0 text-[24px] text-primary block w-full focus:ring-primary focus:border-primary ',
                        'invalid' => 'p-0 lg-pl-[12px] bg-transparent block w-full rounded-md border-0 py-0 pr-10   text-[18px] focus:ring-2 focus:ring-inset focus:ring-[transparent] lg:text-[24px] sm:leading-6',

                        // 'invalid'  => 'font-display p-0 bg-transparent border-0 text-[24px] text-primary block w-full focus:ring-primary focus:border-primary ',
                        'disabled' => 'p-0 lg-pl-[12px] bg-transparent block w-full rounded-md border-0 py-0 pr-10   text-[18px] focus:ring-2 focus:ring-inset focus:ring-[transparent] lg:text-[24px] sm:leading-6',
                    ],
                ],
            ],

            'label' => [
                'class' => Components\Form\Label::class,
                'themes' => [
                    'default' => 'block text-[14px] text-primary',
                ],
            ],

            'legend' => [
                'class' => Components\Form\Legend::class,
                'themes' => [
                    'default' => 'block text-sm font-medium text-primary',
                ],
            ],

            'radio' => [
                'class' => Components\Form\Radio::class,
                'themes' => [
                    'default' => [
                        'normal' => 'focus:ring-radio-500 h-5 w-5 text-radio-600 border-primary',
                        'invalid' => 'focus:ring-radio-500 h-5 w-5 text-red-600 border-primary',
                        'disabled' => 'focus:ring-radio-500 h-5 w-5 text-gray-600 border-primary',
                    ],
                ],
            ],

            'select' => [
                'class' => Components\Form\Select::class,
                'themes' => [
                    'default' => [
                        'normal' => 'shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md',
                        'multiple' => 'relative bg-gray-50 border overflow-x-hidden divide-y divide-gray-200 overflow-y-scroll h-40',
                        'invalid' => 'block w-full pr-10 border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md',
                        'disabled' => 'bg-gray-50 shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-gray-300 rounded-md',
                    ],
                ],
            ],

            'textarea' => [
                'class' => Components\Form\Textarea::class,
                'themes' => [
                    'default' => [
                        'normal' => 'p-0 bg-transparent block w-full rounded-md border-0 py-0 text-[18px] shadow-sm  focus:ring-2 focus:ring-inset focus:ring-[transparent] lg:text-[24px] sm:leading-6',
                        // 'normal'   => 'font-display p-0 bg-transparent border-0 text-[24px] text-primary block w-full focus:ring-primary focus:border-primary ',
                        'invalid' => 'p-0 bg-transparent block w-full rounded-md border-0 py-0 text-[18px] shadow-sm  focus:ring-2 focus:ring-inset focus:ring-[transparent] lg:text-[24px] sm:leading-6',
                        // 'invalid'  => 'max-w-lg shadow-sm block w-full focus:ring-red-500 focus:border-red-500 sm:text-sm border-gray-300 rounded-md',
                        'disabled' => 'p-0 bg-transparent block w-full rounded-md border-0 py-0 text-[18px] shadow-sm  focus:ring-2 focus:ring-inset focus:ring-[transparent] lg:text-[24px] sm:leading-6',
                    ],
                ],
            ],

            'checkbox' => [
                'class' => Components\Form\Checkbox::class,
                'themes' => [
                    'default' => [
                        'normal' => 'focus:ring-indigo-500 h-4 w-4 text-primary border-primary ',
                        'invalid' => 'focus:ring-indigo-500 h-4 w-4 text-red-600 border-primary ',
                        'disabled' => 'focus:ring-indigo-500 h-4 w-4 text-gray-600 border-primary ',
                    ],
                ],
            ],

            'error' => [
                'class' => Components\Form\Error::class,
                'themes' => [
                    'default' => 'error mt-2 text-sm text-red-600',
                ],
            ],

            'description' => [
                'class' => Components\Form\Description::class,
                'themes' => [
                    'default' => 'mt-2 block text-sm text-gray-600',
                ],
            ],
        ],
        'nav-link' => [
            'class' => Components\NavLink::class,
            'themes' => [
                'default' => 'text-[16px] sm:text-[16px] md:text-[16px] lg:text-[18px] xl:text-[20px] relative rounded-md text-white hover:text-primary transition ease-in-out duration-150',
                'active' => 'text-[16px] sm:text-[16px] md:text-[16px] lg:text-[18px] xl:text-[20px] relative rounded-md text-primary pointer-events-none ',
            ],
        ],
        'button' => [
            'class' => Components\Button::class,
            'themes' => [
                'default' => 'btn ',
                'light' => 'leading-[1] rounded-[50px] bg-secondary border border-secondary px-[25px] py-[20px] text-[22px] font-[500] font-display text-primary shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-success',
                'small' => 'leading-[1] rounded-[400px] bg-primary border border-primary px-[20px] py-[10px] text-[24px] font-[400] font-display text-secondary shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-success',
                'large' => 'leading-[1] rounded-[400px] bg-primary border border-primary px-[1.38em] py-[0.83em] text-[24px] sm:text-[26px] md:text-[28px] 2xl:text-[36px] font-[500] font-display text-secondary shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-success',
                'large-dark' => 'leading-[1] rounded-[50px] bg-secondary border border-secondary px-[30px] py-[20px] text-[24px] sm:text-[26px] md:text-[28px] lg:text-[32px] xl:text-[36px] font-[500] font-display text-primary shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-success',
                'ghost' => '',
                'outline' => [
                    'light' => 'btn leading-[1] rounded-[50px]  border border-white px-[20px] py-[10px] font-[400] font-display text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-success',
                    'primary' => 'leading-6 rounded-md border border-primary px-6 py-2.5 text-base font-semibold text-primary shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-success',
                ],
                'tab' => [
                    'innactive' => 'saas',
                    'active' => 'px-0 border-b-2 border-[#5377DD] rounded-none border-primary shadow-none	',

                ],
            ],
        ],
        'text' => [
            'class' => Components\Text::class,
            'themes' => [
                'p' => '',
                'h1' => 'h1',
                'h2' => 'h2',
                'h3' => 'h3',
                'h4' => 'h4',
                'h6' => 'h6',
            ],
            // 'themes' => [
            //     'default' => 'text-[18px] md:text-[18px] lg:text-[20px] 2xl:text-[22px] leading-[1.5] text-foreground',
            //     'invert' => 'text-[18px] md:text-[18px] lg:text-[20px] xl:text-[22px] leading-[1.5] text-white',
            //     'h1' => 'font-display',
            //     'h2' => 'font-display',
            //     'h3' => 'font-display',
            //     'h6' => 'text-white leading-[1.3] ',
            // ],
        ],
        'card' => [
            'class' => Components\Card::class,
            'themes' => [
                'default' => 'shadow-lg magnetic group aspect-h-1 aspect-w-[1.91] block w-full h-full overflow-hidden rounded-lg focus-within:ring-2 focus-within:ring-secondary-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100',
            ],

        ]
    ],
];
