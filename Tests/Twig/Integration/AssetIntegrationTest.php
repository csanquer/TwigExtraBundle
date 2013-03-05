<?php

namespace CSanquer\Bundle\TwigExtraBundle\Tests\Twig\Integration;

use \CSanquer\Bundle\TwigExtraBundle\Asset\AssetManager;
use \CSanquer\Bundle\TwigExtraBundle\Twig\Extension\AssetManagerExtension;

/**
 * AssetIntegrationTest
 *
 * @author Charles Sanquer <charles.sanquer@spyrit.net>
 */
class AssetIntegrationTest extends \Twig_Test_IntegrationTestCase
{
    public function getExtensions()
    {
        return array(
            new AssetManagerExtension(new AssetManager()),
        );
    }

    public function getFixturesDir()
    {
        return dirname(__FILE__).'/../../Fixtures/';
    }
}