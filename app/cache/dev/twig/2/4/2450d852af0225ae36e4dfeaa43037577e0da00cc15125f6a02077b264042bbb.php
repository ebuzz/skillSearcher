<?php

/* TwigBundle:Exception:exception_full.html.twig */
class __TwigTemplate_2450d852af0225ae36e4dfeaa43037577e0da00cc15125f6a02077b264042bbb extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("TwigBundle::layout.html.twig", "TwigBundle:Exception:exception_full.html.twig", 1);
        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "TwigBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_41f2770df85e7f963c44379e7bd2dc4a3df6282748d064c80864a31c889cbc91 = $this->env->getExtension("native_profiler");
        $__internal_41f2770df85e7f963c44379e7bd2dc4a3df6282748d064c80864a31c889cbc91->enter($__internal_41f2770df85e7f963c44379e7bd2dc4a3df6282748d064c80864a31c889cbc91_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_41f2770df85e7f963c44379e7bd2dc4a3df6282748d064c80864a31c889cbc91->leave($__internal_41f2770df85e7f963c44379e7bd2dc4a3df6282748d064c80864a31c889cbc91_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_cb769840c598fb5307110f8f12639856ad7d0a8350238b70259058c51aef9556 = $this->env->getExtension("native_profiler");
        $__internal_cb769840c598fb5307110f8f12639856ad7d0a8350238b70259058c51aef9556->enter($__internal_cb769840c598fb5307110f8f12639856ad7d0a8350238b70259058c51aef9556_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/framework/css/exception.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_cb769840c598fb5307110f8f12639856ad7d0a8350238b70259058c51aef9556->leave($__internal_cb769840c598fb5307110f8f12639856ad7d0a8350238b70259058c51aef9556_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_ba4501bd711b4a437f3243b4e432a426f7234f82dd371d2139e3c1929e5d53ef = $this->env->getExtension("native_profiler");
        $__internal_ba4501bd711b4a437f3243b4e432a426f7234f82dd371d2139e3c1929e5d53ef->enter($__internal_ba4501bd711b4a437f3243b4e432a426f7234f82dd371d2139e3c1929e5d53ef_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_ba4501bd711b4a437f3243b4e432a426f7234f82dd371d2139e3c1929e5d53ef->leave($__internal_ba4501bd711b4a437f3243b4e432a426f7234f82dd371d2139e3c1929e5d53ef_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_f086886e7432d93be3adda488fd6788b7e98818de85653cc825ea3b83fe958e1 = $this->env->getExtension("native_profiler");
        $__internal_f086886e7432d93be3adda488fd6788b7e98818de85653cc825ea3b83fe958e1->enter($__internal_f086886e7432d93be3adda488fd6788b7e98818de85653cc825ea3b83fe958e1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 12
        echo "    ";
        $this->loadTemplate("TwigBundle:Exception:exception.html.twig", "TwigBundle:Exception:exception_full.html.twig", 12)->display($context);
        
        $__internal_f086886e7432d93be3adda488fd6788b7e98818de85653cc825ea3b83fe958e1->leave($__internal_f086886e7432d93be3adda488fd6788b7e98818de85653cc825ea3b83fe958e1_prof);

    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:exception_full.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 12,  72 => 11,  58 => 8,  52 => 7,  42 => 4,  36 => 3,  11 => 1,);
    }
}
