<?php

namespace Csanquer\Bundle\TwigExtraBundle\Twig\TokenParser;

use \Csanquer\Bundle\TwigExtraBundle\Twig\Node\EmbeddedAsset as EmbeddedAssetNode;

/**
 * EmbeddedAsset
 *
 * @author Charles Sanquer <charles.sanquer@gmail.com>
 */
class EmbeddedAsset extends \Twig_TokenParser
{

    public function parse(\Twig_Token $token)
    {
        $format = 'js';
        $package = 'default';

        $lineno = $token->getLine();
        $stream = $this->parser->getStream();
        while (!$stream->test(\Twig_Token::BLOCK_END_TYPE)) {
            if ($stream->test(\Twig_Token::NAME_TYPE, 'format')) {
                // format = 'js'
                $stream->next();
                $stream->expect(\Twig_Token::OPERATOR_TYPE, '=');
                $format = $stream->expect(\Twig_Token::STRING_TYPE)->getValue();
            } elseif ($stream->test(\Twig_Token::NAME_TYPE, 'package')) {
                // name = null
                $stream->next();
                $stream->expect(\Twig_Token::OPERATOR_TYPE, '=');
                $package = $stream->expect(\Twig_Token::STRING_TYPE)->getValue();
            } else {
                $token = $stream->getCurrent();
                throw new \Twig_Error_Syntax(sprintf('Unexpected token "%s" of value "%s"', \Twig_Token::typeToEnglish($token->getType(), $token->getLine()), $token->getValue()), $token->getLine());
            }
        }

        $stream->expect(\Twig_Token::BLOCK_END_TYPE);
        $body = $this->parser->subparse(array($this, 'decideEmbeddedAssetEnd'), true);
        $stream->expect(\Twig_Token::BLOCK_END_TYPE);

        return new EmbeddedAssetNode($body, $package, $format, $lineno, $this->getTag());
    }

    public function decideEmbeddedAssetEnd(\Twig_Token $token)
    {
        return $token->test('end'.$this->getTag());
    }

    public function getTag()
    {
        return 'embeddedasset';
    }
}
