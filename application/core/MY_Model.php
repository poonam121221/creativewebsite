<?php
class MY_Model extends CI_Model{

	protected $_QueryString ="";
	private $CI;
	public $outputParams;
	
	function __construct(){
		parent::__construct();
		$this->CI = & get_instance();
		$this->CI->load->helper(array('cms_helper'));
	}
	
	public function getmax($tbl="",$column="",$alias="",$filter=array()){
		
	 if(trim($tbl)!="" && trim($column)!=""){
	 	if(trim($alias)==""){$alias = "max_num";}
		
		$this->db->select_max($column, $alias);
		if(count($filter)>0){
			$this->db->where($filter);
		}		
		$query = $this->db->get($tbl); // Produces: SELECT MAX(age) as member_age FROM members
		if($query->num_rows()>0){
			    return $query->row()->$alias;
		}else{
			return 0;
		}
		    
	 }else{
	 	return 0;
	 }
		
	}//end getmax function
	
	public function getmin($tbl="",$column="",$alias="",$filter=array()){
		
	 if(trim($tbl)!="" && trim($column)!=""){
	 	if(trim($alias)==""){$alias = "min_num";}
		
		$this->db->select_min($column, $alias);
		if(count($filter)>0){
			$this->db->where($filter);
		}		
		$query = $this->db->get($tbl); // Produces: SELECT min(age) as member_age FROM members
		if($query->num_rows()>0){
			    return $query->row()->$alias;
		}else{
			return 0;
		}
		    
	 }else{
	 	return 0;
	 }
		
	}//end getmin function
	
	public function insertsql($tbl,$data=array()){
	
	try{
		if(count($data)>0 && $tbl !=null){			
		  if($this->db->insert($tbl,$data)){
		  	$inserted_id = $this->db->insert_id();
			return $inserted_id;
		  }
	    }
		return 0;
	}catch(Exception $ex){
		$error = $this->db->error();
		var_dump($ex->getMessage());
		return 0;
	}
	  
	}//end insertdata function
		
	public function insertdata($tbl,$data=array(),$log_activity='',$is_create=TRUE,$u_id=0,$log_table='admin'){
	
	try{
		if(count($data)>0 && $tbl !=null){			
		  if($this->db->insert($tbl,$data)){
		  	//$this->_QueryString = $this->db->insert_string($tbl,$data);
		  	$this->_QueryString = "";
		  	$this->_createLog($this->_QueryString,$log_activity,$is_create,$u_id,$log_table);
			return TRUE;
		  }
	    }
		return FALSE;
	}catch(Exception $ex){
		$error = $this->db->error();
		var_dump($ex->getMessage());
		$this->db->db_debug = FALSE;
		return FALSE;
	}
	  
	}//end insertdata function
	
	public function updatedata($tbl=null,$data=array(),$filter=array(),$log_activity='',$is_create=TRUE,$u_id=0,$log_table='admin'){
    //$this->db->db_debug = FALSE;
	
	  if(count($data)>0 && count($filter)>0 && $tbl !=null){
	  	if($this->db->update($tbl,$data,$filter)==TRUE){
	  		//$this->_QueryString = $this->db->update_string($tbl,$data,$filter);
	  		$this->_QueryString = "";
	  		$this->_createLog($this->_QueryString,$log_activity,$is_create,$u_id,$log_table);
			return TRUE;
		}
	  }			
		return FALSE;
	}//end insertdata function
	
	public function deletedata($tbl,$filter=array(),$log_activity='',$is_create=TRUE,$u_id=0,$log_table='admin'){
	
    $this->db->db_debug = FALSE;
	
	 if(count($filter)>0 && $tbl !=null){
	  if(!$this->db->delete($tbl, $filter)){
	  	$this->_QueryString = $this->db->last_query();
	  	$this->_createLog($this->_QueryString,$log_activity,$is_create,$u_id,$log_table);
	  		return false;
	  }
	 }
		return TRUE;
	}//end deletedata function 
	
	public function update_sort_order($id=0,$order_no=0,$tbl="",$id_col_name="id",$order_prefrence_col="order_preference"){
		
		if($id!=0 && $order_no!=0 && trim($tbl)!=""){
			
			$inputparameter   = array((int)$id,(int)$order_no,$order_prefrence_col,$tbl,$id_col_name);
			$outParameter     = array('message');
			$this->CIProcedure('order_update_procedure',$inputparameter,$outParameter);
			$ProcedureMessage = $this->getOutData();
			
			if($ProcedureMessage[0]['@message']==1){
				return TRUE;
			}
			return FALSE;
			
		}else{
			return FALSE;
		}
		
	}//end update_order function
	
