<?php

return [

    'user_agents' => [
        'linkedin' => [ 'linkedin' ],
        'facebook' => [ 'facebookexternalhit', '/FB' ],
        'google'   => [ 'developers.google.com' ],
        'twitter'  => [ 'Twitterbot', 'AhrefsBot', 'GTB', 'Applebot' ],
    ],
    'referers'    => [
        // Facebook bots use this referer when checking your link
        'facebook' => [ 'l.facebook.com' ],
    ],

];