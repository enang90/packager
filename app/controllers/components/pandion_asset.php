<?php
/**
 * This component creates an empty folder structure for a single brand. It also manages
 * this folder structure: allowing storage of any files in the correct folder: images, icons,
 * artifacts,...
 * Brand folder structure:
 *  /Brand
 *   -> Versions
 *     -> version_1_1_2
 *       -> Artifact
 *       -> Uploads
 *   -> Logs
 *   -> Files
 */
class PandionAssetComponent extends Object {
  var $brandsFolder;
  var $pandionFolderStructure;
  var $brandFolder = NULL;
  var $errors = array();
  var $messages = array();
  
  function __construct() {
    parent::__construct();
    
    // define a $brand folder structure
    $this->pandionFolderStructure = array(
      'versions',
      'logs',
      'files',
    );
  }
  
  
  /**
   * Sets the active brand folder. 
   * Checks if the folder doesn't exists. Subsequent actions (creation of version,...)
   * will happen within the active brand folder. Set this first before you do anything else.
   *
   * @param string $brandName the name of the brand folder
   * @return boolean TRUE if exists, FALSE if not
   */
  function setBrandFolder($brandName) {
    // Set the brands folder
    $brandsFolder = Configure::read('Pandion.files.brands.folder');
    $this->brandsFolder = new Folder(WWW_ROOT . $brandsFolder['value']);
    $this->brandFolder = $this->brandsFolder->path . '/' . $brandName;
  }  
  
  /**
   * Create the brand folder structure.
   * This function creates a folder structure as defined in pandionFolderStructure
   * Should only be executed when a brand is added.
   */
  function createBrandFolder() {
    foreach ($this->pandionFolderStructure as $folder) {
      $create = $this->brandFolder . '/' . $folder;
      if (!$this->brandsFolder->create($create,	0755)) {
        $this->errors += $this->brandsFolder->errors();
      }
    }

    $result = (empty($this->errors)) ? $this->brandFolder : FALSE;
    return $result;
  }

  /**
   * Create a new version folder in $brand/versions
   */
  function createVersion($versionName = NUll) {
  }
  
  /**
   * Checks whether a version folder in $brand/versions/$versionName already exists
   * @return boolean TRUE if exists, FALSE if not
   */
  function versionExists($versionName = NULL) {
    if (($versionName) && ($this->brandFolder)) {
      $versionFolder = $this->brandFolder . '/versions';
      $folder	=	new	Folder($versionFolder);
      return $this->_folderExists($folder, $versiondName);      
    } else {
      return FALSE;
    }
  }
  
  /**
   * Generic folder checking function
   * Checks whether or not a folder does exist within a parent
   * @param Folder $folder an object of type Folder
   * @param String $regexpPattern a Regexp Pattern string to match against the folder contents
   * @return Array An array of matching dirs or an empty array if nothing was found
   */
	function _folderExists(Folder &$folder, $regexpPattern = '.*') {
	  list($dirs, $files) = $folder->read();
	  return array_values(preg_grep('/^' . $regexpPattern . '$/i', $dirs));
	}
	
	function errors() {
	  if (empty($this->errors)) {
	    return FALSE;
	  }

	  return $this->errors;
	}
  
  /**
   * Create a new brand folder 
   */
  /* function createBrandFolder($brandName) {
    $_brandName = $brandName;
    $brandsFolder	=	new	Folder($this->brandsFolder);
    $brandFolder = $this->_folderExists($brandsFolder, $_brandName);

    if (empty($brandFolder)) {
      if (!$brandsFolder->create("$this->brandsFolder/$brandName",	0755)) {
        $this->log("Brand #" . $brandName .	"	:: Could not create Brand folder", "pandion");
        return FALSE;
      }
      
      $this->brandFolder = "$this->brandsFolder/$brandName";      
      return TRUE;
    }

    $this->log("Brand #" . $brandName .	"	:: folder already exists", "pandion");
    return FALSE;
	}
	
	function getBrandFolder($brandName = NULL) {
	  $_brandName = md5($brandName);
    $brandsFolder	=	new	Folder($this->brandsFolder);
    $brandFolder = $this->_folderExists($brandsFolder, $_brandName);
    
    if (empty($brandFolder)) {
      $this->log("Brand #" . $brandName .	"	:: folder does not exist", "pandion");
      return FALSE;
    }
    
    return $brandFolder;
  } */
}