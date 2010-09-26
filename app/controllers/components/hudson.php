<?php

class HudsonComponent extends Object {
	var $build;
	private $user = 'netsensei';
	private $pass = 'ciaqIEBrl11Oe7Ri';
	private $server = 'http://hudson.packager.pandion.im:8080';

  private function _postCurl($url, $params = array()) {
	  //init cURL
	  $ch = curl_init();
	
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC ) ;
		curl_setopt($ch, CURLOPT_HEADER, true); 
		curl_setopt($ch, CURLOPT_USERPWD, $this->user . ':' . $this->pass);
   	curl_setopt($ch, CURLOPT_URL, $url);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   	curl_setopt($ch, CURLOPT_POST, TRUE); 
echo "<pre>";
	var_dump($url);
echo "</pre>";
echo "<pre>";
	var_dump($params);
echo "</pre>";
    if (!empty($params)) {
      curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    }

    // run cURL
		$data = curl_exec($ch);

    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
echo "<pre>";
	var_dump($data);
echo "</pre>";
echo "<pre>";
	var_dump($status);
echo "</pre>";

    // result return 200, 302 for OK, 400, 500 for BAD
    if ($status == 200 || $status == 302) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * Create a new Hudson job. Copy from BrandMaster job.
   * @param string $brand The brand name. Is used as the name of the job. Should be a safe name
   * @return boolean TRUE if success, FALSE if the job could not be created
   */
  function createJob($brand) {
	  if ($brand) {
  	  $url = $this->server . "/createItem?mode=copy&from=BrandMaster&name=" . urlencode($brand);
      return $this->_postCurl($url);
    }

    return FALSE;
  }

  /**
   * Triggers an error: source_zip_file param
   * Verschil tussen name en name_safe?
   */
  function buildJob($data) {
    $url = $this->server . '/job/Goliath/build';
		
		$params="json={\"parameter\": 
		         [
         			{\"name\": \"source_type\", 
               \"value\": \"official\"},
         			{\"name\": \"source_official_tag\", 
               \"value\": \"stable\"},
         			{\"name\": \"source_official_tag\", 
               \"value\": \"stable\"},
        			{\"name\": \"source_git_url\", 
               \"value\": \"\"},
        			{\"name\": \"version_major\", 
               \"value\": \"0\"},
        			{\"name\": \"version_minor\", 
               \"value\": \"0\"},
        			{\"name\": \"version_build\", 
               \"value\": \"2\"},
        			{\"name\": \"name\", 
               \"value\": \"Goliath\"},
        			{\"name\": \"name_safe\", 
               \"value\": \"Goliath\"},
        			{\"name\": \"homepage_url\", 
               \"value\": \"http://netsensei.nl\"},
        			{\"name\": \"company\", 
               \"value\": \"test\"},
        			{\"name\": \"guid\", 
               \"value\": \"9F661F94-F17F-4F5C-B1C8-2955C85C8FE9\"},
        			{\"name\": \"support_url\", 
               \"value\": \"http://netsensei.nl\"},
         			{\"name\": \"info_url\", 
                \"value\": \"http://netsensei.nl\"},
             ], \"\": \"\"}";

    return $this->_postCurl($url, $params);
  }
}

