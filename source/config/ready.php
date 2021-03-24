<?php

return function () {

    $manifestPath = kirby()->root() . '/assets/assets-manifest.json';
    $hasManifest = F::exists($manifestPath);
    $manifest = $hasManifest ? Json::read($manifestPath) : NULL;
    $getPath = $hasManifest ? fn ($path) => $manifest[$path] : fn ($path) => $path;
  
    return [
        'panel.css' => $getPath('panel.css'),
    
        'amteich.twig' => [
    
            'namespaces' => [
                '' => kirby()->root('snippets')
            ],
        
            'env' => [
        
                'functions' => [
                    'manifest' => $getPath
                ],
            
                'filters' => [
                    'slug' => 'Str::slug'
                ]
            ]
        ]
    ];
};