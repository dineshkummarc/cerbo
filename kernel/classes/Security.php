<?php

namespace cerbo\kernel;

class Security
{

    public static function crypt( $string )
    {

        $config = \cerbo\kernel\Configuration::getConfiguration();
        $method = $config['application.ini']['SECURITE']['CryptMethod'];
        $salt = $config['application.ini']['SECURITE']['CryptSalt'];

        switch ( $method )
        {

            case 'SHA512':
                $salt = '$6$rounds=5000$' . $salt;
                break;

            case 'SHA256':
                $salt = '$5$rounds=5000$' . $salt;
                break;

            case 'BLOWFISH':
                $salt = '$2a$07$' . $salt;
                break;

            case 'MD5':
                $salt = '$1$' . $salt;
                break;

            default:
                \cerbo\kernel\Design::addError(
                    get_class(),
                    "<i>CryptMethod</i> : <b>$method</b> is not handled.<br />
                    You must use one of the following : SHA512, SHA256, BLOWFISH or MD5."
                );
                break;

        }

        $hash = crypt( $string, $salt );

        return substr( $hash, strrpos( $hash, '$' ) + 1 );

    }

}

?>
