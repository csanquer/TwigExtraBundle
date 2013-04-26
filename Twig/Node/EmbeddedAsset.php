<?php

namespace CSanquer\Bundle\TwigExtraBundle\Twig\Node;

/**
 * EmbeddedAsset
 *
 * @author Charles Sanquer <charles.sanquer@gmail.com>
 */
class EmbeddedAsset extends \Twig_Node
{
    public function __construct(\Twig_NodeInterface $body, $package,  $format, $lineno, $tag = 'embeddedasset')
    {
        parent::__construct(
            array('body' => $body),
            array(
                'package' => $package === null || $package === '' ? 'default' : $package,
                'format' => $format === null || $format === '' ? 'js' : $format
            ),
            $lineno,
            $tag
        );
    }

    /**
     * Compiles the node to PHP.
     *
     * @param \Twig_Compiler A Twig_Compiler instance
     */
    public function compile(\Twig_Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write("ob_start();\n")
            ->subcompile($this->getNode('body'))
            ->write("\$context['asset_manager']->addEmbeddedContent(ob_get_clean(), '".$this->attributes['package']."', '".$this->attributes['format']."');\n")
        ;
    }
}
