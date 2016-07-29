<?php


namespace Eskrano\FormBuilder;

interface PresenterInterface
{
    /**
     * @return string
     */
    public function textFieldClass();

    /**
     * @return string
     */
    public function textAreaClass();

    /**
     * @return string
     */
    public function inputWrapper();

    /**
     * @return string
     */
    public function buttonSubmitClass();

    /**
     * @return string
     */
    public function selectFieldClass();

    /**
     * @return string
     */
    public function separator();

    /**
     * @param string $options
     * @return string
     */
    public function checkBoxClass($options,$label);

    /**
     * @return string
     */
    public function multiSelectClass();

    /**
     * @param callable $callback
     * @return string
     */
    public function wrapperBlock(callable $callback = null);
}