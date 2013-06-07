<?php 
class phpunit_tests extends CI_Controller
{
  private $directory;
  private $visual_phpunit_path;

  /**
   * Runs tests just as VisualPHPUnit does in Home controller
   * but first sets a global reference to CodeIgniter instance
   * so that unit tests can refer to CodeIgniter methods
   * */
  function run() {
    $GLOBALS['ci_instance'] =& get_instance();
    $GLOBALS['ci_controller'] =& $this;

    require $this->visual_phpunit_path  . '/app/config/bootstrap.php';
    $request = new \nx\core\Request();
    $home_controller = new \app\controller\Home();
    $results = $home_controller->index($request);

    echo json_encode($results);
  }

  /**
   *
   * Everything below is setting up paths and loading 
   * VisualPHPUnit classes
   *
   * */
  function __construct()
  {
    $this->directory = pathinfo(__FILE__, PATHINFO_DIRNAME);
    parent::__construct(__FILE__);
    $this->_load_settings();
    $this->_set_include_paths();
    $this->_load_requirements();
  }

  function _load_settings() {
    $this->pear_path = '/usr/share/pear';
    $this->visual_phpunit_path = realpath($this->directory . '/../../tests/VisualPHPUnit');
  }

  function _set_include_paths() {
    $this->_append_include_path($this->pear_path);
    $this->_append_include_path($this->visual_phpunit_path);
  }

  function _append_include_path($path) {
    set_include_path(
        get_include_path()
        . PATH_SEPARATOR
        . $path
    );
  }

  function _load_requirements() {
    $this->_load_phpunit();
    $this->_load_vpu();
  }

  function _load_phpunit() {
    require_once 'PHPUnit/Autoload.php';
    require_once 'PHPUnit/Util/Log/JSON.php';
  }

  function _load_vpu() {
    include('app/lib/VPU.php');
    $this->vpu = new \app\lib\VPU();
  }
}


// End of file example_test.php */
// Location: ./system/application/controllers/test/example_test.php */

