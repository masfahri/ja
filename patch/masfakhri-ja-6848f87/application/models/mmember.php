<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mmember extends CI_Model {

    public function bindDataSetupp($initial_id="")
    {
        
            $this->db->select('*');
            $this->db->from('membership_get');
            if( $initial_id !== "" ){
                $this->db->where('get_id', $initial_id);
            }
            $this->db->order_by('get_id', 'DESC');
            $query = $this->db->get();
            if( $query->num_rows() > 0 ){
                   return $query->result_array();
                
            }else return null;
      }

    public function bindDataSetuppp($initial_id="")
    {
        
            $this->db->select('*');
            $this->db->from('membership_get');
            if( $initial_id !== "" ){
                $this->db->where('get_id', $initial_id);
            }
            $this->db->order_by('get_id', 'DESC');
            $query = $this->db->get();
            if( $query->num_rows() > 0 ){
                   return $query->row_array();
                
            }else return null;
      }

      public function bindDataSetup($initial_id="")
      {
        
            $this->db->select('*');
            $this->db->from('page_membership');
            if( $initial_id !== "" ){
                $this->db->where('id_membership', $initial_id);
            }
            $this->db->order_by('id_membership', 'DESC');
            $query = $this->db->get();
            if( $query->num_rows() > 0 ){
                if( $initial_id !== "" ){
                   return $query->row_array();
                }else{
                   return $query->result_array();  
                }
                
            }else return null;
      }

}

/* End of file mmember.php */
/* Location: ./application/models/mmember.php */