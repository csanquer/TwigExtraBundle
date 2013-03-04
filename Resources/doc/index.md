Installation
------------

### download by composer

Add this in your `composer.json`

    "require": {
        [...]
        "csanquer/twig-extra-bundle" : "dev-master"
    },

And run `php composer.phar update csanquer/twig-extra-bundle`

### Register the bundle in the Kernel (`app/AppKernel.php`)

    [...]
    $bundles = array( {
        [...]
        new CSanquer\Bundle\TwigExtraBundle\CSanquerTwigExtraBundle(),
    );
