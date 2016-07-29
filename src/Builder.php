<?php

namespace Eskrano\FormBuilder;

use Eskrano\FormBuilder\Parsers\SelectParser;

class Builder
{
    /**
     * @var PresenterInterface
     */
    public $presenter;

    /**
     * @var string
     */
    private $html;

    /**
     * Form settings
     * @var array
     */
    private $form = [];

    /**
     * Submit options
     * @var array
     */
    private $submit_options = [];

    /**
     * Builder constructor.
     * @param PresenterInterface $presenter
     */
    public function __construct(PresenterInterface $presenter)
    {
        $this->presenter = new $presenter;
    }


    public function checkbox($label, array $options)
    {
        $this->html .= sprintf(
            '%s',
            $this->presenter->checkBoxClass(
                $this->parseOptions($options),
                $label
            ));

        return $this;
    }

    /**
     * Parse options
     * @param array $options
     * @return string
     */
    private function parseOptions(array $options = [])
    {
        $html = '';

        foreach ($options as $key => $value) {
            $html = sprintf("%s = '%s'",
                $key, $value);
        }

        return $html;
    }

    /**
     * @deprecated
     * @param array $options
     * @param string $type
     * @return Builder
     */
    public function text(array $options = [], $type = 'text')
    {
        return $this->input($options, $type);
    }

    /**
     * Create input field
     * @param array $options
     * @param string $type
     * @return $this
     */
    public function input(array $options = [], $type = 'text')
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

    /**
     * Create textarea field
     * @param array $options
     * @param null $text
     * @return $this
     */
    public function textArea(array $options = [], $text = null)
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

    /**
     * Create select field
     * @param array $options
     * @param $values
     * @return $this
     */
    public function select(array $options = [], $values)
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

    /**
     * Append custom html to html container
     * @param $contents string
     * @return $this
     */
    public function customHtml($contents)
    {
        $this->html .= $contents;

        return $this;
    }

    /**
     * Returns html container
     * @return string
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * @param $classname string
     * @param callable $callback
     * @return $this
     */
    public function block($classname, callable $callback)
    {
        $this->html .= sprintf(
            "<div class = '%s'>%s</div>",
            $classname,
            $callback($this->copy()));

        return $this;
    }

    /**
     * @return static
     */
    public function copy()
    {
        return new static($this->presenter);
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setSubmitOptions(array $options = [])
    {
        $this->submit_options = $options;

        return $this;
    }

    /**
     * @return $this
     */
    public function separator()
    {
        $this->html .= $this->presenter->separator();

        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        $this->button($this->submit_options);
        return $this->renderFull();
    }

    /**
     * Create button
     * @param array $options
     * @return $this
     */
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

    /**
     * @return string
     */
    private function renderFull()
    {
        $contents = sprintf(
            "<form action = '%s' method = '%s'>",
            $this->form['action'],
            $this->form['method']
        );

        $contents .= sprintf("%s", $this->html);
        $contents .= '</form>';

        return $contents;
    }

    /**
     * @param $action string
     * @return $this
     */
    public function setAction($action)
    {
        $this->form['action'] = $action;

        return $this;
    }

    /**
     * @param $method string
     * @return $this
     */
    public function setMethod($method)
    {
        $this->form['method'] = $method;

        return $this;
    }

}