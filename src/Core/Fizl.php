<?php namespace Streams\Addon\Module\Fizl\Core;

class Fizl
{
    /**
     * The path to Fizl content files.
     *
     * @var null
     */
    protected $path = null;

    /**
     * An array of converters by extension.
     *
     * @var array
     */
    protected $converters = [
        'html'    => null,
        'md'      => 'Addon\Module\Fizl\Converter\MarkdownConverter',
        'textile' => 'Addon\Module\Fizl\Converter\TextileConverter',
    ];

    /**
     * The rendering class to use.
     *
     * @var string
     */
    protected $renderer = 'Addon\Module\Fizl\Renderer\LexiconRenderer';

    /**
     * Create a new Fizl class.
     */
    public function __construct()
    {
        $this->path = base_path('addons/' . \Application::getAppRef() . '/content/fizl');

        // Add the namespace to views.
        \View::addNamespace('fizl', $this->path);

        // Add the namespace to assets.
        \Asset::addNamespace('fizl', $this->path);
    }

    /**
     * Main Fizl Function
     * Routes and processes all page requests
     *
     * @param $uri
     * @return mixed
     */
    public function make($uri)
    {
        $path = $this->locate($uri);

        $extension = \File::extension($path);

        $content = \File::get($path);

        // @todo - This is Lex specific... I didn't like the preFormat
        $content = str_replace(
            ['{{', '}}'],
            ['<pre>{{', '}}</pre>'],
            $content
        );

        if (isset($this->converters[$extension]) and $this->converters[$extension] !== null) {
            $content = (new $this->converters[$extension])->convert($content);
        }

        // @todo - This is Lex specific... I didn't like the postFormat
        $content = str_replace(
            ['<pre>{{', '}}</pre>'],
            ['{{', '}}'],
            $content
        );

        return (new $this->renderer)->render($content);
    }

    /**
     * Locate a file.
     *
     * @param $uri
     * @return string
     */
    protected function locate($uri)
    {
        $path = $this->getPath($uri);

        if (\File::isDirectory($path)) {
            $path .= '/index';
        }

        foreach (array_keys($this->converters) as $ext) {
            if (\File::exists($path . '.' . $ext)) {
                return $path .= '.' . $ext;
                break;
            }
        }

        return false;
    }

    /**
     * Does a file exist?
     *
     * @param $uri
     * @return bool
     */
    public function exists($uri)
    {
        return ($this->locate($uri));
    }

    /**
     * Set the path to Fizl content.
     *
     * @param $path
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get the path to Fizl content.
     *
     * @param null $path
     * @return string
     */
    public function getPath($path = null)
    {
        return $this->path . ($path ? '/' . $path : null);
    }
}
