<?php

namespace CSanquer\Bundle\TwigExtraBundle\Asset;

/**
 * AssetManager
 *
 * @author Charles Sanquer <charles.sanquer@gmail.com>
 */
class AssetManager
{
    protected $content;

    public function __construct()
    {
        $this->content = array('js' => array());
    }

    /**
     *
     * @param  string                                             $content
     * @param  string                                             $format
     * @return CSanquer\Bundle\TwigExtraBundle\Asset\AssetManager
     */
    public function addEmbeddedContent($content, $name = 'default', $format = 'js')
    {
        if (!isset($this->content[$format])) {
            $this->content[$format] = array();
        }
        $name = $name === null || $name === '' ? 'default' : $name;
        $this->content[$format][$name][] = $content;

        return $this;
    }

    /**
     *
     * @param  string $format
     * @return array
     */
    public function getEmbeddedContent($name = 'default', $format = 'js')
    {
        return isset($this->content[$format][$name]) ? $this->content[$format][$name] : array();
    }
}
