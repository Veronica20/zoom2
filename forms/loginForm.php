<?php

require_once __DIR__ . '/../BaseForm.php';

class LoginForm extends BaseForm
{
    public $email;
    public $password;

    public function getAttributeLabels(): array
    {
        return [
            'email' => 'Էլ․ հասցե',
            'password' => 'Գաղտնաբառ',
        ];

    }

    public function rules()
    {
        return [
            'email' => ['trim', 'required'],
            'password' => ['trim', 'required'],
        ];
    }

}