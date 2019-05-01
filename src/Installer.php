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
    public static function postInstall(Event $event=null) {
        unlink('.env');
        copy('.env-example', '.env');
        self::configDatabase($event);
        self::installIonAuth($event);
        self::configBaseUrl($event);

        self::successMessage($event);
    }

    public static function configDatabase(Event $event=null) {
        $files = file(".env", FILE_IGNORE_NEW_LINES);
        $lines = array_combine($files, $files);
        var_dump($lines);
        $io = $event->getIO();
        $io->write('==================================================');
        $io->write("Konfirgurasi Database");
        $hostname = $io->ask("Hostname = ");
        $username = $io->ask("Username = ");
        $password = $io->ask("Password = ");
        $database = $io->ask("Database = ");

        self::$hostname = $hostname;
        self::$username = $username;
        self::$password = $password;
        self::$database = $database;

        $lines["DATABASE_HOSTNAME=your_hostname"]= "DATABASE_HOSTNAME=$hostname";
        $lines["DATABASE_DATABASE=your_database"]= "DATABASE_DATABASE=$database";
        $lines["DATABASE_USERNAME=your_username"]= "DATABASE_USERNAME=$username";
        $lines["DATABASE_PASSWORD=your_password"]= "DATABASE_PASSWORD=$password";
        var_dump($lines);

        file_put_contents(".env", implode("\n", $lines));
        $io->write('==================================================');

    }

    public static function installIonAuth(Event $event=null) {
        $io = $event->getIO();
        $io->write('==================================================');
        $io->write("Check Database Connection");
        $io->write(printf("Konfigurasi : %s | %s | %s | %s\n", self::$hostname, self::$username, self::$password, self::$database));

        $mysqli = new \mysqli(self::$hostname, self::$username, self::$password, self::$database);

        if ($mysqli->connect_errno) {
            $io->write(printf("<error>Connect failed: %s\n</error>", $mysqli->connect_error));
            $io->write("<error>Stopped</error>");
            $io->write('==================================================');
            exit();
        }
        $sqlSource = file_get_contents('application/sql/ion_auth.sql');

        $mysqli->multi_query($sqlSource);
        $io->write("Done Import Query");
        $io->write('==================================================');
    }


    public static function configBaseUrl(Event $event=null) {
        $files = file(".env", FILE_IGNORE_NEW_LINES);
        $lines = array_combine($files, $files);

        $filesbin = file("bin/server.sh", FILE_IGNORE_NEW_LINES);
        $linesbin = array_combine($filesbin, $filesbin);

        $io = $event->getIO();
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
    public static function successMessage(Event $event=null) {
        $io = $event->getIO();
        $io->write('Install Success');
        $io->write('==================================================');
    }


}