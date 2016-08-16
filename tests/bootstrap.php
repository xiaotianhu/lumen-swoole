<?php

exec(PHP_BINARY.' '.__DIR__.'/setup.php', $output);

register_shutdown_function(function() {
    $pidFile = sys_get_temp_dir().'/lumen-swoole.pid';
    $pid = file_get_contents($pidFile);

    posix_kill($pid, SIGTERM);
    usleep(500);
    posix_kill($pid, SIGKILL);
    unlink($pidFile);
});