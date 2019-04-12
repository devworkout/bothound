<?php

namespace DevWorkout\Bothound;


use DevWorkout\Bothound\Atlas\IP;
use DevWorkout\Bothound\Atlas\Range;
use DevWorkout\Bothound\Models\BothoundIp;

class BothoundClass
{
    protected $userAgents;

    protected $referers;

    public function __construct()
    {
        $this->userAgents = config( 'bothound.user_agents' );
        $this->referers = config( 'bothound.referers' );
    }

    public function identifyByUserAgent( $userAgent = null, $default = null )
    {
        $userAgent = $userAgent ?? $_SERVER[ 'HTTP_USER_AGENT' ] ?? 'fallback facebook user-agent';

        foreach ( $this->userAgents as $network => $agents )
        {
            foreach ( $agents as $pattern )
            {
                if ( preg_match( '~' . $pattern . '~ims', $userAgent ) )
                {
                    return $network;
                }
            }
        }

        return $default;
    }

    public function identifyByReferer( $referer = null, $default = null )
    {
        foreach ( $this->referers as $network => $referers )
        {
            foreach ( $referers as $pattern )
            {
                if ( preg_match( '~' . $pattern . '~ims', $referer ) )
                {
                    return $network;
                }
            }
        }

        return $default;
    }

    public function rememberBot( $ip, $network )
    {
        return BothoundIp::firstOrCreate( compact( 'ip', 'network' ) );
    }

    public function identifyBot( $userAgent = null, $referer = null, $ip = null, $default = null )
    {
        if ( $botName = $this->identifyByUserAgent( $userAgent ) )
        {
            return $botName;
        }

        if ( $botName = $this->identifyByReferer( $referer ) )
        {
            return $botName;
        }

        if ( $botName = $this->identifyByIp( $ip ) )
        {
            return $botName;
        }

        return $default;

    }

    public function identifyByIp( $ip )
    {
        return BothoundIp::where( 'ip', $ip )->orWhere( 'ip', $this->ip( $ip )->subnet()->mask() )->first()->network;
    }

    // Atlas

    public function ip( $ip )
    {
        return new IP( $ip );
    }

    public function subnet( $prefix )
    {
        return new Range( collect( explode( '.', $prefix ) )->take( 3 ) );
    }
}
