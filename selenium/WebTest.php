<?php
require_once 'php-webdriver-bindings-0.9.0/phpwebdriver/WebDriver.php';
require_once 'php-webdriver-bindings-0.9.0/phpwebdriver/Keys.php';
require_once 'settings.php';

class WebTest extends PHPUnit_Framework_TestCase
{
    public $webdriver = null;
    public static $global_webdriver = null;

    public function __construct()
    {
        global $settings;
        $this->settings = $settings;
        $this->getOverrides();

        if (!self::$global_webdriver) {
          self::$global_webdriver = new WebDriver($this->settings->webdriver_host, $this->settings->webdriver_port, $this->settings->post_url);
          self::$global_webdriver->connect($this->settings->target_browser);
        }
        $this->webdriver = self::$global_webdriver;

        $this->setTimeouts();
    }

    protected function getOverrides() {
      global $optional_parameters_for_test;
      if (isset( $optional_parameters_for_test['Selenium Driver Host'] )) {
        $this->settings->webdriver_host = $optional_parameters_for_test['Selenium Driver Host'];
      }
    }

    protected function setTimeouts() {
      $this->timeout = 5000; //milliseconds
      if ( isset($this->settings->timeout) ) {
        $this->timeout = $this->settings->timeout;
      }

      $this->waiting_time = 500; //milliseconds
      if ( isset($this->settings->waiting_time) ) {
        $this->waiting_time = $this->settings->waiting_time;
      }
    }

    protected function setUp()
    {
    }

    /***
     * Some helper methods: Finders
     * */
    protected function findBy($locator, $identifier) {
        return $this->getElementWithWaitTime($locator, $identifier);
    }
    protected function findByName($name) {
       return $this->findBy(LocatorStrategy::name, $name);
    }
    protected function findById($Id) {
       return $this->findBy(LocatorStrategy::id, $Id);
    }
    protected function findByCss($css) {
       return $this->findBy(LocatorStrategy::cssSelector, $css);
    }
    protected function findByText($text) {
      return $this->findBy(LocatorStrategy::linkText, $text);
    }

    /***
     * Some helper methods: Typers
     * */
    protected function typeToId($id, $string)
    {
        return $this->typeTo(LocatorStrategy::id, $id, $string);
    }
    protected function typeToName($name, $string)
    {
        return $this->typeTo(LocatorStrategy::name, $name, $string);
    }
    protected function typeToCss($selector, $string)
    {
        return $this->typeTo(LocatorStrategy::cssSelector, $selector, $string);
    }
    protected function typeTo($locator, $identifier, $string) {
        $element = $this->findBy($locator, $identifier);
        $element->sendKeys(array(
            $string
        ));
        return $element;
    }

    /***
     * Some helper methods: Clickers
     * */
    protected function clickOnId($id) {
      return $this->clickOn(LocatorStrategy::id, $id);
    }
    protected function clickOnName($name) {
      return $this->clickOn(LocatorStrategy::name, $name);
    }
    protected function clickOnCss($name) {
      return $this->clickOn(LocatorStrategy::cssSelector, $name);
    }
    protected function clickOnText($name) {
      return $this->clickOn(LocatorStrategy::linkText, $name);
    }
    protected function clickOn($locator, $identifier) {
      $element = $this->findBy($locator, $identifier);
      $element->click();
      return $element;
    }

    public function clickOnSelect($name, $value) {
      $select = $this->findByName($name);
      $option = $select->findOptionElementByText($value);
      $option->click();
    }

    //helper with timeout
    public function getElementWithWaitTime( $strategy, $name ) {
        $i = 0;
        do {
            try {
                $element = $this->webdriver->findElementBy( $strategy, $name );
            } catch( NoSuchElementException $e ) {
                print_r( "\nWaiting for \"" . $name . "\" element to appear...\n" );
                usleep( $this->waiting_time * 1000 );
                $i += $this->waiting_time;
            }
        } while( !isset( $element ) && $i <= $this->timeout );
        if( !isset( $element ) )
          return null;
        return $element;
    }

	public function screenshot($filename) {
		return $this->webdriver->getScreenshotAndSaveToFile($filename);
	}
}

?>

