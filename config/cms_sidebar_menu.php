<?php

return [
    [
        'title' => 'Əsas'
    ],
    [
        'icon' => '<i class=" ri-home-5-fill"></i>',
        'title' => 'Əsas səhifə',
        'route' => 'home',
        'can' => 'dashbord.index'
    ],
    [
        'title' => 'Ayarlar',
        'icon'  => '<i class=" ri-settings-5-line"></i>',
        'inner' => [
            // [
            //     'title' => 'Əsas Ayarlar',
            //     'route' => '/',
            //     'icon'  => '<i class="ion ion-ios-settings "></i>',
            //     'can' => 'settings.index'
            // ],
            [
                'title' => 'İdarəçilər',
                'route' => 'user.index',
                'icon'  => '<i class="ri-user-2-fill"></i>',
                'can' => 'user.index'
            ],
            [
                'title' => 'İcazələr',
                'route' => 'role.index',
                'icon'  => '<i class=" ri-auction-fill"></i>',
                'can' => 'role.index'
            ],
         
    ],
    ],
    [
        'icon' => '<i class="ri-building-2-fill"></i>',
        'title' => 'Depatmnet',
        'route' => 'department.index',
        'can' => 'department.index'
    ],
    [
        'icon' => '<i class="ri-user-star-line"></i>',
        'title' => 'Vəzifə',
        'route' => 'position.index',
        'can' => 'position.index'
    ],
    [
        'icon' => '<i class="ri-team-fill"></i>',
        'title' => 'İşçilər',
        'route' => 'personal.index',
        'can' => 'personal.index'
    ],
    [
        'icon' => '<i class=" ri-todo-line"></i>',
        'title' => 'Task',
        'inner' => [
            [
                'title' => 'List',
                'route' => 'task.index',
                'icon'  => '<i class="ri-file-list-3-line"></i>',
                'can' => 'task.index'
            ],
            [
                'title' => 'Kombo',
                'route' => 'kanban.index',
                'icon'  => '<i class=" ri-auction-fill"></i>',
                'can' => 'kombo.index'
            ],
         
         ],
    ],

];
