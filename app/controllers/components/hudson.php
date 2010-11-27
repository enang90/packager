<?php

class HudsonComponent extends Object {
	var $build;
	private $user = 'netsensei';
	private $pass = 'ciaqIEBrl11Oe7Ri';
	private $server = 'http://hudson.packager.pandion.im:8080';
	private $data;
	private $status;

  private function _postCurl($url, $params = array()) {
	  //init cURL
	  $ch = curl_init();
	
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC ) ;
		curl_setopt($ch, CURLOPT_HEADER, FALSE); 
		curl_setopt($ch, CURLOPT_USERPWD, $this->user . ':' . $this->pass);
   	curl_setopt($ch, CURLOPT_URL, $url);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   	curl_setopt($ch, CURLOPT_POST, TRUE); 

    if (!empty($params)) {
      curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    }

    // run cURL
		$data = curl_exec($ch);

    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    $this->data = $data;
    $this->status = $status;

    // result return 200, 302 for OK, 400, 500 for BAD
    if ($status == 200 || $status == 302) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * Return the data of the last executed call if set
   */
  function getData() {
	  return $this->data;
  }

  /**
   * Return the status of the last executed call if set
   */
  function getStatus() {
	  return $this->status;
  }

  /**
   * Create a new Hudson job. Copy from BrandMaster job.
   * @param string $brand The brand name. Is used as the name of the job. Should be a safe name
   * @return boolean TRUE if success, FALSE if the job could not be created
   */
  function createJob($brand_name) {
	  if ($brand_name) {
  	  $url = $this->server . "/createItem?mode=copy&from=BrandMaster&name=" . urlencode($brand_name);
      return $this->_postCurl($url);
    }

    return FALSE;
  }

  /**
   * Triggers an error: source_zip_file param
   * Verschil tussen name en name_safe?
   */
  function buildJob($jobname, $data) {
    $url = $this->server . "/job/$jobname/build";
   
    switch ($data['source_type']) {
	    case 0:
	      $source_type = 'official';
	      break;
	    case 1:
	      $source_type = 'upload';
	      break;
	    case 2:
	      $source_type = 'git';
	      break;
    }

    switch ($data['source_official_tag']) {
	    case 0:
	      $source_official_tag = 'stable';
	      break;
	    case 1:
	      $source_official_tag = 'beta';
	      break;
	    case 2:
	      $source_official_tag = 'development';
	      break;
    }

		$params="json={\"parameter\": 
		         [
         			{\"name\": \"packager_token\", 
               \"value\": \"" . $data['packager_token'] . "\"},
         			{\"name\": \"source_type\", 
               \"value\": \"" . $source_type . "\"},
         			{\"name\": \"source_official_tag\", 
               \"value\": \"" . $source_official_tag . "\"},
        			{\"name\": \"source_git_url\", 
               \"value\": \"\"},
        			{\"name\": \"version_major\", 
               \"value\": \"" . $data['version_major'] . "\"},
        			{\"name\": \"version_minor\", 
               \"value\": \"" . $data['version_minor'] . "\"},
        			{\"name\": \"version_build\", 
               \"value\": \"" . $data['version_build'] . "\"},
        			{\"name\": \"name\", 
               \"value\": \"" . $data['name'] . "\"},
        			{\"name\": \"name_safe\", 
               \"value\": \"" . $data['name_safe'] . "\"},
        			{\"name\": \"homepage_url\", 
               \"value\": \"" . $data['homepage_url'] . "\"},
        			{\"name\": \"company\", 
               \"value\": \"" . $data['company'] . "\"},
        			{\"name\": \"guid\", 
               \"value\": \"9F661F94-F17F-4F5C-B1C8-2955C85C8FE9\"},
        			{\"name\": \"support_url\", 
               \"value\": \"" . $data['support_url'] . "\"},
         			{\"name\": \"info_url\", 
               \"value\": \"" . $data['info_url'] . "\"},
             ], \"\": \"\"}";

    return $this->_postCurl($url, $params);
  }

  function buildStatus($jobName, $buildId) {
    $url = $this->server . "/job/$jobname/$buildId/api/xml";
    return $this->_postCurl($url);
  }

  function getArtifact($jobName, $buildId, $artifact) {
	  $url = $this->server . "/job/$jobName/$buildId/artifact/$artifact";
	  return $this->_postCurl($url);
  }
}