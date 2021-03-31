<?php

return [
    'menu' => [
        'Catalogos' => [
            'icon' => 'fa fa-book',
            'Arrendadores' => [
                'route' => 'arrendador.index',
                'icon' => 'fa fa-link'
            ],
            'Arrendatarios' => [
                'route' => 'arrendatario.index',
                'icon' => 'fa fa-link'
            ],
            'Inmuebles' => [
                'route' => 'finca.index',
                'icon' => 'fa fa-link'
            ],
            'Tipo de Incidente' => [
                'route' => 'incidentes.index',
                'icon' => 'fa fa-link'],
            'Tipo de Mantenimiento' => [
                'route' => 'mantenimiento.index',
                'icon' => 'fa fa-link'
            ],
            'Tipo de Propiedad' => [
                'route' => 'finca.index',
                'icon' => 'fa fa-link'
            ],
        ],
        'Contrato o Convenio' => [
            'route' => 'contrato.index',
            'icon' => 'fa fa-address-book-o'
        ],
        'Recibos automaticos' => [
            'route' => 'tickets.index',
            'icon' => 'fa fa-file-pdf-o'
        ],
        'Control de Pagos' => [
            'route' => 'payments.index',
            'icon' => 'fa fa-credit-card'
        ],
        'Mantenimiento' => [
            'route' => 'mantenimiento.index',
            'icon' => 'fa fa-gears'
        ],
        'Incidentes' => [
            'route' => 'incidentes.index',
            'icon' => 'fa fa-exclamation'
        ],
        'Reportes' => [
            'route' => 'reports.index',
            'icon' => 'fa fa-book'
        ],
        'Liquidacion' => [
            'route' => 'liquidaciones.index',
            'icon' => 'fa fa-money'
        ],
        'Seguridad' => [
            'icon' => 'fa fa-shield',
            'Usuarios' => [
                'route' => 'usuarios.index',
                'icon' => 'fa fa-link'
            ],
        ],
        'Configuracion' => [
            'route' => 'configuracion.index',
            'icon' => 'fa fa-cogs'
        ],
    ]
];
