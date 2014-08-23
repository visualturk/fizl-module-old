<?php

Event::listen(
    'app.booted',
    function () {
        if (Request::segment(1) !== 'admin' and App::make('fizl')->exists(Request::path())) {
            Route::get(
                Request::path(),
                'Addon\Module\Fizl\Controller\FizlController@remap'
            );
        }
    }
);
