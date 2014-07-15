<?php

return array(
    'service_manager' => array(
        'factories' => array(
              'CRUDFileService' => 'ConsoleAppli\Factories\CRUDFileServiceFactory',
        )
    ),

    'console' => array(
        'router' => array(
            'routes' => array(
                'crud' => array(
                    'options' => array(
                        'route'    => 'crud (cat|rm|touch):what <file>',
                        'defaults' => array(
                            'controller' => 'IndexController',
                            'action'     => 'redirection',
                        )
                    )
                )
            )
        )
    ),
);