<?php
namespace htmltodocx;

require_once 'phpword/bootstrap.php';
require_once 'simplehtmldom/simple_html_dom.php';
require_once 'htmltodocx_converter/h2d_htmlconverter.php';
require_once 'styles.inc';

use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\PhpWord;

class html2docx {
	
	var $phpword_object;
	var $section;
	
    public function __construct() {
		// Load the files we need:
		/*require_once 'html2docx/phpword/PHPWord.php';
		require_once 'html2docx/simplehtmldom/simple_html_dom.php';
		require_once 'html2docx/htmltodocx_converter/h2d_htmlconverter.php';
		require_once 'html2docx/styles.inc';*/
		
		/*$this->phpword_object = new PHPWord();
		
		$style = array('marginTop'=>2400 , 'marginBottom'=>2200);
		$this->section = $this->phpword_object->createSection($style);*/


        $this->phpword_object = new PhpWord();

        $style = array('marginTop'=>2400 , 'marginBottom'=>2200);
        $this->section = $this->phpword_object->addSection($style);
        Settings::setOutputEscapingEnabled(true);
        Settings::loadConfig();
    }
    /**
     * @param $size
     * @return float
     */
    public function Converter($size){
        return $this->Converter=Converter::cmToEmu($size);
    }

    /**
     * @param $html
     * @return \PhpOffice\PhpWord\Element\Section
     */
    public function html($html){
        $this->html=Html::addHtml($this->section, $html, false, false);
        return $this->section;
    }
	/**
	 * 
	 * @return PHPWord
	 */
    public function & getPHPWordObject() {
		return $this->phpword_object;
	}
	/**
	 * 
	 * @return PHPWord_Section
	 */
    public function & getPHPWordSection() {
		return $this->section;
	}

    /**
     * @param $html
     * @param string $filename
     */
    public function convertHTML($html , $filename = 'doc.docx'){
        $this->addHtml($html);
        $this->phpword_object->save($filename, 'Word2007',true);
    }

    /**
     * @param $html
     */
    public function addHtml($html){
        // New Word Document:
        $phpword_object = &$this->phpword_object;
        $section = &$this->section;

        // HTML Dom object:
        $html_dom = new simple_html_dom();
        $html_dom->load('<html><body>' . $html . '</body></html>');

        // Note, we needed to nest the html in a couple of dummy elements.
        // Create the dom array of elements which we are going to work on:
        $html_dom_array = $html_dom->find('html',0)->children();
        // We need this for setting base_root and base_path in the initial_state array
        // (below). We are using a function here (derived from Drupal) to create these
        // paths automatically - you may want to do something different in your
        // implementation. This function is in the included file
        // documentation/support_functions.inc.
        $paths = $this->htmltodocx_paths();
        // Provide some initial settings:
        $initial_state = array(
            // Required parameters:
            'phpword_object' => &$phpword_object, // Must be passed by reference.
            // 'base_root' => 'http://test.local', // Required for link elements - change it to your domain.
            // 'base_path' => '/htmltodocx/documentation/', // Path from base_root to whatever url your links are relative to.
            'base_root' => $paths['base_root'],
            'base_path' => $paths['base_path'],
            // Optional parameters - showing the defaults if you don't set anything:
            'current_style' => array('size' => '11'), // The PHPWord style on the top element - may be inherited by descendent elements.
            'parents' => array(0 => 'body'), // Our parent is body.
            'list_depth' => 0, // This is the current depth of any current list.
            'context' => 'section', // Possible values - section, footer or header.
            'pseudo_list' => TRUE, // NOTE: Word lists not yet supported (TRUE is the only option at present).
            'pseudo_list_indicator_font_name' => 'Wingdings', // Bullet indicator font.
            'pseudo_list_indicator_font_size' => '7', // Bullet indicator size.
            'pseudo_list_indicator_character' => 'l ', // Gives a circle bullet point with wingdings.
            'table_allowed' => TRUE, // Note, if you are adding this html into a PHPWord table you should set this to FALSE: tables cannot be nested in PHPWord.
            'treat_div_as_paragraph' => TRUE, // If set to TRUE, each new div will trigger a new line in the Word document.
            // Optional - no default:
            'style_sheet' => htmltodocx_styles_example(), // This is an array (the "style sheet") - returned by htmltodocx_styles_example() here (in styles.inc) - see this function for an example of how to construct this array.
        );
        htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $initial_state);
        $html_dom->clear();
        unset($html_dom);
    }

	/**
	 * Computes base root, base path, and base url.
	 * 
	 * This code is adapted from Drupal function conf_init, see:
	 * http://api.drupal.org/api/drupal/includes%21bootstrap.inc/function/conf_init/6
	 * 
	 */
	function htmltodocx_paths() {

	  if (!isset($_SERVER['SERVER_PROTOCOL']) || ($_SERVER['SERVER_PROTOCOL'] != 'HTTP/1.0' && $_SERVER['SERVER_PROTOCOL'] != 'HTTP/1.1')) {
		$_SERVER['SERVER_PROTOCOL'] = 'HTTP/1.0';
	  }

	  if (isset($_SERVER['HTTP_HOST'])) {
		// As HTTP_HOST is user input, ensure it only contains characters allowed
		// in hostnames. See RFC 952 (and RFC 2181).
		// $_SERVER['HTTP_HOST'] is lowercased here per specifications.
		$_SERVER['HTTP_HOST'] = strtolower($_SERVER['HTTP_HOST']);
		if (!$this->htmltodocx_valid_http_host($_SERVER['HTTP_HOST'])) {
		  // HTTP_HOST is invalid, e.g. if containing slashes it may be an attack.
		  header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
		  exit;
		}
	  }
	  else {
		// Some pre-HTTP/1.1 clients will not send a Host header. Ensure the key is
		// defined for E_ALL compliance.
		$_SERVER['HTTP_HOST'] = '';
	  }

	  // Create base URL
	  $base_root = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http';

	  $base_url = $base_root .= '://' . $_SERVER['HTTP_HOST'];

	  // $_SERVER['SCRIPT_NAME'] can, in contrast to $_SERVER['PHP_SELF'], not
	  // be modified by a visitor.
	  if ($dir = trim(dirname($_SERVER['SCRIPT_NAME']), '\,/')) {
		$base_path = "/$dir";
		$base_url .= $base_path;
		$base_path .= '/';
	  }
	  else {
		$base_path = '/';
	  }

	  return array(
		'base_path' => $base_path,
		'base_url' => $base_url,
		'base_root' => $base_root,
	  );

	}

	/**
	 * Check for valid http host.
	 * 
	 * This code is adapted from function drupal_valid_http_host, see:
	 * http://api.drupal.org/api/drupal/includes%21bootstrap.inc/function/drupal_valid_http_host/6
	 * 
	 * @param mixed $host
	 * @return int
	 */
	function htmltodocx_valid_http_host($host) {
	  return preg_match('/^\[?(?:[a-z0-9-:\]_]+\.?)+$/', $host);
	}	
}
?>
