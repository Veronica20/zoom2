<?php

require_once __DIR__ . '/../BaseForm.php';

class LoanForm extends BaseForm
{
    public $currency;

    public $money;

    public $county;

    public function getAttributeLabels(): array
    {
        return [
            'currency' => 'Արժույթ',
            'money' => 'Գումար',
            'county' => 'Քաղաք',
        ];

    }

    public function rules()
    {
        return [
            'currency' => ['trim', 'required'],
            'money' => ['trim', 'required'],
            'county' => ['trim', 'required'],
        ];
    }

}