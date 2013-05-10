<?php
require_once 'WebTest.php';

class StaffModuleTest extends WebTest
{
    public function __construct()
    {
      parent::__construct();
    }

    public static function setUpBeforeClass()
    {
    }

    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }

    public static function tearDownAfterClass()
    {
    }

    public function testNotImplemented(){
      $this->webdriver->get($this->settings->application_url_base . '/');
      sleep(5);
      $this->fail("Not Implemented");
    }

    public function testLastTest() {
      $this->webdriver->close();
    }
}

?>
