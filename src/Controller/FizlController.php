<?php namespace Streams\Addon\Module\Fizl\Controller;

use Streams\Controller\PublicController;

class FizlController extends PublicController
{
    /**
     * Remap the request to existing Fizl content.
     */
    public function remap()
    {
        return \App::make('fizl')->make(\Request::path());
    }
}
