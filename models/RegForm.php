<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Description of RegForm
 *
 * @author Vadim
 */
class RegForm extends Model
{
    //put your code here
    
    public $username;
    public $email;
    public $password;
    
    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'required']
        ];
    }
}
