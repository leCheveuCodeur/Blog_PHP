<?php

namespace Core\HTML;


/**
 * Permet de générer un formulaire Bootstap rapidement et simplement
 */
class BootstrapForm
{
    /**
     * @var array Données utilisées par le formulaire
     */
    protected $data;

    /**
     * @param array $data Données utilisées par le formulaire
     * @return void
     */
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    /**
     * @param string $index Index de la valeur à récuperer
     * @return string
     */
    protected function getValue(string $index)
    {
        if (is_object($this->data)) {
            return $this->data->$index;
        }
        return isset($this->data[$index]) ? $this->data[$index] : \null;
    }

    /**
     * @param string $html Code HTML à entourer
     * @return string
     */
    protected function surround(string $html)
    {
        return "<div class='mb-3'>{$html}</div>";
    }

    /**
     * @param string $name
     * @param string $label
     * @param array $option
     * @return string
     */
    public function input(string $name, string $label, array $option = [])
    {
        $type = isset($option["type"]) ? $option["type"] : "text";
        $label = "<label for='{$name}' class='form-label'>{$label}</label>";
        if ($type === "textarea") {
            $input = "<textarea name='{$name}' class='form-control'>{$this->getValue($name)}</textarea>";
        } else {
            $input = "<input type='{$type}' name='{$name}' class='form-control' value='{$this->getValue($name)}' required>";
        }

        return $this->surround($label . $input);
    }

    public function select($name, $label, $options)
    {
        $label = "<label>{$label}</label>";
        $input = "<select class='form-control' name='{$name}'>";
        foreach ($options as $k => $v) {
            $attributes = "";
            if ($k == $this->getValue($name)) {
                $attributes = 'selected';
            }
            $input .= "<option value='{$k}' {$attributes}>{$v}</option>";
        }
        $input .= "</select>";

        return $this->surround($label . $input);
    }

    /**
     * @return string
     */
    public function submit()
    {
        return $this->surround("<button type='submit' class='btn btn-primary'>Envoyer</button>");
    }
}
