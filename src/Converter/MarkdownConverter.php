<?php namespace Addon\Module\Fizl\Converter;

use Addon\Module\Fizl\Contract\ConverterInterface;

class MarkdownConverter implements ConverterInterface
{
    /**
     * Run the file content through its converter.
     *
     * @param $string
     * @return string
     */
    public function convert($string)
	{
		return (new \cebe\markdown\Markdown())->parse($string);
	}
}
