<?php

use Addon\Module\Fizl\Core\Fizl;

App::singleton(
    'fizl',
    function () {
        return new Fizl();
    }
);
