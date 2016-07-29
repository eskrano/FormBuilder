<?php

namespace Eskrano\FormBuilder;

use Eskrano\FormBuilder\Parsers\SelectParser;

class Builder
{
    /**
     * @var PresenterInterface
     */
    public $presenter;

    private $html;

    private $form = [];

    private $submit_options = [];

    public function __construct(PresenterInterface $presenter)
    {
        $this->presenter = new $presenter;
    }

    public function text(array $options = [],$type = 'text')
    {
        return $this->input($options,$type);
    }

    public function input(array $options = [],$type = 'text')
    {
        $this->html .= sprintf(
            "<div class = '%s'><input type = '%s' class = '%s' %s></div>",
            $this->presenter->inputWrapper(),
            $type,
            $this->presenter->textFieldClass(),
            $this->parseOptions($options)
        );

        return $this;
    }
    
    public function textArea(array $options = [],$text = null)
    {
        $this->html .= sprintf(
            "<div class = '%s'><textarea class = '%s' %s>%s</textarea></div>",
            $this->presenter->inputWrapper(),
            $this->presenter->textAreaClass(),
            $this->parseOptions($options),
            $text
        );

        return $this;
    }

    public function select(array $options = [],$values)
    {
        $this->html .= sprintf(
            "<div class = '%s'><select class = '%s' %s>%s</select></div>",
            $this->presenter->inputWrapper(),
            $this->presenter->selectFieldClass(),
            $this->parseOptions($options),
            (new SelectParser($values))->parse()
        );

        return $this;
    }

    public function button(array $options = [])
    {
        $this->html .= sprintf(
            "<div class = '%s'><input type ='submit' class = '%s' %s></div>",
            $this->presenter->inputWrapper(),
            $this->presenter->buttonSubmitClass(),
            $this->parseOptions($options)
        );

        return $this;
    }


    public function customHtml($contents)
    {
        $this->html .= $contents;

        return $this;
    }

    public function getHtml()
    {
        return $this->html;
    }

    public function copy()
    {
        return new static($this->presenter);
    }


    public function block($classname,callable $callback)
    {
        $this->html .= sprintf(
            "<div class = '%s'>%s</div>",
            $classname,
            $callback($this->copy()));

        return $this;
    }



    public function setSubmitOptions(array $options = [])
    {
        $this->submit_options = $options;

        return $this;
    }

    public function separator()
    {
        $this->html .= $this->presenter->separator();

        return $this;
    }

    public function render()
    {
        $this->button($this->submit_options);
        return $this->renderFull();
    }

    private function renderFull()
    {
        $contents = sprintf(
            "<form action = '%s' method = '%s'>",
            $this->form['action'],
            $this->form['method']
        );

        $contents .= sprintf("%s",$this->html);
        $contents .= '</form>';

        return $contents;
    }

    public function setAction($action)
    {
        $this->form['action'] = $action;

        return $this;
    }

    public function setMethod($method)
    {
        $this->form['method'] = $method;

        return $this;
    }

    private function parseOptions(array $options = [])
    {
        $html = '';

        foreach ($options as $key => $value) {
            $html = sprintf("%s = '%s'",
                $key, $value);
        }

        return $html;
    }

}