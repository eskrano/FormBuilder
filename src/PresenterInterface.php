<?php


namespace Eskrano\FormBuilder;

interface PresenterInterface
{
    public function textFieldClass();

    public function textAreaClass();

    public function inputWrapper();

    public function buttonSubmitClass();

    public function selectFieldClass();

    public function separator();

    public function checkBoxClass();

    public function multiSelectClass();

    public function wrapperBlock(callable $callback = null);
}