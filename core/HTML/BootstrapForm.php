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
        return "<div  class='form-floating'>{$html}</div>";
    }

    /**
     * @param string $name
     * @param string $label
     * @param array $option
     * @return string
     */
    public function input(string $name, string $label, array $option = [])
    {
        $type = !empty($option["type"]) ? $option["type"] : "text";
        $maxlength = !empty($option["maxlength"]) ? "maxlength='{$option['maxlength']}'" : \null;
        if ($type === "textarea") {
            $input = "<textarea class='form-control' placeholder='{$this->getValue($name)}' id='{$name}' style='height: 200px' required></textarea>";
            $label = "<label for='{$name}'>{$label}</label>";
        } else {
            $input = "<input type='{$type}' class='form-control' id='{$name}' placeholder='{$this->getValue($name)}' {$maxlength} required>";
            $label = "<label for='{$name}' class='floatingInput'>{$label}</label>";
        }

        return $this->surround($input . $label);
    }

    public function select($name, $label, $options)
    {
        $label = "<label for='floatingSelect'>{$label}</label>";
        $input = "<select class='form-select' id='floatingSelect' name='{$name}'>";
        foreach ($options as $k => $v) {
            $attributes = "";
            if ($k == $this->getValue($name)) {
                $attributes = 'selected';
            }
            $input .= "<option value='{$k}' {$attributes}>{$v}</option>";
        }
        $input .= "</select>";

        return $this->surround($input . $label);
    }

    /**
     * @return string
     */
    public function submit()
    {
        return $this->surround("<button type='submit' class='btn btn-primary'>Envoyer</button>");
    }
}
