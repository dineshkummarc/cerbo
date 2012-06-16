<?php

namespace cerbo\kernel;

class Debug
{

    private static $errors = array();

    public static function addDataSourceQuery( $from, $message )
    {
        \cerbo\kernel\Debug::genericDebugMessage( 'DATASOURCE', $from, $message );
    }

    public static function addNotice( $from, $message )
    {
        \cerbo\kernel\Debug::genericDebugMessage( 'NOTICE', $from, $message );
    }

    public static function addWarning( $from, $message )
    {
        \cerbo\kernel\Debug::genericDebugMessage( 'WARNING', $from, $message );
    }

    public static function genericDebugMessage( $type, $from, $message )
    {

        $config = \cerbo\kernel\Configuration::getConfiguration();

        if ( $config['application.ini']['DEBUG']['Debug'] == true )
        {
            \cerbo\kernel\Debug::$errors[] = array(
                'type' => $type,
                'from' => $from,
                'message' => $message
            );
        }
    }

    public static function catchPHPError( $errno, $errstr, $errfile, $errline )
    {
        \cerbo\kernel\Debug::genericDebugMessage( 'PHP', "$errfile @ $errline", $errstr );
    }

    public static function getDebugHTML()
    {
    
        $config = \cerbo\kernel\Configuration::getConfiguration();

        $str = "<table class='cerbo-debug'>\n";
        foreach ( \cerbo\kernel\Debug::$errors as $error )
        {
            if ( in_array( $error['type'], $config['application.ini']['DEBUG']['DebugDisplay'] ) )
            {
                $str .= "<tr class='cerbo-debug debug-" . strtolower( $error['type'] ) . "'>\n";
                $str .= "   <td width='70'>" . $error['type'] . "</td>\n";
                $str .= "   <td>" . $error['from'] . "</td>\n";
                $str .= "</tr>\n";
                $str .= "<tr class='cerbo-debug debug-message'>\n";
                $str .= "   <td colspan='2'>" . $error['message'] . "</td>\n";
                $str .= "</tr>\n";
            }
        }
        $str .= "</table>\n";
        return $str;
    }

}

?>
