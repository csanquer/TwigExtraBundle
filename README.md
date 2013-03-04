CSanquer TwigExtraBundle
========================

Requirements
------------

* PHP >= 5.3.3
* Twig >= 1.12
* Symfony >= 2.1

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

Licensing
---------

License LGPL 3

* Copyright (C) 2013 Charles Sanquer

This file is part of CSanquer TwigExtraBundle.

CSanquer TwigExtraBundle is free software: you can redistribute it and/or modify
it under the terms of the GNU Lesser General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

CSanquer TwigExtraBundle is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public License
along with CSanquer TwigExtraBundle.  If not, see <http://www.gnu.org/licenses/>.
