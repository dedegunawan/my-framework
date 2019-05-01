<?php
/**
 * Created by PhpStorm.
 * User: tik_squad
 * Date: 5/1/19
 * Time: 11:19 AM
 */

namespace DedeGunawan\MyFramework;

use Composer\Script\Event;

class Installer
{
    protected static $hostname;
    protected static $username;
    protected static $password;
    protected static $database;
    protected static $mysqli;
    protected static $event;

    /**
     * @return Event
     */
    public static function getEvent()
    {
        return self::$event;
    }

    /**
     * @param Event $event
     */
    public static function setEvent($event)
    {
        self::$event = $event;
    }

    /**
     * @return \mysqli
     */
    public static function getMysqli()
    {
        return self::$mysqli;
    }

    /**
     * @param \mysqli $mysqli
     */
    public static function setMysqli($mysqli)
    {
        self::$mysqli = $mysqli;
    }

    /**
     * @return mixed
     */
    public static function getHostname()
    {
        return self::$hostname;
    }

    /**
     * @param mixed $hostname
     */
    public static function setHostname($hostname)
    {
        self::$hostname = $hostname;
    }

    /**
     * @return mixed
     */
    public static function getUsername()
    {
        return self::$username;
    }

    /**
     * @param mixed $username
     */
    public static function setUsername($username)
    {
        self::$username = $username;
    }

    /**
     * @return mixed
     */
    public static function getPassword()
    {
        return self::$password;
    }

    /**
     * @param mixed $password
     */
    public static function setPassword($password)
    {
        self::$password = $password;
    }

    /**
     * @return mixed
     */
    public static function getDatabase()
    {
        return self::$database;
    }

    /**
     * @param mixed $database
     */
    public static function setDatabase($database)
    {
        self::$database = $database;
    }

    public static function postInstall(Event $event=null) {

        self::setEvent($event);
        self::header();
        self::clearEnv();

        self::configDatabase();
        self::installIonAuth();
        self::header();
        self::configBaseUrl();
        self::header();
        self::successMessage();

        self::deleteSelf();
    }

    public static function header() {
        passthru('clear');
        self::getEvent()->getIO()->write("Instalasi Framework my-framework");
    }

    public static function clearEnv() {
        unlink('.env');
        copy('.env-example', '.env');
    }

    public static function configDatabase() {
        $files = file(".env", FILE_IGNORE_NEW_LINES);
        $lines = array_combine($files, $files);
        $io = self::getEvent()->getIO();
        $io->write('==================================================');
        $io->write("Konfigurasi Database");
        $error = true;

        do {
            $hostname = self::askRequired("Hostname = ");
            $username = self::askRequired("Username = ");
            $password = $io->ask("Password = ");
            $database = self::askRequired("Database = ");

            self::$hostname = $hostname;
            self::$username = $username;
            self::$password = $password;
            self::$database = $database;

            $error = !self::checkConnection();
            if ($error) $io->write("Konfigurasi Database Salah, silahkan isi kembali");

        } while($error);

        $lines["DATABASE_HOSTNAME=your_hostname"]= "DATABASE_HOSTNAME=$hostname";
        $lines["DATABASE_DATABASE=your_database"]= "DATABASE_DATABASE=$database";
        $lines["DATABASE_USERNAME=your_username"]= "DATABASE_USERNAME=$username";
        $lines["DATABASE_PASSWORD=your_password"]= "DATABASE_PASSWORD=$password";

        file_put_contents(".env", implode("\n", $lines));
        $io->write('==================================================');

    }

    public static function checkConnection() {
        $io = self::getEvent()->getIO();
        $io->write("Check Koneksi Database");
        $io->write(printf("Konfigurasi : %s | %s | %s | %s\n", self::$hostname, self::$username, self::$password, self::$database));

        try {
            $mysqli = new \mysqli(self::getHostname(), self::getUsername(), self::getPassword(), self::getDatabase());
        } catch (\Exception $exception) {
            $io->write(printf("<error>Error : %s\n</error>", $exception->getMessage()));
            $io->write('==================================================');
            return false;
        }

        if ($mysqli->connect_errno) {
            $io->write(printf("<error>Error : %s\n</error>", $mysqli->connect_error));
            $io->write('==================================================');
            return false;
        }

        $database = self::getDatabase();
        $sql = "SHOW TABLES FROM $database";
        $result = $mysqli->query($sql);

        if ($result && $result->fetch_array()) {
            $io->write("<error>Error : Silahkan kosongkan database terlebih dahulu, atau pilih database lain.</error>");
            $io->write('==================================================');
            return false;
        }

        self::setMysqli($mysqli);
        return true;
    }

    public static function installIonAuth() {
        $io = self::getEvent()->getIO();
        $io->write('==================================================');

        $sqlSource = file_get_contents('application/sql/ion_auth.sql');

        self::getMysqli()->multi_query($sqlSource);
        $io->write("Done Import Query");
        $io->write('==================================================');
    }

    private static function deleteSelf()
    {
        unlink(__FILE__);
        rmdir('src');
    }


    public static function configBaseUrl() {
        $files = file(".env", FILE_IGNORE_NEW_LINES);
        $lines = array_combine($files, $files);

        $filesbin = file("bin/server.sh", FILE_IGNORE_NEW_LINES);
        $linesbin = array_combine($filesbin, $filesbin);

        $io = self::getEvent()->getIO();
        $io->write('==================================================');
        $io->write("Konfigurasi Base Url");
        $base_url = $io->ask("Base Url (127.0.0.1:8000) = ", '127.0.0.1:8000');

        $lines['BASE_URL=your_base_url']= "BASE_URL=http://$base_url";
        file_put_contents(".env", implode("\n", $lines));

        $linesbin['ADDR_PORT=${1:-127.0.0.1:8000}']= 'ADDR_PORT=${1:-'.$base_url.'}';
        file_put_contents("bin/server.sh", implode("\n", $linesbin));

        $io->write("Done Config Base Url");
        $io->write('==================================================');

    }

    protected static function askRequired($pertanyaan) {
        $io = self::getEvent()->getIO();
        do {
            $val = $io->ask($pertanyaan);
            if (!$val) {
                $io->write("Wajib diisi");
            }
        } while(!$val || trim($val)=="");
        return $val;
    }

    public static function successMessage(Event $event=null) {
        $io = self::getEvent()->getIO();
        $io->write('Install Success');
        $io->write('Silahkan jalankan web server menggunakan perintah : `./bin/server.sh`');
        $io->write('==================================================');
    }


}