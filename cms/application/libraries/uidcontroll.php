<?php
/**
 * @author Raka Anggala W.S
 * @date 02/08/2015
 * @desc Class SQL insert, update, delete, last record query 
 *       MVC Platform Framework CodeIgniter
 */ 

class Uidcontroll{
    
    #property 
    public $totalRecord     = 0;
    public $resultDb        = null;
    public $last_id         = 0;
    public $varIns;
    
    
    # all method preferences
    public function __construct(){
        
        // set variable ci instance
         $this->varIns =& get_instance(); 
    }
    
     /**
     * @desc Query Select initial table to get total rows data
     * @return int
     */
    public function recordLastQuery($table_name){
        
        # count update last total record
        $sql = "select \"col1\" from $table_name";
        $query = $this->varIns->db->query($sql);
        $this->varIns->totalRecord = $query->num_rows();
    }
    
     /**
     * @desc Query insert Data
     * @param string
     * @param array
     * @return boolean
     */
    public  function insertData($table_name, $dataInsert = array()){
       
        if( $this->varIns->db->insert($table_name, $dataInsert) ){
            
            $this->last_id = $this->varIns->db->insert_id();         
            $this->recordLastQuery($table_name);
            return TRUE;  
             
        }else return FALSE;
    }
    
    
    /**
     * Update Data
     * @param array
     * @return boolean
     */
    public function updateData($db_config){
   
        $this->varIns->db->where($db_config['where'][0],$db_config['where'][1]);
		$update = $this->varIns->db->update($db_config['table'], $db_config['data']);
		if ( ! $update)
		{
			return FALSE;
		}
        
		return TRUE;
    }
    
     /**
     * Remove Data
     * @param string
     * @param array
     * @return boolean
     */
    public function removeData($table_name, $dataTarget){
        
        $this->varIns->db->where($dataTarget[0], $dataTarget[1]);
       	if( $this->varIns->db->delete($table_name) ){
       	    $this->recordLastQuery($table_name); 
            return TRUE;
       	}
        else return FALSE; 
    }

     /**
     * Remove Data
     * @param string
     * @param array
     * @return boolean
     */
    public function removeDataIn($table_name, $dataTarget){
        
        $this->varIns->db->where_in($dataTarget[0], $dataTarget[1]);
       	if( $this->varIns->db->delete($table_name) )return TRUE;
        else return FALSE; 
    }
    
}
?>