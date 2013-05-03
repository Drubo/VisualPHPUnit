<?php
require_once 'phpwebdriver/WebDriver.php';

class WebTest extends PHPUnit_Framework_TestCase
{
    public static $webdriver = null;
    public static $host = 'http://localhost:8080/';
    
    public function __construct()
    {
        if (!self::$webdriver) {
            //self::$webdriver = new WebDriver("localhost", 9515, "/");
            //self::$webdriver->connect("chrome");

            self::$webdriver = new WebDriver("localhost", 4444);
            self::$webdriver->connect("firefox");

            //self::$webdriver = new WebDriver("localhost", 4444);
            //self::$webdriver->connect("safari");
        }
        if (!self::$webdriver) {
          throw new Exception("\$webdriver not loaded!");
        }
    }
    protected function setUp()
    {
    }
    public function _testJavascript()
    {
        self::$webdriver->get(self::$host . 'scholarship/javascript_test');
        sleep(50);
    }
    public function testCreateAccount()
    {
        self::$webdriver->get(self::$host . 'scholarship/create_account');
        $this->typeToId("email", "ryant+freshmantest@eng.utah.edu");
        $this->typeToId('password', 'mytest');
        $this->typeToId('confirm_password', 'mytest');
        $element = self::$webdriver->findElementBy(LocatorStrategy::name, "Submit");
        $element->click();
        sleep(3);
        $next_button = self::$webdriver->findElementBy(LocatorStrategy::cssSelector, "input.button");
        $next_button->click();
        sleep(5);
        $first_name_element = self::$webdriver->findElementBy(LocatorStrategy::name, "first_name");
        $this->assertTrue($first_name_element != null);
    }
    public function testLogin()
    {
        self::$webdriver->get(self::$host . 'scholarship/login');
        $this->typeToId("email", "ryant+freshmantest@eng.utah.edu");
        $this->typeToId('password', 'mytest');
        $element = self::$webdriver->findElementBy(LocatorStrategy::name, "Submit");
        $element->click();
        sleep(5);
    }
    public function _testDeleteAccount()
    {
        self::$webdriver->get(self::$host . 'scholarship/submission/permanently_delete_my_account');
        $element = self::$webdriver->findElementBy(LocatorStrategy::id, "account_email");
        $this->assertTrue($element->getText() == "ryant+freshmantest@eng.utah.edu");
        $confirm_element = self::$webdriver->findElementBy(LocatorStrategy::linkText, "Yes!");
        $this->assertTrue($confirm_element->getText() == "Yes!");
        $confirm_element->click();
    }
    public function _testLastTest()
    {
        sleep(5);
        self::$webdriver->close();
    }
    
    private function typeToId($id, $string)
    {
        $element = self::$webdriver->findElementBy(LocatorStrategy::id, $id);
        if ($element) {
          $element->sendKeys(array(
              $string
          ));
        }
    }
    private function typeToName($name, $string)
    {
        $element = self::$webdriver->findElementBy(LocatorStrategy::name, $name);
        $element->sendKeys(array(
            $string
        ));
    }
}
?>

