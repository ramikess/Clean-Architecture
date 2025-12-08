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
    ->set('identity_file', '/home/master/.ssh/id_rsa')
;

// Hooks

after('deploy:failed', 'deploy:unlock');
