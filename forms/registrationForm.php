<?php

require_once __DIR__ . '/../BaseForm.php';

class RegistrationForm extends BaseForm
{
    public $email;

    public $confirm_email;

    public $password;

    public $confirm_password;

    public $image;

    public function getAttributeLabels(): array
    {
        return [
            'email' => 'Էլ․ Փոստ',
            'confirm_email' => 'Էլ․ Փոստի կրկնություն',
            'password' => 'Գաղտնաբառ',
            'image' => 'Նկար',
            'confirm_password' => 'Գաղտնաբառի կրկնություն'
        ];

    }

    public function rules()
    {
        return [
            'email' => ['trim', 'required', 'email','unique'],
            'confirm_email' => ['trim', 'required', 'email', 'confirm'],
            'password' => ['trim', 'required'],
            'confirm_password' => ['trim', 'required','confirm'],
            'image' => ['trim', 'required', 'image']
        ];
    }
}

