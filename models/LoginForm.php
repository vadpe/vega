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
 * Description of LoginForm
 *
 * @author Vadim
 */
class LoginForm extends Model
{
    //put your code here
    
    public $username;
    public $password;
    
    public function rules()
    {
        return [
            [['username', 'password'], 'required']
        ];
    }
}
