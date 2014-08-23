<?php namespace Streams\Addon\Module\Fizl\Converter;

use Addon\Module\Fizl\Contract\ConverterInterface;
use Netcarver\Textile\Parser as TextileParser;

class TextileConverter implements ConverterInterface
{
    /**
     * Run the file content through its converter.
     *
     * @param $string
     * @return mixed
     */
    public function convert($string)
	{
		return (new TextileParser())->textileThis($string);
	}
}
