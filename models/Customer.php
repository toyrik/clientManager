<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\models;

/**
 * Description of Customer
 *
 * @author toyrik
 */
class Customer extends \app\core\db\DbModel
{
    public string $name;
    public string $email;
    public int $phone;
    
    public function attributes(): array
    {
        return ['name', 'email', 'phone'];
    }
    
    public function labels(): array
    {
        return [
            'name' => 'Имя',
            'email' => 'E-mail',
            'phone' => 'Телефон',
        ];
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [
                        self::RULE_UNIQUE, 'class' => self::class
                    ]],
            'phone' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6], [self::RULE_MAX, 'max' => 20]],
        ];
        
    }

    public static function tableName(): string
    {
        return 'customers';
    }
}
