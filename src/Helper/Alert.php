<?php
/**
 * Created by PhpStorm.
 * User: tik_squad
 * Date: 5/2/19
 * Time: 2:25 PM
 */

namespace DedeGunawan\MyFramework\Helper;


class Alert
{
    protected static $ci;

    /**
     * @return \MY_Controller
     */
    public static function getCi()
    {
        return self::$ci;
    }

    /**
     * @param \MY_Controller $ci
     */
    public static function setCi($ci)
    {
        self::$ci = $ci;
    }

    protected static function init() {
        self::setCi(get_instance());
    }

    public static function success($messages) {
        self::init();
        self::getCi()->session->set_flashdata('alert_type', 'success');
        self::getCi()->session->set_flashdata('message', $messages);
    }

    public static function error($messages) {
        self::init();
        self::getCi()->session->set_flashdata('alert_type', 'danger');
        self::getCi()->session->set_flashdata('message', $messages);
    }

    public static function info($messages) {
        self::init();
        self::getCi()->session->set_flashdata('alert_type', 'info');
        self::getCi()->session->set_flashdata('message', $messages);
    }

    public static function show_messages($delimiter="<br/>") {
        self::init();
        $message = self::getCi()->session->flashdata('message');
        $alert_type = self::getCi()->session->flashdata('alert_type');
        if (!$message) {
            self::getCi()->load->helper('form');
            $message = validation_errors('+++', '+++____');
            $message = str_ireplace("+++", "", $message);
            $message = str_ireplace("____", "<br/>", $message);
            if (strlen($message) > 0) {
                $alert_type = 'danger';
            }
        }
        if (@$message && is_array($message)) {
            $message = implode($delimiter, $message);
        }
        if(@$message) {
            ?>
            <div class="alert alert-<?=@$alert_type?$alert_type:'info';?>">
                <?=$message;?>
            </div>
            <?php
        }
    }
}