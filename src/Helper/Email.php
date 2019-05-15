<?php
/**
 * Created by PhpStorm.
 * User: tik_squad
 * Date: 5/9/19
 * Time: 2:33 PM
 */

namespace DedeGunawan\MyFramework\Helper;


use DedeGunawan\MyFramework\Exception\EmailException;

class Email
{
    protected $ci;
    protected $from;
    protected $to;
    protected $subject;
    protected $message;

    /**
     * @return \CI_Controller
     */
    public function getCi()
    {
        return $this->ci;
    }

    /**
     * @param \CI_Controller $ci
     */
    public function setCi($ci)
    {
        $this->ci = $ci;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param mixed $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param mixed $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function __construct()
    {
        $this->setCi(get_instance());
        $this->load_config_email();

    }

    public function load_config_email() {
        $this->getCi()->load->library('email');
        $this->getCi()->email->initialize($this->getCi()->config->item('email_config', 'ion_auth'));
        $this->getCi()->email->set_newline("\r\n");
    }

    public function send() {
        $this->getCi()->email->clear();
        $this->getCi()->email->from($this->getFrom());
        $this->getCi()->email->to($this->getTo());
        $this->getCi()->email->subject($this->getSubject());
        $this->getCi()->email->message($this->getMessage());

        if ($this->getCi()->email->send()) {
            return true;
        }
        else {
            $exception = new EmailException("Email cannot be send");
            throw $exception;
        }
    }
}