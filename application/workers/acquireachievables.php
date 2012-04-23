<?php
// use Laravel\CLI\Command;
// require path('sys').'cli/dependencies'.EXT;

echo 'worker ready';

while(1) {
    echo 'worker working';
    Event::listen('hipsta.new_user', function ($uid) {
    		echo 'got it!';
    		Command::run(array('acquireachievables',"$uid"));
    });
    sleep(1);
}