<?php namespace Addon\Module\Fizl\Renderer;

use Addon\Module\Fizl\Contract\RendererInterface;

class LexiconRenderer implements RendererInterface
{
    /**
     * Render the content.
     *
     * @param $string
     * @return mixed
     */
    public function render($content)
    {
        return \View::parse($content);
    }
}
