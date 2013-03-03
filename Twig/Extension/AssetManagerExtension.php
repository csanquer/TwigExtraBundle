<?php

namespace CSanquer\Bundle\TwigExtraBundle\Twig\Extension;

use CSanquer\Bundle\TwigExtraBundle\Asset\AssetManager;
use CSanquer\Bundle\TwigExtraBundle\Twig\TokenParser\EmbeddedAsset as EmbeddedAssetTokenParser;
use Twig_Extension;

class AssetManagerExtension extends Twig_Extension
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
            'render_embedded_asset' => new \Twig_Function_Method($this, 'renderEmbeddedAsset', array('is_safe' => array('html', 'js', 'css'))),
        );
    }

    public function getGlobals()
    {
        return array(
            'asset_manager' => $this->manager,
        );
    }

    public function renderEmbeddedAsset($name = 'default', $format = 'js', $separator = "\n")
    {
        return implode($separator, $this->manager->getEmbeddedContent($name, $format));
    }

    public function getName()
    {
        return 'csanquer_asset_manager';
    }
}
