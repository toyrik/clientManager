<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\core;

/**
 * Description of Response
 *
 * @author toyrik
 */
class Response
{
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }
}
