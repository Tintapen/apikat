<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_User extends CI_Model
{
    public function getUserInfo($id)
    {
        $q = $this->db->get_where('tb_user', array('id' => $id), 1);
        if ($this->db->affected_rows() > 0) {
            $row = $q->row();
            return $row;
        } else {
            error_log('no user found getUserInfo(' . $id . ')');
            return false;
        }
    }

    public function getUserInfoByEmail($email)
    {
        $q = $this->db->get_where('tb_user', array('email' => $email), 1);
        if ($this->db->affected_rows() > 0) {
            $row = $q->row();
            return $row;
        }
    }

    public function insertToken($user_id)
    {
        $token = substr(sha1(rand()), 0, 30);
        $date = date('Y-m-d');

        $string = array(
            'token' => $token,
            'tb_user_id' => $user_id,
            'created' => $date
        );
        $query = $this->db->insert_string('tb_tokens', $string);
        $this->db->query($query);
        return $token . $user_id;
    }

    public function isTokenValid($token)
    {
        $tkn = substr($token, 0, 30);
        $uid = substr($token, 30);

        $q = $this->db->get_where('tb_tokens', array(
            'tb_tokens.token' => $tkn,
            'tb_tokens.tb_user_id' => $uid
        ), 1);

        if ($this->db->affected_rows() > 0) {
            $row = $q->row();

            $created = $row->created;
            $createdTS = strtotime($created);
            $today = date('Y-m-d');
            $todayTS = strtotime($today);

            if ($createdTS != $todayTS) {
                return false;
            }

            $user_info = $this->getUserInfo($row->tb_user_id);
            return $user_info;
        } else {
            return false;
        }
    }

    public function updatePassword($post)
    {
        $options = [
            'cost' => 10,
        ];

        $enkripPassword = password_hash($post['password'], PASSWORD_BCRYPT, $options);

        $this->db->where('id', $post['user_id']);
        $this->db->update('tb_user', array('password' => $enkripPassword));
        return true;
    }
}
