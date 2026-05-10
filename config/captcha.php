<?php

return [
    'disable' => false,
    'characters' => 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789',
    'fontsDirectory' => public_path('assets/fonts'),
    'bgsDirectory'   => public_path('assets/backgrounds'),

    'default' => [
        'length' => 6, // Cambiado a 6 como en la imagen
        'width' => 160,
        'height' => 45,
        'quality' => 90,
        'lines' => 0, // En la imagen se ve limpio, sin tantas líneas
        'bgImage' => false,
        'bgColor' => '#212529', // Fondo oscuro como el de la imagen
        'contrast' => -5,
    ],
];