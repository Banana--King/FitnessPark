<?php
namespace Core\HTML;

class Form
{
    protected $data;
    protected $surround = 'p';

    public function __construct($data = array())
    {
        $this->data = $data;
    }

    protected function surround($html)
    {
        return "<{$this->surround}>{$html}</{$this->surround}>";
    }

    protected function getValue($index)
    {
        //var_dump($this->data->$index === null);
        if (is_object($this->data)) {
            if(!property_exists($this->data, $index)){
                return '';
            }
            return $this->data->$index;
        }
        
        return isset($this->data[$index]) ? $this->data[$index] : null;
    }

    public function input($name, $label = false, $options = [])
    {
        $type = isset($options['type']) ? $options['type'] : 'text';
        return $this->surround('<input type="' . $type . '" name="' . $name . '" value="' . $this->getValue($name) . '">');
    }

    public function submit()
    {
        return $this->surround('<button type="submit">Envoyer</button>');
    }

}