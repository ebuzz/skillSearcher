<?php

/* base.html.twig */
class __TwigTemplate_db7cb160e5e41a680995896451d5ec64c93fcd97b96b0454147d9533f6f6befc extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_4af03ba86229d1e9e52c372371d545993c755bf7a9ade9b1bf4bc07da9ae43b5 = $this->env->getExtension("native_profiler");
        $__internal_4af03ba86229d1e9e52c372371d545993c755bf7a9ade9b1bf4bc07da9ae43b5->enter($__internal_4af03ba86229d1e9e52c372371d545993c755bf7a9ade9b1bf4bc07da9ae43b5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo " - Skill Searcher</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 7
        echo "        <meta charset=\"UTF-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no\">
        <meta name=\"description\" content=\"Skill Seacher con Windows Metro Style.\">
        <meta name=\"keywords\" content=\"HTML, such a framework\">
        <meta name=\"author\" content=\"Solar Team\">
        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
        <link rel=\"stylesheet\" href=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("css/metro.css"), "html", null, true);
        echo "\" />
        <link rel=\"stylesheet\" href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("css/metro-icons.css"), "html", null, true);
        echo "\" />
        <link rel=\"stylesheet\" href=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("css/metro-responsive.css"), "html", null, true);
        echo "\" />
        <script type=\"text/javascript\" src=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("js/jquery-2.1.4.js"), "html", null, true);
        echo "\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("js/metro.js"), "html", null, true);
        echo "\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("js/user-search.js"), "html", null, true);
        echo "\"></script>
    </head>
    <body>
    <div class=\"container\">
            <div class=\"app-bar fixed-top darcula\" data-role=\"appbar\">
            <a class=\"app-bar-element branding\" href=\"/\">Skill Searcher</a>
            <span class=\"app-bar-divider\"></span>
            <ul class=\"app-bar-menu\">
                <li> 
                    &nbsp;
                    Buscar por:
                    <div class=\"input-control select\">
                        <select id=\"search-selector\">
                            <option value=\"skill/busqueda\">Skills</option>
                            <option value=\"user/busqueda\" selected>Usuarios</option>
                            <option value=\"cuenta/busqueda\">Cuentas</option>
                        </select>
                    </div>
                    &nbsp;
                </li>
                <li>
                    <!-- search/{tipobusqueda}/{cadenadebusqueda} -->
                    <form id=\"search-form\" action=\"user/busqueda\" action=\"get\">
                        <div class=\"input-control text full-size\" data-role=\"input\">
                            <input type=\"text\" placeholder=\"Buscar..\">
                            <button id=\"search-button\"class=\"button\"><span class=\"mif-search\"></span></button>
                        </div>
                    </form>
                </li> 
                <li>
                    <a href=\"\" class=\"dropdown-toggle\">Administracion</a>
                    <ul class=\"d-menu\" data-role=\"dropdown\">
                        <li><a href=\"\">Skills</a></li>
                        <li><a href=\"\">Usuarios</a></li>
                        <!-- <li class=\"divider\"></li> -->
                        <li><a href=\"\">Cuentas</a></li>
                    </ul>
                </li>
            </ul>

            <div class=\"app-bar-element place-right\">
                <span class=\"dropdown-toggle\"><span class=\"mif-cog\"></span> Juanito Banana</span>
                <div class=\"app-bar-drop-container padding10 place-right no-margin-top block-shadow fg-dark\" data-role=\"dropdown\" data-no-close=\"true\" style=\"width: 220px\">
                    <h2 class=\"text-light\">Panel</h2>
                    <ul class=\"unstyled-list fg-dark\">
                        <li><a href=\"\" class=\"fg-white1 fg-hover-yellow\">Perfil</a></li>
                        <li><a href=\"\" class=\"fg-white3 fg-hover-yellow\">Salir</a></li>
                    </ul>
                </div>
            </div>
        </div>
</div>
        <div class=\"container page-content\">
            ";
        // line 72
        $this->displayBlock('body', $context, $blocks);
        // line 73
        echo "        </div>
        ";
        // line 74
        $this->displayBlock('javascripts', $context, $blocks);
        // line 77
        echo "    </body>
</html>
";
        
        $__internal_4af03ba86229d1e9e52c372371d545993c755bf7a9ade9b1bf4bc07da9ae43b5->leave($__internal_4af03ba86229d1e9e52c372371d545993c755bf7a9ade9b1bf4bc07da9ae43b5_prof);

    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        $__internal_24cd0ae73d37f0ea31f33eab26dbeb9756e961d13a200c325d0d6525b91326d6 = $this->env->getExtension("native_profiler");
        $__internal_24cd0ae73d37f0ea31f33eab26dbeb9756e961d13a200c325d0d6525b91326d6->enter($__internal_24cd0ae73d37f0ea31f33eab26dbeb9756e961d13a200c325d0d6525b91326d6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo " ";
        
        $__internal_24cd0ae73d37f0ea31f33eab26dbeb9756e961d13a200c325d0d6525b91326d6->leave($__internal_24cd0ae73d37f0ea31f33eab26dbeb9756e961d13a200c325d0d6525b91326d6_prof);

    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_536c37bf871e7330f47b4f442ed9046e115eec5dd220189209c06fc4386450d9 = $this->env->getExtension("native_profiler");
        $__internal_536c37bf871e7330f47b4f442ed9046e115eec5dd220189209c06fc4386450d9->enter($__internal_536c37bf871e7330f47b4f442ed9046e115eec5dd220189209c06fc4386450d9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_536c37bf871e7330f47b4f442ed9046e115eec5dd220189209c06fc4386450d9->leave($__internal_536c37bf871e7330f47b4f442ed9046e115eec5dd220189209c06fc4386450d9_prof);

    }

    // line 72
    public function block_body($context, array $blocks = array())
    {
        $__internal_0d3d7eb3dffea2e1688d2359f16bdfb7fbc3b9490ad498931291bce0300323aa = $this->env->getExtension("native_profiler");
        $__internal_0d3d7eb3dffea2e1688d2359f16bdfb7fbc3b9490ad498931291bce0300323aa->enter($__internal_0d3d7eb3dffea2e1688d2359f16bdfb7fbc3b9490ad498931291bce0300323aa_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_0d3d7eb3dffea2e1688d2359f16bdfb7fbc3b9490ad498931291bce0300323aa->leave($__internal_0d3d7eb3dffea2e1688d2359f16bdfb7fbc3b9490ad498931291bce0300323aa_prof);

    }

    // line 74
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_0ed21fa8597a739c40c3893ee1750bab6c08f034536efefcd5b0b13238ff953e = $this->env->getExtension("native_profiler");
        $__internal_0ed21fa8597a739c40c3893ee1750bab6c08f034536efefcd5b0b13238ff953e->enter($__internal_0ed21fa8597a739c40c3893ee1750bab6c08f034536efefcd5b0b13238ff953e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        echo " 
        <!-- Usar este bloque para javascripts -->
        ";
        
        $__internal_0ed21fa8597a739c40c3893ee1750bab6c08f034536efefcd5b0b13238ff953e->leave($__internal_0ed21fa8597a739c40c3893ee1750bab6c08f034536efefcd5b0b13238ff953e_prof);

    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  176 => 74,  165 => 72,  154 => 6,  142 => 5,  133 => 77,  131 => 74,  128 => 73,  126 => 72,  70 => 19,  66 => 18,  62 => 17,  58 => 16,  54 => 15,  50 => 14,  46 => 13,  38 => 7,  36 => 6,  32 => 5,  26 => 1,);
    }
}
