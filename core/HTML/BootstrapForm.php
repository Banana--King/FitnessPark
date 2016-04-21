<?php
namespace Core\HTML;

class BootstrapForm extends Form
{
	
    protected function surround($html)
    {
        return "<div class=\"form-group\">{$html}</div>";
    }

    public function input($name, $label = false, $options = [])
    {
        $type = isset($options['type']) ? $options['type'] : 'text';
        if($label){
            $label = '<label>' . $label . '</label>';
        }
        //var_dump($this->getValue($name));
        if($this->getValue($name) === null){
            $value = '';
        } else {
            $value = $this->getValue($name);
        }
        
        if ($type === 'textarea') {
            $input = '<textarea name="' . $name . '" class="form-control">' . $value . '</textarea>';
        } else {
            $input = '<input type="' . $type . '" name="' . $name . '" value="' . $value . '" class="form-control">';
        }

        return $this->surround($label . $input);
    }

    public function submit()
    {
        return $this->surround('<button type="submit" class="btn btn-primary">Envoyer</button>');
    }

    public function select($name, $label, $options)
    {
        $label = '<label>' . $label . '</label>';
        $input = '<select class="form-control" name="' . $name . '">';
        foreach ($options as $k => $v) {
            $attributes = '';
            if ($k == $this->getValue($name)) {
                    $attributes = ' selected';
            }
            $input .= "<option value='$k'$attributes>$v</option>";
        }
        $input .= '</select>';

        return $this->surround($label . $input);
    }
}