	public function update_cat_sort_order($id=0,$order_no=0,$tbl="",$id_col_name="id",$cat_id_name="cat_id",$cid=0,$order_prefrence_col="order_preference"){
		
		if($id!=0 && $order_no!=0 && trim($tbl)!=""){
			
			$inputparameter   = array((int)$id,(int)$order_no,$order_prefrence_col,$tbl,$id_col_name,$cat_id_name,$cid);
			$outParameter     = array('message');
			$this->CIProcedure('order_cat_update_procedure',$inputparameter,$outParameter);
			$ProcedureMessage = $this->getOutData();
			
			if($ProcedureMessage[0]['@message']==1){
				return TRUE;
			}
			return FALSE;
			
		}else{
			return FALSE;
		}
		
	}//end update_order function
	
	public function projectLog($LogData=array()){
	  if(count($LogData)>0){
	  	 
	  	$LogData['log_page'] = $this->router->fetch_class().'/'.$this->router->fetch_method();
	  	$LogData['log_user_agent'] = $this->input->user_agent();
	  	$LogData['log_remote_address'] = $this->input->ip_address();
	  	$LogData['log_date_time'] = date('Y-m-d H:i:s');	  	
	  	
	  	if($this->db->insert("comm_project_activity_log",$LogData)){
			return TRUE;
		}
	  }//end count record
	  return FALSE;
	}//end projectLog
	
	public function _createLog($log_query="",$log_activity="",$is_create=TRUE,$u_id=0,$log_table='admin'){
		
	$LogData = array();
	$u_ip     = $this->input->ip_address();
	$u_agent  = $this->input->user_agent();
	$log_page = $this->router->fetch_class().'/'.$this->router->fetch_method();
	
	$activity  = ($log_activity=="") ? "Undefined" : $log_activity;
	
	if(trim($log_table)=="admin"){

		if(isset($_SESSION["AUTH_USER"])){
			$log_uid = encrypt_decrypt("decrypt",$_SESSION['AUTH_USER']['SERIALNO']);
		}else{
			
			$log_uid = ($u_id!=0)?$u_id:0;
		}
		$log_table='comm_admin_activity_log';
	}else{
		$log_uid = ($u_id!=0)?$u_id:0;
		$log_table='comm_user_activity_log';
	}
	
	try{
		if(trim($log_query)!="" && $is_create ==TRUE){
		
		$LogData = array('log_uid'			  =>$log_uid,
						 'log_page'			  =>$log_page,
						 'log_activity'		  =>$activity,
						 'log_query'  		  =>$log_query,
						 'log_user_agent'	  =>$u_agent,
						 'log_remote_address' =>$u_ip,
						 'log_date_time'	  =>date('Y-m-d H:i:s')
						);	
		
		  if($this->db->insert(trim(strtolower($log_table)),$LogData)){
		  	//$str = $this->db->last_query();
			return TRUE;
		  }
	    }
		return FALSE;
	}catch(Exception $ex){
		$error = $this->db->error();
		var_dump($ex->getMessage());
		$this->db->db_debug = FALSE;
		return FALSE;
	}
	  
	}//end createLog function
	
	/**
	 * This function is used for count all record
	 * @param undefined $tbl used for tabale name
	 * @param undefined $filter for where condion using associative array
	 * @example :- record_count("table_name",array("column_name1"=>value1,"column_name2"=>value2))
	 * 
	 * @return int
	 **/ 
	public function record_count($tbl="",$filter=array()) {
		$result = 0;
		if(trim($tbl)!="" && trim($tbl)!=NULL){
			if(count($filter)>0){
				$this->db->where($filter);
			}
			
	 		$this->db->from($tbl);
	 		$result = $this->db->count_all_results();
		}
	 	
        return $result;
     }// End record_count function
	
