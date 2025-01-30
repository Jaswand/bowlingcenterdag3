<?php
    namespace App\Http\Helpers;

    class SharedHelper
    {
        /**
         * Convert boolean to string.
         * @param boolean $boolVar
         * @return string
         */
        public static function ConvertBooleanToString(bool $boolVar) : string
        {
            $strBool = $boolVar ? "Ja" : "Nee";
            return $strBool;
        }

        /**
         * Convert system date time to string date time
         * @return string
         */
        public static function ConvertDateTimeToStringDateTime() : string
        {
            // $test = Current_timestamp();
            // $dateTest = new DateTimeZone('UTC');

            date_default_timezone_set('Europe/Amsterdam');
            $strDateTime = date("Y-m-d H:i:s", strtotime('NOW'));
            return $strDateTime;
        }
    }
?>