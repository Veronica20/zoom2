<?php

require_once __DIR__ . '/../BaseForm.php';

class PersonalForm extends BaseForm
{
    public $name;
    public $surname;
    public $sex;
    public $year;
    public $month;
    public $day;
    public $address;
    public $family_count;
    public $identity_type;
    public $identity_number;
    public $given_year;
    public $given_month;
    public $given_day;
    public $given_person;

    public function getAttributeLabels(): array
    {
        return [
            'name' => 'Անուն',
            'surname' => 'Ազգանուն',
            'sex' => 'Սեռ',
            'year' => 'Տարի',
            'month' => 'Ամիս',
            'day' => 'Օր',
            'address' => 'Հասցե',
            'family_count' => 'Ընտ․ Անդ․ Քանակ',
            'identity_type' => 'Փաստաթուղթ',
            'identity_number' => 'Սերիա',
            'given_year' => 'Տրված Տարի',
            'given_month' => 'Տրված Ամիս',
            'given_day' => 'Տրված Օր',
            'given_person' => 'Ում Կողմից'
        ];

    }

    public function rules()
    {
        return [
            'name' => ['trim', 'required'],
            'surname' => ['trim', 'required'],
            'sex' => ['trim', 'required'],
            'year' => ['trim', 'required'],
            'month' => ['trim', 'required'],
            'day' => ['trim', 'required'],
            'address' => ['trim', 'required'],
            'family_count' => ['trim', 'required'],
            'identity_type' => ['trim', 'required'],
            'identity_number' => ['trim', 'required'],
            'given_year' => ['trim', 'required'],
            'given_month' => ['trim', 'required'],
            'given_day' => ['trim', 'required'],
            'given_person' => ['trim', 'required'],
        ];
    }

}