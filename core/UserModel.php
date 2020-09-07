<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\core;

use app\core\db\DbModel;

/**
 * Description of UserModel
 *
 * @author toyrik
 */
abstract class UserModel extends DbModel
{

    abstract public function getDisplayName(): string;
}
