<?php

define('HUDSON_SUCCESS', 'SUCCESS');
define('HUDSON_FAILURE', 'FAILURE');

class PollShell extends Shell {
	var $uses = array('Version');
	
	/**
	 * Checks the status of a build with Hudson. Saves the status for the version with the packager
	 * Since this is a shell command: should be called from CLI as 'cake poll'
	 * ATTENTION: mind the app/ path when you do this!
	 */
	function main() {
		App::import('Component', 'Hudson');
		App::import('Xml');
		
		$this->Hudson = new HudsonComponent();
		
		$versions = $this->Version->find('all');
		foreach ($versions as $version) {
		  $this->Version->read(NULL, $version['Version']['id']);
		  if ($version['Version']['status'] == 1) {
  		  if ($this->Hudson->buildStatus($version['Brand']['name'], $version['Version']['hudson_id'])) {
					$data = $this->Hudson->getData();
					$parsed_xml =& new XML($data);
					$parsed_xml = Set::reverse($parsed_xml);
					
					switch ($parsed_xml['FreeStyleBuild']['result']) {
					  case HUDSON_SUCCESS:
					    $this->Version->set(array('status' => 2));
					    break;
					  case HUDSON_FAILURE:	
  				    $this->Version->set(array('status' => 3));
	  			    break;
					}
					
					$this->Version->save(NULL, FALSE);
        }
			}
		}
		
		// @todo: downlaod artifact on success and place it in a datastore (to be defined)
	}
}