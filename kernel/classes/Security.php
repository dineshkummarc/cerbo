<?php

namespace cerbo\kernel;

class Security
{

    public static function needsPolicies( $policies )
    {

        $current_user = \cerbo\kernel\User::getCurrentUser();
        $user_policies = $current_user->getUsergroup()->getPolicies();
        
        // $policies must be an array (even if there is only one element)
        if ( !is_array( $policies ) )
        {
            $policy = $policies;
            $policies = array( $policy );
        }

        foreach ( $policies as $policy )
        {

            $found = false;
            $policy_parts = explode( '::', $policy );

            // Look for wildcard
            foreach ( $user_policies[$policy_parts[0]] as $policy )
            {
                if ( $policy == '*' )
                {
                    $found = true;
                }
            }

            // Full detection
            foreach ( $user_policies[$policy_parts[0]] as $available_policy )
            {
                if ( $available_policy == $policy_parts[1] )
                {
                    $found = true;
                }
            }

            if ( !$found )
            {
                
                // We are not allowed to go here, we must go away
                header('Location:' . \cerbo\kernel\URL::makeCleanURL( 'administration/403' ) );

            }

        }

    }

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
