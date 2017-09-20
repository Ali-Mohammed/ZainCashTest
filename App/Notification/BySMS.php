<?php

namespace App\Notification;

use App\Database\DatabaseHelper;
use Exception;

require_once __DIR__ . '/../Database/DatabaseHelper.php';

class BySMS
{

    /**
     * @param $customerName
     * @param $MobileNumber
     * @param $preferredLanguage
     * @param $birthday
     */
    public static function send($customerName, $MobileNumber, $preferredLanguage, $birthday)
    {

        $message = self::checkLANG($preferredLanguage, $customerName);

        try {

            self::sendMessage($MobileNumber, $message);
            self::log($MobileNumber, $message);

        } catch (Exception $exception) {
            //same them to log file or db log
            echo $exception->getMessage();
        }

    }

    /**
     * @param $lang
     * @param $name
     * @return string
     */
    public static function checkLANG($lang, $name)
    {

        $AR_MESSAGE = "كل عام وانت بخير $name, نتمنى لك عيد ميلاد سعيد, زين كا";
        $KR_MESSAGE = " $name هه مو روزيكت هه رجه زن بي";
        return $lang == 'AR' ? $AR_MESSAGE : $KR_MESSAGE;

    }

    /**
     * @param $phone
     * @param $message
     */
    public static function sendMessage($phone, $message)
    {
        //some functionality to send the sms
    }

    /**
     * @param $MobileNumber
     * @param $message
     */
    public static function log($MobileNumber, $message)
    {
        $DB_CON = DatabaseHelper::connect();
        $create_at = date('Y-m-d h:m:s', time());

        $sql = "INSERT INTO `log` ( `date`, `MobileNumber`, `smsContent`)
VALUES
	( '{$create_at}', '{$MobileNumber}', '{$message}');";

        if (mysqli_query($DB_CON, $sql)) {
//            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($DB_CON);
        }

        mysqli_close($DB_CON);
    }
}