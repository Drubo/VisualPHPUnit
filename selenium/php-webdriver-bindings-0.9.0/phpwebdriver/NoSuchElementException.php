<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NoSuchElementException
 *
 * @author kolec
 */
class NoSuchElementException extends WebDriverException {
    private $json_response;
    public function __construct($json_response, $msg = "No such element exception") {
        parent::__construct($msg, WebDriverResponseStatus::NoSuchElement, null);
        $this->json_response = $json_response;
    }
}
?>
