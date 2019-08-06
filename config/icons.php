<?php

return [
    /*
     * Here you can change the path to the fontawesome svg fonts
     *
     * Defaults to the node install folder
     */
    'path_to_fontawesome' => env('SVG_FONTPATH', base_path('node_modules/@fortawesome/fontawesome-free/svgs')),
    /*
     * Here you can change the settings for the svg icon route.
     */
    'route' => [
        'enabled' => true,
        'url' => '/svgIcons/{style}/{icon}.svg',
        'name' => 'svg.icons.show'
    ],

];
