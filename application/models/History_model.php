<?php

class History_model extends CI_Model
{
    public function getHistory($id = null) 
    {
        if( $id === null ) {
            return $this->db->get('history')->result_array();
        } else {
            return $this->db->get_where('history', ['id_user' => $id])->result_array();
        }
      
    }
    public function updateHistory($data, $id)
    {
        $this->db->update('history', $data, ['id_history' => $id]);
        return $this->db->affected_rows();
    }
    public function createHistory($data)
    {
        $this->db->insert('history', $data);
        return $this->db->affected_rows();
    }
    public function patchUser($data, $id)
    {
        $this->db->update('history', $data, ['nama' => $id]);
        return $this->db->affected_rows();
    }
    public function verifyHistory($id,$apikey){//,$apikey
        $this->db->where('id_history', $id);
        $this->db->where('api_key', $apikey);
        $query = $this->db->get('history');
        return $query;
    }
}