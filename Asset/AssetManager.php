<?php

namespace Csanquer\Bundle\TwigExtraBundle\Asset;

/**
 * AssetManager
 *
 * @author Charles Sanquer <charles.sanquer@gmail.com>
 */
class AssetManager
{
    protected $files;
    protected $content;

    public function __construct()
    {
        $this->files = array('js' => array());
        $this->content = array('js' => array());
    }

    /**
     *
     * @param array  $items
     * @param string $item
     * @param string $package
     * @param string $format
     *
     * @return \Csanquer\Bundle\TwigExtraBundle\Asset\AssetManager
     */
    protected function addItem(array &$items, $item, $package = 'default', $format = 'js')
    {
        $package = $package === null || $package === '' ? 'default' : $package;

        if (!isset($items[$format])) {
            $items[$format] = array();
        }

        if (!isset($items[$format][$package])) {
            $items[$format][$package] = array();
        }

        $items[$format][$package][] = $item;

        return $this;
    }

    /**
     *
     * @param array  $items
     * @param string $package
     * @param string $format
     *
     * @return array
     */
    protected function getItems(array $items, $package = 'default', $format = 'js')
    {
        $package = $package === null || $package === '' ? 'default' : $package;

        return isset($items[$format][$package]) ? $items[$format][$package] : array();
    }

    /**
     *
     * @param string $file
     * @param string $package
     * @param string $format
     *
     * @return Csanquer\Bundle\TwigExtraBundle\Asset\AssetManager
     */
    public function addFile($file, $package = 'default', $format = 'js')
    {
        return $this->addItem($this->files, $file, $package, $format);
    }

    /**
     *
     * @param  string $package
     * @param  string $format
     * @return array
     */
    public function getFiles($package = 'default', $format = 'js')
    {
        return $this->getItems($this->files, $package, $format);
    }

    /**
     *
     * @param  string                                             $content
     * @param  string                                             $package
     * @param  string                                             $format
     * @return Csanquer\Bundle\TwigExtraBundle\Asset\AssetManager
     */
    public function addEmbeddedContent($content, $package = 'default', $format = 'js')
    {
        return $this->addItem($this->content, $content, $package, $format);
    }

    /**
     *
     * @param  string $package
     * @param  string $format
     * @return array
     */
    public function getEmbeddedContents($package = 'default', $format = 'js')
    {
        return $this->getItems($this->content, $package, $format);
    }

    /**
     *
     * @param string $package
     * @param string $format
     * @param string $separator
     *
     * @return string
     */
    public function renderEmbeddedContents($package = 'default', $format = 'js', $separator = "\n")
    {
        return implode($separator, $this->getEmbeddedContents($package, $format));
    }
}
