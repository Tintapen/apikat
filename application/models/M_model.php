<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_model extends CI_Model
{

	public function get_where($where, $table)
	{
		return $this->db->get_where($table, $where);
	}

	public function insert($data, $table)
	{
		$this->db->insert($table, $data);
	}

	public function get_desc($table)
	{
		$this->db->ORDER_BY('id', 'desc');
		return $this->db->get($table);
	}

	public function delete($where, $table)
	{
		$this->db->delete($table, $where);
	}

	public function update($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	private function configEmail()
	{
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'smtp.gmail.com';
		$config['smtp_user'] = 'kerjapraktik17@gmail.com';
		$config['smtp_pass'] = 'mmogsulukqwvjwvs';
		$config['smtp_port'] = 465;
		$config['smtp_crypto'] = 'ssl';
		$config['crlf'] =  "\r\n";
		$config['newline'] = "\r\n";

		return $this->load->library('email', $config);
	}

	public function sendEmail($to, $subject, $file = null, $message)
	{
		$this->configEmail();

		$this->email->from('kerjapraktik17@gmail.com', "APIKAT");
		$this->email->to($to);
		$this->email->subject($subject);
		if (!empty($file))
			$this->email->attach($file);

		$this->email->message($message);

		return $this->email->send() ? true : false;
	}
}
