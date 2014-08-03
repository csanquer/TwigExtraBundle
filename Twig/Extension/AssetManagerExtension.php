<?php

namespace Csanquer\Bundle\TwigExtraBundle\Twig\Extension;

use \Csanquer\Bundle\TwigExtraBundle\Asset\AssetManager;
use \Csanquer\Bundle\TwigExtraBundle\Twig\TokenParser\EmbeddedAsset as EmbeddedAssetTokenParser;

class AssetManagerExtension extends \Twig_Extension
{
    /**
     *
     * @return AssetManager
     */
    protected $manager;

    public function __construct(AssetManager $assetManager)
    {
        $this->manager = $assetManager;
    }

    public function getTokenParsers()
    {
        return array(
            new EmbeddedAssetTokenParser(),
        );
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('add_asset', array($this->manager, 'addFile')),
            new \Twig_SimpleFunction('add_embedded_asset', array($this->manager, 'addEmbeddedContent')),
            new \Twig_SimpleFunction('get_assets', array($this->manager, 'getFiles')),
            new \Twig_SimpleFunction('get_embedded_assets', array($this->manager, 'getEmbeddedContents')),
            new \Twig_SimpleFunction('render_embedded_assets', array($this->manager, 'renderEmbeddedContents'), array('is_safe' => array('html', 'js', 'css'))),
        );
    }

    public function getGlobals()
    {
        return array(
            'asset_manager' => $this->manager,
        );
    }

    public function getName()
    {
        return 'csanquer_asset_manager';
    }
}
