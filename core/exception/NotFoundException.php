<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\core\exception;

/**
 * Description of NotFoundException
 *
 * @author toyrik
 */
class NotFoundException extends \Exception
{

    protected $message = 'Page not found';
    protected $code = 404;

}
