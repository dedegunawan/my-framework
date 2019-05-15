<?php
/**
 * Created by PhpStorm.
 * User: tik_squad
 * Date: 3/19/19
 * Time: 7:08 AM
 */

class MY_Controller extends CI_Controller
{
    protected $datas = array();
    protected $redirect_login='/auth/';
    protected $redirect_not_login='/auth/login';
    protected $groups=array();
    protected static $template_default;

    /**
     * @return mixed
     */
    public static function getTemplateDefault()
    {
        return self::$template_default;
    }

    /**
     * @param mixed $template_default
     */
    public static function setTemplateDefault($template_default)
    {
        self::$template_default = $template_default;
    }

    public function __construct()
    {
        parent::__construct();
        $this->setDatas(array());
        $this->load->config('ion_auth');
        $this->redirect_login=$this->config->item('redirect_login', 'ion_auth');
        $this->redirect_not_login=$this->config->item('redirect_not_login', 'ion_auth');

        if (!self::getTemplateDefault()) self::setTemplateDefault('default');
    }

    public function render($view_name, $template=FALSE, $return=FALSE) {

        if (is_null($template)) return $this->load->view($view_name, $this->getDatas(), $return);

        if (!$template) $template = self::$template_default;

        $this->addData('content', $this->load->view($view_name, $this->getDatas(), true));
        return $this->load->view("template/$template/$template", $this->getDatas(), $return);
    }

    public function is_login() {
        return $this->ion_auth->logged_in();
    }
    public function is_not_login() {
        return !$this->is_login();
    }

    public function redirect_if_login() {
        $login = $this->is_login();
        if ($login) {
            return redirect(base_url($this->redirect_login));
        }
    }

    public function redirect_if_not_login() {
        $not_login = $this->is_not_login();
        if ($not_login) {
            return redirect(base_url($this->redirect_not_login));
        }
    }

    public function _json($datas) {
        header("Content-Type:application/json");
        echo json_encode($datas);
        die();
    }

    /**
     * @return array
     */
    public function getDatas()
    {
        return $this->datas;
    }
    /**
     * @param $key
     * @return array
     */
    public function getData($key)
    {
        return @$this->datas[$key];
    }

    /**
     * @param array $datas
     */
    public function setDatas($datas)
    {
        $this->datas = $datas;
    }


    /**
     * @param mixed $key
     * @param mixed $data
     */
    public function addData($key, $data)
    {
        $this->datas[$key] = $data;
    }
    /**
     * @param array $datas
     */
    public function addMultipleData($datas)
    {
        foreach ($datas as $key => $data) {
            $this->datas[$key] = $data;
        }
    }
    /**
     * @param mixed $key
     * @return boolean
     */
    public function hasData($key)
    {
        return array_key_exists($key, $this->datas);
    }
    /**
     * @param mixed $key
     */
    public function removeData($key)
    {
        unset($this->datas[$key]);
    }

    public function addGroup($data) {
        if (is_array($data)) {
            $this->groups = array_merge($this->groups, $data);
        } else {
            $this->groups[] = $data;
        }
    }
}