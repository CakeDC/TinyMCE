<?php
class TinyMceController extends TinyMceAppController {
/**
 * Name
 *
 * @var string name
 * @access public
 */
	public $name = 'TinyMce';
/**
 * Models
 *
 * @var array uses
 * @access public
 */
	public $uses = array();
/**
 * JS
 *
 * @param string $theme
 * @param string $type
 * @param string $file
 * @access public
 */
	public function js($path = null) {
		if (!$path) {
			return;
		}
		Configure::write('debug', 0);
		$path = func_get_args();
		$file = array_pop($path);
		$path = implode(DS, $path);

		$this->view = 'Media';
		$this->autoLayout = false;
		if (!empty($this->params['url']['ext']) && ($this->params['url']['ext'] != 'html')) {
			$file .= '.' . $this->params['url']['ext'];
		}
		$extension = array_pop(explode('.', $file));

		$this->set('cache', '999 days');
		$this->set('download', false);
		$this->set('extension', $extension);
		$this->set('id', $file);
		$this->set('path', 'plugins' . DS . 'tiny_mce'. DS . 'vendors' . DS . 'tiny_mce' . DS . $path . DS);
		$this->render();
	}
}
?>