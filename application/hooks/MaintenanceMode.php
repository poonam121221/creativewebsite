<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MaintenanceMode{
	
    public function __construct(){
        log_message('debug','Accessing maintenance hook!');
    }
    
    public function offline_check(){
    	
      if(file_exists(APPPATH.'config/cms_config.php')){
		 include(APPPATH.'config/cms_config.php');
    	
    	$website_url_segment = $this->_parse_request_uri();
    	if(is_array($website_url_segment)==TRUE){
    		
	       if(strtolower($website_url_segment[0])!="manage"){
		       if(isset($config['maintenance_mode']) && $config['maintenance_mode'] === TRUE){
		             include(APPPATH.'views/maintenance.php');
		             exit;
		        }
		   }//end check url segment
		   			
		}else{
		            
		  if(isset($config['maintenance_mode']) && $config['maintenance_mode'] === TRUE){
		     include(APPPATH.'views/maintenance.php');
		     exit;
		  }
			return FALSE;
		}//end check array
	 }
    }//end offline_check function
	
	protected function _parse_request_uri(){
		if ( ! isset($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME']))
		{
			return '';
		}

		// parse_url() returns false if no host is present, but the path or query string
		// contains a colon followed by a number
		$uri = parse_url('http://dummy'.$_SERVER['REQUEST_URI']);
		$query = isset($uri['query']) ? $uri['query'] : '';
		$uri = isset($uri['path']) ? $uri['path'] : '';

		if (isset($_SERVER['SCRIPT_NAME'][0]))
		{
			if (strpos($uri, $_SERVER['SCRIPT_NAME']) === 0)
			{
				$uri = (string) substr($uri, strlen($_SERVER['SCRIPT_NAME']));
			}
			elseif (strpos($uri, dirname($_SERVER['SCRIPT_NAME'])) === 0)
			{
				$uri = (string) substr($uri, strlen(dirname($_SERVER['SCRIPT_NAME'])));
			}
		}

		// This section ensures that even on servers that require the URI to be in the query string (Nginx) a correct
		// URI is found, and also fixes the QUERY_STRING server var and $_GET array.
		if (trim($uri, '/') === '' && strncmp($query, '/', 1) === 0)
		{
			$query = explode('?', $query, 2);
			$uri = $query[0];
			$_SERVER['QUERY_STRING'] = isset($query[1]) ? $query[1] : '';
		}
		else
		{
			$_SERVER['QUERY_STRING'] = $query;
		}

		parse_str($_SERVER['QUERY_STRING'], $_GET);

		if ($uri === '/' OR $uri === '')
		{
			return '/';
		}

		// Do some final cleaning of the URI and return it
		return $this->_remove_relative_directory($uri);
	}
	
	protected function _remove_relative_directory($uri){
		$uris = array();
		$tok = strtok($uri, '/');
		
		while ($tok !== FALSE)
		{
			if (( ! empty($tok) OR $tok === '0') && $tok !== '..')
			{
				$uris[] = $tok;
			}
			$tok = strtok('/');
		}

		return $uris;
	}
	
}//END CLASS MaintenanceMode