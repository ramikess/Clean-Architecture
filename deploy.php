<?php
namespace Deployer;

require 'recipe/symfony.php';

// Config

set('repository', 'git@github.com:ramikess/Clean-Architecture.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('178.128.41.81')
    ->set('remote_user', 'master_cfmyeckyfg')
    ->set('deploy_path', '~/applications/zqwhxgdehy/public_html')
;

// 1. Upload .env.prod as .env.local
task('deploy:upload_env', function () {
    upload('.env.prod', '{{deploy_path}}/shared/.env.local');
    run('chmod 600 {{deploy_path}}/shared/.env.local');
});


// Custom task for Composer install
task('deploy:vendors', function () {
    run('cd {{release_path}} && composer install --prefer-dist --no-dev --optimize-autoloader --ignore-platform-req=ext-amqp');
});

// Hooks

after('deploy:failed', 'deploy:unlock');
