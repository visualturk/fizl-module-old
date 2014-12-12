<?php namespace Anomaly\Streams\Addon\Module\Fizl\Http\Controller;

use Anomaly\FizlPages\Pages;
use Anomaly\Streams\Platform\Http\Controller\PublicController;

class FizlController extends PublicController
{
    public function map(Pages $pages, $uri)
    {
        return $pages->render($uri);
    }
}
 