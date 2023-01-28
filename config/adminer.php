<?php

return [

    /*
     * Route prefix.
     */
    "route" => [

        /*
        * Route prefix for admin scope.
        */
        "admin" => "api/admin",

        /*
        * Route prefix for user scope.
        */
        "user" => "api",
    ],

    /*
     * Middleware.
     */
    "middleware" => [

        /*
        * Middleware for admin scope.
        */
        "admin" => [ "api", ],

        /*
        * Middleware for user scope.
        */
        "user" => [ "api", "auth:api", ],
    ],
];
