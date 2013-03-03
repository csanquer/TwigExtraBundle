<?php

namespace CSanquer\Bundle\TwigExtraBundle\Twig\Node;

use \Twig_Compiler;
use \Twig_Node;
use \Twig_NodeInterface;

/**
 * EmbeddedAsset
 *
 * @author Charles Sanquer <charles.sanquer@gmail.com>
 */
class EmbeddedAsset extends Twig_Node
{
    public function __construct(Twig_NodeInterface $body, $name = 'default',  $format = 'js', $lineno, $tag = 'embeddedasset')
    {
        parent::__construct(array('body' => $body), array('name' => $name, 'format' => $format), $lineno, $tag);
    }

    /**
     * Compiles the node to PHP.
     *
     * @param Twig_Compiler A Twig_Compiler instance
     */
    public function compile(Twig_Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write("ob_start();\n")
            ->subcompile($this->getNode('body'))
            ->write("\$context['asset_manager']->addEmbeddedContent(ob_get_clean(), '".$this->attributes['name']."', '".$this->attributes['format']."');\n")
        ;
    }
}
