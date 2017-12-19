<?php

namespace Location;

use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'location' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/location[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\LocationController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\LocationController::class => Controller\Factory\LocationControllerFactory::class
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            'location' => __DIR__ . '/../view',
        ],
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ],
    'service_manager' => [
        'factories' => [
            // Register the ImageManager service
            Service\ImageManager::class => InvokableFactory::class,
        ],
    ],

];
