<?php

namespace Csanquer\Bundle\TwigExtraBundle\Tests\Asset;

use \Csanquer\Bundle\TwigExtraBundle\Asset\AssetManager;

class AssetManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AssetManager
     */
    protected $manager;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->manager = new AssetManager();
    }

    public function testFile()
    {
        $class = '\Csanquer\Bundle\TwigExtraBundle\Asset\AssetManager';
        $this->assertInstanceOf($class, $this->manager->addFile('js/jquery.js'));
        $this->assertInstanceOf($class, $this->manager->addFile('js/plugins.js'));
        $this->assertInstanceOf($class, $this->manager->addFile('js/main.js', 'pkg1'));
        $this->assertInstanceOf($class, $this->manager->addFile('css/style.css', null, 'css'));

        $defaultExpected = array('js/jquery.js', 'js/plugins.js');

        $this->assertEquals($defaultExpected, $this->manager->getFiles());
        $this->assertEquals($defaultExpected, $this->manager->getFiles(''));
        $this->assertEquals($defaultExpected, $this->manager->getFiles('default'));
        $this->assertEquals($defaultExpected, $this->manager->getFiles('default', 'js'));
        $this->assertEquals(array('js/main.js'), $this->manager->getFiles('pkg1'));

        $this->assertEquals(array('css/style.css'), $this->manager->getFiles(null, 'css'));
    }

    public function testEmbeddedContent()
    {
        $class = '\Csanquer\Bundle\TwigExtraBundle\Asset\AssetManager';
        $this->assertInstanceOf($class, $this->manager->addEmbeddedContent('console.log(\'foo\');'));
        $this->assertInstanceOf($class, $this->manager->addEmbeddedContent('console.log(bar);', 'ready'));
        $this->assertInstanceOf($class, $this->manager->addEmbeddedContent('console.log(1);', 'ready', 'js'));
        $this->assertInstanceOf($class, $this->manager->addEmbeddedContent('body { font-size: 11px; }', null, 'css'));

        $default = 'console.log(\'foo\');';

        $this->assertEquals('console.log(\'foo\');', $this->manager->renderEmbeddedContents());
        $this->assertEquals(array('console.log(\'foo\');'), $this->manager->getEmbeddedContents());
        $this->assertEquals(implode("\n", array('console.log(bar);', 'console.log(1);')), $this->manager->renderEmbeddedContents('ready'));
        $this->assertEquals(array('console.log(bar);', 'console.log(1);'), $this->manager->getEmbeddedContents('ready'));
        $this->assertEquals(implode("\n\n", array('console.log(bar);', 'console.log(1);')), $this->manager->renderEmbeddedContents('ready', 'js', "\n\n"));

        $this->assertEquals('body { font-size: 11px; }', $this->manager->renderEmbeddedContents(null, 'css'));
        $this->assertEquals(array('body { font-size: 11px; }'), $this->manager->getEmbeddedContents(null, 'css'));
    }
}
