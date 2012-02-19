<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts_model extends CI_Model 
{
	function is_user($email, $password)
	{
		$query = $this->db->get_where('users', array('email' => $email, 'password' => md5($password)));
		return ($query->num_rows == 1) ? TRUE : FALSE;
	}
	
	function get_uid($email)
	{
		$row = $this->db->get_where('users', array('email' => $email))->row();
		return $row->uid;
	}
	
	function get_username($email)
	{
		$row = $this->db->get_where('members2', array('email' => $email))->row();
		return $row->username;
	}
	
	function get_contacts($uid)
	{
		$contacts = $this->db->select('name, email, phone')->
							order_by('name')->
							get_where('contacts', array('uid' => $uid))->result();
	 	return $contacts;
	}
	
	function get_contact_names($uid)
	{
		$contacts = $this->db->select('name')->
							order_by('name')->
							get_where('contacts', array('uid' => $uid))->result_array();
	 	return $contacts;
	}
	
	function get_contact_data($uid, $name)
	{
		$contact = $this->db->select('name, email, phone')->
							get_where('contacts', array('uid' => $uid, 'name' => $name))->
							row_array();
	 	return $contact;
	}
	
	function delete_contact($name, $uid)
	{
		$this->db->delete('contacts', array('name' => $name, 'uid' => $uid)); 
	}
	
	function add_contact($name, $email, $phone, $uid)
	{
		$query = $this->db->get_where('contacts', array('name' => $name, 'uid' => $uid));
		if($query->num_rows == 1){
			return FALSE;
		}
		$this->db->insert('contacts', array('name' => $name, 'email' => $email, 'phone' => $phone, 'uid' => $uid)); 
		return TRUE;
	}
	
	function update_contact($name, $email, $phone, $uid)
	{
		$this->db->update('contacts', array('email' => $email, 'phone' => $phone), array('uid' => $uid, 'name' => $name));
	}
	
	function validate_password($uid, $password)
	{
		$query = $this->db->get_where('users', array('uid' => $uid, 'password' => md5($password)));
		return ($query->num_rows == 1) ? TRUE : FALSE;
	}
	
	function update_password($uid, $password)
	{
		$this->db->update('users', array('password' => md5($password)), array('uid' => $uid));
	}
}
/* End of file contacts_model.php */