<?php

class Api_key_model extends CI_Model {
		public function __construct()
		{
				parent::__construct();
		}
		public function whoIs()
		{
				($api_key = $this->input->get('api_key'))
                ||
                ($api_key = $this->input->post('api_key'))
                ||
                ($api_key = $this->input->get_request_header('api_key', TRUE)) ;

				($secret_key = $this->input->get('secret_key'))
                ||
                ($secret_key = $this->input->post('secret_key'))
                ||
                ($secret_key = $this->input->get_request_header('secret_key', TRUE)) ;

				$api_key = $this->db->select('ak.*')
                    ->where('ak.api_key', $api_key)
                    ->where('ak.secret_key', $secret_key)
                    ->get('api_key ak')
                    ->row_array();

				if (!$api_key) throw new Exception("Akses API Tidak diperbolehkan, karena tidak memberikan api_key yang benar", 1);

				if (!$api_key['active']) throw new Exception("Akses API dinonaktifkan oleh administrator sistem.", 1);

				return $api_key;

		}
}
