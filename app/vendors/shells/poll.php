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
		  
		  // Check version with status INIT or NOTIFIED for it's build status.
		  if ($version['Version']['status'] <= PACKAGER_VERSION_NOTIFIED) {
        // Check the timestamp: if it's been longer then 15 minutes: time out
        // We actually change it to a time out and then do one final check with Hudson
        if ($this->Version->data['Version']['inittime'] + 900 < time()) {
	        $this->Version->set(array('status' => PACKAGER_VERSION_TIMEOUT));
  	      $this->log("Version #" . $this->Version->id . " :: build timed out.", 'packager');
        }
			}
			
			// Check version with status PENDING for it's build status
			if ($version['Version']['status'] == PACKAGER_VERSION_NOTIFIED) {
  		  if ($this->Hudson->buildStatus($version['Brand']['name'], $version['Version']['hudson_id'])) {
					$data = $this->Hudson->getData();
					$parsed_xml =& new XML($data);
					$parsed_xml = Set::reverse($parsed_xml);
					switch ($parsed_xml['FreeStyleBuild']['result']) {
					  case HUDSON_SUCCESS:
					    $this->Version->set(array('status' => PACKAGER_VERSION_SUCCESS));
					    $this->Version->set(array('hudson_artifact' => $parsed_xml['FreeStyleBuild']['Artifact']['fileName']));
    					$this->log("Version #" . $this->Version->id . " :: build successful.", 'packager');
					    break;
					  case HUDSON_FAILURE:	
  				    $this->Version->set(array('status' => PACKAGER_VERSION_FAILURE));
              $this->log("Version #" . $this->Version->id . " :: build failed.", 'packager');
	  			    break;
					} 
        }
			}
			
			$this->Version->save(NULL, FALSE);
			$version = $this->Version->read();
			
			if ($version['Version']['status'] == PACKAGER_VERSION_SUCCESS) {
				if (!empty($version['Version']['hudson_artifact'])) {
				  if ($this->Hudson->getArtifact($version['Brand']['name'], $version['Version']['hudson_id'], $version['Version']['hudson_artifact'])) {
					  $jobName = $version['Brand']['name'];
						$this->log("Version #" . $this->Version->id . " :: successfully fetched artifact.", "packager");
	 				  $_artifactsFolder = WWW_ROOT . '/artifacts';
					  $artifactsFolder = new Folder($_artifactsFolder);
   					$jobFolder = $artifactsFolder->find($jobName);
					  
					  if (empty($jobFolder)) {
 	 					  if (!$artifactsFolder->create("$_artifactsFolder/$jobName", 0755)) {
	              $this->log("Version #" . $this->Version->id . " :: Could not create artifact folder for job '$jobname'", "packager");
	              continue; // do not create a new file in the datastore
              }
					  }
					
					  $_artifact = "$_artifactsFolder/$jobName/" . $version['Version']['hudson_artifact'];
					  $artifact = new File($_artifact, TRUE);
	          $created = $artifact->write($this->Hudson->getData())
					  $artifact->close();
					
					  if (!$created) {
              $this->log("Version #" . $this->Version->id . " :: Could not write artifact '" . $version['Version']['hudson_artifact'] . " to the datastore.'", "packager");
				  	} else {
					    $this->Version->set(array('status' => PACKAGER_VERSION_MISSINGARTIFACT);
					    $this->Version->save(NULL, FALSE);
				    }
					} else {
						$this->log("Version #" . $this->Version->id . " :: Could not retrieve artifact from Hudson.", "packager");
					}
				}
			}
		}
	}
}