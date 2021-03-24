<?php

Kirby::plugin('levi/video-tag', [

    'tags' => [

        'video' => [

            'attr' => [
                'caption',
                'ratio',
                'width'
            ],

            'html' => function ($tag) {

                $file = $tag->parent()->file($tag->value());
                $kebabCaseFileName = str_replace('.', '-', $file->filename());
                $width = $tag->width() ?? $file->widthOverride()->isNotEmpty()
                    ? $file->widthOverride()
                    : 550;
                $paddingBottom = 56.25;

                if ($ratio = $tag->ratio()) {
                    $operands = array_reverse(explode('/', $ratio));
                    $paddingBottom = $operands[1] / $operands[0];
                }
                
                ob_start(); ?>

                    <figure class="Figure Story-item">
                        
                        <div class="Figure-container">

                            <span
                                class="Figure-anchor"
                                id="<?= $kebabCaseFileName ?>">
                            </span>

                            <a
                                class="Figure-link"
                                href="/figure/<?= $tag->parent()->id() . '/' . $kebabCaseFileName ?>"
                                style="
                                    width: <?= $width ?>px;
                                    padding-bottom: <?= $paddingBottom ?>%;
                                    background-color: currentColor;
                                ">
                                <video
                                    class="Figure-content"
                                    autoplay
                                    loop
                                    muted
                                    inline
                                    src="<?= $file->url() ?>"
                                    type="video/mp4">
                                </video>
                            </a>

                        </div>

                        <?php if ($tag->caption()): ?>
                            <figcaption class="Figure-caption">
                                <?= $tag->caption() ?>
                            <figcaption>
                        <?php endif ?>

                    </figure>

                <?php return preg_replace('~^\h+|\h+$|(\R){2,}|(\s){2,}~m', '$1$2', ob_get_clean());
            }
        ]
    ]
]);