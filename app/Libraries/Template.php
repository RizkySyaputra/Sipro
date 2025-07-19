<?php

namespace App\Libraries;

class Template
{
    protected $templateData = [];

    var $css = '';
    var $js = '';

    private function set(string $name, $data): void
    {
        $this->templateData[$name] = $data;
    }

    public function write($key, $value): void
    {
        $this->set($key, $value);
    }

    function add_css($style, $type = 'link', $media = FALSE, $external = FALSE)
    {
        $success = TRUE;
        if ($this->css != NULL) {
            $css = $this->css;
        } else {
            $css = NULL;
        }

        $filepath = base_url() . '/' . $style;

        switch ($type) {
            case 'link':
                if ($external) {
                    $filepath = $style;
                }
                $css .= '<link type="text/css" rel="stylesheet" href="' . $filepath . '"';
                if ($media) {
                    $css .= ' media="' . $media . '"';
                }
                $css .= ' />';
                break;

            case 'import':
                $css .= '<style type="text/css">@import url(' . $filepath . ');</style>';
                break;

            case 'embed':
                $css .= '<style type="text/css">';
                $css .= $style;
                $css .= '</style>';
                break;

            default:
                $success = FALSE;
                break;
        }

        $this->css = $css;
    }

    public function add_js($script, $type = 'import', $defer = FALSE, $external = FALSE)
    {
        if ($this->js != NULL) {
            $js = $this->js;
        } else {
            $js = NULL;
        }

        switch ($type) {
            case 'import':
                $filepath = base_url() . '/' . $script;
                if ($external) {
                    $filepath = $script;
                }
                $js .= '<script type="text/javascript" src="' . $filepath . '"';
                if ($defer) {
                    $js .= ' defer="defer"';
                }
                $js .= "></script>";
                break;

            case 'embed':
                $js .= '<script type="text/javascript"';
                if ($defer) {
                    $js .= ' defer="defer"';
                }
                $js .= ">";
                $js .= $script;
                $js .= '</script>';
                break;

            default:
                $success = FALSE;
                break;
        }
        $this->js = $js;
    }

    public function load(string $template, string $view, array $viewData = [], array $data = [], array $option = [])
    {
        $allData = array_merge($viewData, $data, $this->templateData);
        $this->set('contents', view($view, $allData));
        $this->set('_script', $this->js);
        $this->set('_style', $this->css);
        $this->set('data', $allData);
        // echo "this template";
        // return view($template, $this->templateData, $option);
        echo view($template, $this->templateData, $option);
    }
}
