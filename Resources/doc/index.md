Installation
============

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

Use
===

AssetManagerExtension
---------------------

This extension provides functions and tag to store some asset files or contents 
(like javascript files or embedded javascript text) and display them farther in the parent base template.

Example:

* index.html.twig

``` jinja
    {% extends '::base.html.twig' %}
    {% block content %}
        {# We need to render a widget #}

        {% include 'TestBundle:Test:partial.html.twig' %}
    
        {# store js filepath in asset manager for 'js' format and 'default' section #}
        {% do add_asset('bundles/test/js/test2.js') %}
    
    {% endblock %}

```

* partial.html.twig

``` jinja
    {# store js filepath in asset manager for 'js' format and 'default' section #}
    {% do add_asset('bundles/test/js/jquery.js') %}

    {# store js filepath in asset manager for 'js' format and 'pkg1' section #}
    {% do add_asset('bundles/test/js/test1.js', 'pkg1', 'js') %}

    {# store js text in asset manager for 'js' format and 'default' section #}
    {% embeddedasset %}
        var aTestVar = 'foo';
    {% endembeddedasset %}

    {# store js text in asset manager 'js' format and 'ready' section #}
    {% embeddedasset package='ready' format='js'%}
        console.log(aTestVar);
    {% endembeddedasset %}

    {# store js text in asset manager for 'js' format and 'ready' section using a function #}
    {% do add_embedded_asset('console.log("bar");', 'ready', 'js') %}

```

* base.html.twig

``` jinja
<!DOCTYPE html>
<html>
    <head>
        <title>Test</title>
    </head>
    <body>
        {% block content %}
            <p>Hello !</p>
        {% endblock %}
    
        {% block javascripts %}
            <!-- default js -->
            {# 
            render managed asset filepath in default section 
            get_assets() return an array of filepath
            #}
            {% for jsfile in get_assets() %}
            <script src="{{ asset(jsfile) }}"></script>
            {% endfor %}

            <!-- pkg1 js -->
            {# render managed asset filepath in pkg1 section #}
            {% for jsfile in get_assets('pkg1') %}
            <script src="{{ asset(jsfile) }}"></script>
            {% endfor %}
        {% endblock %}
    
        {% block ready_js %}
        <script type="text/javascript">

            {# 
            render managed asset text in default section 
            render_embedded_assets() return all stored text concatened with newlines
            #}
            {{ render_embedded_assets() }} 

            // ready js 
            (function($){
                $(document).ready(function(){
                    {# render managed asset text in ready section #}
                    {{ render_embedded_assets('ready', 'js') }} 
                });
            })(jQuery);
        </script>
        {% endblock %}
   </body>
</html>

```

Result :

``` html
<!DOCTYPE html>
<html>
    <head>
        <title>Test</title>
    </head>
    <body>
            <p>Hello !</p>
    
            <!-- default js -->
            <script src="/bundles/test/js/jquery.js"></script>
            <script src="/bundles/test/js/test2.js"></script>

            <!-- pkg1 js -->
            <script src="/bundles/test/js/test1.js"></script>
    
        <script type="text/javascript">

            var aTestVar = 'foo';

            // ready js
            (function($){
                $(document).ready(function(){
                    console.log(aTestVar);
                    console.log("bar");
                });
            })(jQuery);
        </script>
   </body>
</html>
```
