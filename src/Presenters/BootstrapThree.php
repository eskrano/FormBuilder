<?php


namespace Eskrano\FormBuilder\Presenters;

use Eskrano\FormBuilder\PresenterInterface;

class BootstrapThree implements PresenterInterface
{
    public function textFieldClass()
    {
        return 'form-control';
    }

    public function textAreaClass()
    {
        return $this->textFieldClass();
    }

    public function buttonSubmitClass()
    {
        return 'btn btn-primary';
    }

    public function selectFieldClass()
    {
        return $this->textFieldClass();
    }

    public function checkBoxClass()
    {
        return '';
    }

    public function multiSelectClass()
    {
        return 'form-control';
    }

    public function inputWrapper()
    {
        return 'form-group';
    }

    public function wrapperBlock(callable $callback = null)
    {

    }

    private function colBase($type,$col,callable $callback)
    {
        return sprintf('<div class = "col-%s-%s">%s</div>',$type,$col,$callback());
    }

    public function colSm($col,callable $callback)
    {
        return $this->colBase('sm',$col,$callback);
    }

    public function colMd($col,callable $callback)
    {
        return $this->colBase('md',$col,$callback);
    }

    public function colXs($col,callable $callback)
    {
        return $this->colBase('xs',$col,$callback);
    }

    public function multiCol(array $cols, callable $callback)
    {
        $template = 'col-%s-%s ';
        $layout = '<div class = "%s">%s</div>';

        $t = '';

        foreach ($cols as $k => $v) {
            $t .= sprintf($template,$k,$v);
        }

        return sprintf($layout,$t,$callback());

    }

    public function separator()
    {
        return '<hr>';
    }

}