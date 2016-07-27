<?php


namespace Eskrano\FormBuilder\Parsers;

class SelectParser
{
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function parse()
    {
        $data = $this->data;
        
        if (is_array($data)) {
            return $this->arrayParser($data);
        }
        return $this->arrayParser($data);
    }

    private function arrayParser(array $data)
    {
        $str = '';

        foreach ($data as $key  =>  $value) {
            $str .= sprintf(
                "<option value = '%s'>%s</option>",
                $key,$value
            );
        }

        return $str;
    }
}