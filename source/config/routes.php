<?php

return [
    [
        'pattern' => 'figure/(:all)',
        'action' => function ($all) {
            
            $path = trim($all, '/');
            $pagePath = explode('/', $path, -1);
            $pageId = implode('/', $pagePath);

            // $pageId = array_slice(Url::toObject()->path()->toArray(),)

            if ($page = site()->page($pageId)) {
                
                $pathArray = explode('/', $path);
                $fileRef = end($pathArray);
                $fileRefArray = explode('-', $fileRef);
                $fileExt = end($fileRefArray);
                $fileId = implode('-', explode('-', $fileRef, -1));
                $fileName = $fileId . '.' . $fileExt;

                if ($file = $page->file($fileName)) {

                    return new Page([
                        'slug' => $fileRef,
                        'template' => 'figure',
                        'model' => 'figure',
                        'content' => [
                            // 'title' => $page->title(),
                            'fileUrl' => $file->url(),
                            'fileType' => $file->type(),
                            'fileAlt' => $file->alt(),
                            'fileName' => $fileName,
                            'pageUrl' => $page->url() . '#figure-' . $fileRef
                        ]
                    ]);
                }
            }
            
            return false;

            // Debug
            // return new Page([
            //   'slug' => 'didnt-work',
            //   'template' => 'figure',
            //   'model' => 'figure',
            //   'content' => array_merge($page, ['fileName' => $fileName])
            // ]); 
        }
    ]
];