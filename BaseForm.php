<?php

abstract class BaseForm
{
    protected $errors = [];

    public function getAttributes() : array
    {
        return get_object_vars($this);
    }

    public function setAttributes(array $data) : void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function getAttributeLabels() : array
    {
        return array_combine(array_keys($this->getAttributes()), array_keys($this->getAttributes()));
    }

    public function getAttributeLabel($attribute) : ?string
    {
        return $this->getAttributeLabels()[$attribute] ?? null;
    }

    public function validate()
    {
        foreach ($this->rules() as $key => $validators) {
            foreach ($validators as $validator) {
                if (empty($this->errors[$key])) {
                    $this->$validator($key);
                }
            }
        }
    }

    public function hasErrors()
    {
        return !empty($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function hasError($key)
    {
        return !empty($this->errors[$key]);
    }

    public function getError($key)
    {
        return $this->errors[$key] ?? '';
    }

    public function addError($key, $message)
    {
        $this->errors[$key] = $message;
    }

    public function rules()
    {
        return [];
    }

    private function trim($key)
    {
        $this->$key = trim($this->$key);
    }

    private function required($key){
        if(empty($this->$key)){
           $this->errors[$key] = $this->getAttributeLabel($key) . ' դաշտը պարտադիր է';
        }
    }
    private function email($key){
        if(filter_var($this->$key, FILTER_VALIDATE_EMAIL) === false){
            $this->errors[$key] = $this->getAttributeLabel($key).' Անվավեր Էլ․ հասցե Է';
        }
    }

    private function image($key){
        if (!@getimagesize($this->$key)) {
            $this->errors[$key] = $this->getAttributeLabel($key).' Անվավեր նկար Է';
        }
    }

    private function confirm($key){
        $targetKey = str_replace('confirm_', '', $key);

        if ($this->$key != $this->$targetKey) {
            $this->errors[$key] = $this->getAttributeLabel($key).' պետք է համընկնի ' . $this->getAttributeLabel($targetKey) . 'ին';
        }
    }

    private function unique($key){
       if(!empty((new DB())->checkUserExist($this))){
           $this->errors[$key] = $this->getAttributeLabel($key).'Էլ հասցեն արդեն զբաղված է';
       }
    }
}