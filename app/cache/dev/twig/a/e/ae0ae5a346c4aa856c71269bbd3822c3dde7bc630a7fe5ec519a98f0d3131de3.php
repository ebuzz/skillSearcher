<?php

/* base.html.twig */
class __TwigTemplate_ae0ae5a346c4aa856c71269bbd3822c3dde7bc630a7fe5ec519a98f0d3131de3 extends Twig_Template
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
        $__internal_f4af9867787a027a5727d4181a5c3542cda49e428b0e3f67b5576cedddbfb4d1 = $this->env->getExtension("native_profiler");
        $__internal_f4af9867787a027a5727d4181a5c3542cda49e428b0e3f67b5576cedddbfb4d1->enter($__internal_f4af9867787a027a5727d4181a5c3542cda49e428b0e3f67b5576cedddbfb4d1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 7
        echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
    </head>
    <body>
        ";
        // line 10
        $this->displayBlock('body', $context, $blocks);
        // line 11
        echo "        ";
        $this->displayBlock('javascripts', $context, $blocks);
        // line 12
        echo "    </body>
</html>
";
        
        $__internal_f4af9867787a027a5727d4181a5c3542cda49e428b0e3f67b5576cedddbfb4d1->leave($__internal_f4af9867787a027a5727d4181a5c3542cda49e428b0e3f67b5576cedddbfb4d1_prof);

    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        $__internal_a45022e026c770fc73c906983a308e4ad93c556df24fd193fb77832e867e56cf = $this->env->getExtension("native_profiler");
        $__internal_a45022e026c770fc73c906983a308e4ad93c556df24fd193fb77832e867e56cf->enter($__internal_a45022e026c770fc73c906983a308e4ad93c556df24fd193fb77832e867e56cf_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Welcome!";
        
        $__internal_a45022e026c770fc73c906983a308e4ad93c556df24fd193fb77832e867e56cf->leave($__internal_a45022e026c770fc73c906983a308e4ad93c556df24fd193fb77832e867e56cf_prof);

    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_65d15b1ab7c7b63551d6e85a1da53be68565ebbdc3f92478e22fcf7fbd33d3a4 = $this->env->getExtension("native_profiler");
        $__internal_65d15b1ab7c7b63551d6e85a1da53be68565ebbdc3f92478e22fcf7fbd33d3a4->enter($__internal_65d15b1ab7c7b63551d6e85a1da53be68565ebbdc3f92478e22fcf7fbd33d3a4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_65d15b1ab7c7b63551d6e85a1da53be68565ebbdc3f92478e22fcf7fbd33d3a4->leave($__internal_65d15b1ab7c7b63551d6e85a1da53be68565ebbdc3f92478e22fcf7fbd33d3a4_prof);

    }

    // line 10
    public function block_body($context, array $blocks = array())
    {
        $__internal_9d7e61e567a426f8a7760e97fbe488f744bf8b71ee9058ebebe4338c9d0e2a6e = $this->env->getExtension("native_profiler");
        $__internal_9d7e61e567a426f8a7760e97fbe488f744bf8b71ee9058ebebe4338c9d0e2a6e->enter($__internal_9d7e61e567a426f8a7760e97fbe488f744bf8b71ee9058ebebe4338c9d0e2a6e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_9d7e61e567a426f8a7760e97fbe488f744bf8b71ee9058ebebe4338c9d0e2a6e->leave($__internal_9d7e61e567a426f8a7760e97fbe488f744bf8b71ee9058ebebe4338c9d0e2a6e_prof);

    }

    // line 11
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_aaec99167c3605f5b538234c413fc37811ec52df7e955a457afe76ca60304021 = $this->env->getExtension("native_profiler");
        $__internal_aaec99167c3605f5b538234c413fc37811ec52df7e955a457afe76ca60304021->enter($__internal_aaec99167c3605f5b538234c413fc37811ec52df7e955a457afe76ca60304021_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_aaec99167c3605f5b538234c413fc37811ec52df7e955a457afe76ca60304021->leave($__internal_aaec99167c3605f5b538234c413fc37811ec52df7e955a457afe76ca60304021_prof);

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
        return array (  93 => 11,  82 => 10,  71 => 6,  59 => 5,  50 => 12,  47 => 11,  45 => 10,  38 => 7,  36 => 6,  32 => 5,  26 => 1,);
    }
}
