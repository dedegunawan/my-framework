<?php
/**
 * Created by PhpStorm.
 * User: tik_squad
 * Date: 5/2/19
 * Time: 10:54 AM
 */

namespace DedeGunawan\MyFramework\CoreController;


class ApiController extends \CI_Controller
{
    protected static $api;

    /**
     * @return mixed
     */
    public static function getApi()
    {
        return self::$api;
    }

    /**
     * @param mixed $api
     */
    public static function setApi($api)
    {
        self::$api = $api;
    }

    public function __construct()
    {
        parent::__construct();
        $this->load->model('api_key_model');
        $this->authenticate();

    }

    public function _json($data)
    {
        header("Content-Type:application/json");
        echo json_encode($data);
        die();
    }

    public function _response($status_code, $message, $items=[], $response_code='200')
    {
        http_response_code($response_code);
        $this->_json(['status_code' => $status_code, 'message' => $message, 'items' => $items]);
    }

    public function authenticate()
    {

        // authentication API
        try {
            if (self::$api == null) self::$api = $this->api_key_model->whoIs();
        } catch (Exception $e) {
            $this->_response(0, $e->getMessage(), [], 400);
            die();
        }
    }
}