	public function GenerateDDList($table='',$column1='',$column2='',$option='',$filter=array(),$orderBy=array()){
		//$DDwon_LIST = array(''=>'');
		if($option!=""){
			$DDwon_LIST = array(''=>$option);
		}		
		
		if($table!='' && $column1!='' && $column2!=''){
			$this->db->select(array($column1, $column2));
		}else{
			$DDwon_LIST = array(''=>'Record Not Found');
			return 	$DDwon_LIST;
		}
		
		if(count($orderBy)>0){
		  foreach($orderBy as $key=>$val){
			 $this->db->order_by($key,$val);
		  }				
		}
		
		if(count($filter)>0){
			$query = $this->db->get_where($table,$filter);
		}else{
			$query = $this->db->get($table);
		}
		
		if($query->num_rows()==0){
		    //$DDwon_LIST = array(''=>'Result Not Found');
			return 	array(''=>'');
		}else{
		
			foreach ($query->result_array() as $row)
			{
			 $DDwon_LIST[$row[$column1]] = $row[$column2];
			}
		}//end check num rows
		return $DDwon_LIST; 

	}//end GenerateDDList
	
	public function GenerateDDListQuery($query='',$column1='',$column2='',$option='--Select Data--',$filter=array()){
		
		//if you pass null then it does not dispaly default first blank option 
		if($option!=NULL){
			$DDwon_LIST = array(''=>$option);
		}
		
		if(count($filter)>0){
			$query = $this->db->query($query,$filter);
		}else{
			$query = $this->db->query($query);
		}

		if($query->num_rows()==0){
		    $DDwon_LIST = array(''=>'Result Not Found');
			return 	$DDwon_LIST;
		}else{
		
			foreach ($query->result_array() as $row)
			{
			 $DDwon_LIST[$row[$column1]] = $row[$column2];
			}
		}//end check num rows
		return $DDwon_LIST; 

	}//end GenerateDDListQuery
	
	public function generateRandomString($length = 4,$characters = '0123456789abcdefghjkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ') {
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
    }//end generateRandomString
    
//////////////////////Procedure////////////////////////////////      
   
/**
* 
* Procedure CIProcedure
* @param Procedure_Name $name
* @param undefined $inputParameter
* @param undefined $outputParameter
* Auth :- Pavan Sihore
* Describe :- Execute Procedure in cakephp environment
* 
* @return
**/   
  public function CIProcedure($name = null , $inputParameter = array(), $outputParameter = array() ){
   	try {
   	$this->outputParams = $outputParameter;
	
	$dbtype     = "Mysql";
	$dbhost     = $this->db->hostname;
	$dbname     = $this->db->database;
	$dbuser     = $this->db->username;
	$dbpass     = $this->db->password;
 
	// database connection
	$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8",$dbuser,$dbpass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
	$this->connection = $pdo;
	
	//Create parameter
	$parameter = "";
	
	foreach($inputParameter as $params):
		if(is_string($params)){
			$parameter .= $parameter == "" ? " '$params' " : " , '$params' ";
		}else{
			if(is_null($params)){
			$parameter .= $parameter == "" ? " null " : " , null ";
			}
			else{
				$parameter .= $parameter == "" ? " $params " : " , $params ";
			}
		}
	endforeach;//end input foreach
	
	if(count($outputParameter)> 0)
	{
		foreach($outputParameter as $prm):
		$parameter .= $parameter == "" ? " @$prm " : " , @$prm ";
		endforeach;
	}
	
	$procuedure = ' call '.$name.'('.$parameter.')';
  //print_r($procuedure);
//	  exit();
	/*
	if($name=="pro_get_email_list"){
	  print_r($procuedure);
	  exit();
	}  
	*/ 

	$rowData = $this->connection->query($procuedure)->fetchAll(PDO::FETCH_ASSOC);
	//print_r($rowData);exit();
	
	$final_data = $rowData;
	return $final_data;
	
	} catch (PDOException $pe) {
       // die("Error occurred:" . $pe->getMessage());
    }
   }//end CIProcedure procedure
   
   /**
   * 
   * Functtion getOutData
   * Description :- Get Out Parameter From CakeProcedure
   * @return
   */
   
    public function getOutData(){
	$outputParameter = $this->outputParams;
	if(count($outputParameter)> 0){
	$parameter = "";
	 foreach($outputParameter as $prm){
	 $parameter .= $parameter == "" ? " @$prm  " : " , @$prm  ";
	 }

	 $SQL = " SELECT $parameter ";
	 $data = $this->connection->query($SQL)->fetchAll(PDO::FETCH_ASSOC);
	 return $data;
	}else{
	 trigger_error("OOPS!!! no resource for select query here");
	}
	
	}//end getOutData function
	
}//end model