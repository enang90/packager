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

  function createJob() {
	  $url = $this->server . '/createItem?mode=copy&from=BrandMaster&name=Samson'; 
    $this->_postCurl($url);
  }

  function buildJob() {
    $url = $this->server . '/job/Goliath/build';

//    $params[] = array('name', 'Client.zip');
 //   $params[] = array('file', '@/Users/matthias/Sites/vhosts/packager.pandion.lan/app/webroot/files/Client.zip');

		
		$params="json={\"parameter\": 
		         [
         			{\"name\": \"source_type\", 
               \"value\": \"official\"}
             ], \"\": \"\"}";


    $this->_postCurl($url, $params);
  }
	
	/* function createJob() {
		App::import('Core', 'HttpSocket');
		$http = new HttpSocket();
    $auth = $this->authenticate();
    $apiCall = $this->server . '/createItem';

 		$result = $http->post($apiCall, array('name' => 'Goliath', 'mode' => 'copy', 'from' => 'BrandMaster'), $auth);

    if ($http->response['status']['code'] != 400) {
	    return TRUE;
    }

    return FALSE;
	} */
	
	/* function buildJob() {
		$this->_postCurl('');
		
		 App::import('Core', 'HttpSocket');
		$http = new HttpSocket();
    $auth = $this->authenticate();
    $apiCall = '/job/Goliath/buildWithParameters';

    $body = 'source_type=official';
    $body .= '&source_official_tag=';
    
		// The boundary string is used to identify the different parts of a
		// multipart http request
		$boundaryString = 'Next_Part_' . String::uuid();

		// Build the multipart body of the http request
		$body.= "--$boundaryString\r\n";
		$body.= "Content-Type: application/zip\r\n";
		$body.= "Content-Transfer-Encoding: binary\r\n";
		$body.= "--$boundaryString--\r\n";

    $request = array(
	    'method' => 'POST',
	    'uri' => array(
		    'host' => $this->server,
		    'path' => $apiCall,
		  ),
		  'header' => array(
		  ),
		  'auth' => array(
			  'method' => 'Basic',
			  'user' => $this->user,
			  'pass' => $this->pass,
			),
			'body' => $body,
    );

    $http->request($request);

    //$result = $http->post($apiCall, $params, $auth);
		echo "<pre>";
			var_dump($http);
		echo "</pre>";
	} */
}

