<?php

use Illuminate\Routing\Route;

Route::get('git-deploy', function () {
    exec('git reset --hard HEAD');
    exec('git pull origin master');
    exec('chmod -R 777 storage');
    exec('chmod -R 755 *');
    return 'Deployed successfully';
});
