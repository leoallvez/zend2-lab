<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Album\Controller\Album' => 'Album\Controller\AlbumController',
            'Album\Controller\Funcionario' => 'Album\Controller\FuncionarioController',
            'Album\Controller\Usuario' => 'Album\Controller\UsuarioController',
        ),
    ),
     // A seção a seguir é nova e deve ser adicionada ao arquivo
    'router' => array(
        'routes' => array(
            'album' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/album[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Album\Controller\Album',
                        'action'     => 'index',
                    ),
                ),
            ),
            'funcionario' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/funcionario[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Album\Controller\Funcionario',
                        'action'     => 'index',
                    ),
                ),
            ),
            'usuario' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/usuario[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Album\Controller\Usuario',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'album' => __DIR__ . '/../view',
            'funcionario' => __DIR__ . '/../view',
            'usuario' => __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'my_annotation_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . "/src/Album/Model"
                ),
            ),
            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => array(
                'drivers' => array(
                    // register `my_annotation_driver` for any entity under namespace `My\Namespace`
                    'Album\Model' => 'my_annotation_driver'
                )
            ),
            'authentication' => array(
                'orm_default' => array(
                    'object_manager' => 'Doctrine\ORM\EntityManager',
                    'identity_class' => 'Application\Album\Usuario',
                    'identity_property' => 'email',
                    'credential_property' => 'password',
                    'credential_callable' => 'Album\Controller\UsuarioController::verifyCredential'
                ),
            ),
        ),
    ),
);