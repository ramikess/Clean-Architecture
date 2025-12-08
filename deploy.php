<?php
namespace Deployer;

require 'recipe/symfony.php';

// Config
set('repository', 'git@github.com:ramikess/Clean-Architecture.git');

add('shared_files', []); // Plus besoin de .env
add('shared_dirs', []);
add('writable_dirs', ['var']); // Symfony a besoin que var soit writable

// Hosts
host('178.128.41.81')
    ->set('remote_user', 'master_cfmyeckyfg')
    ->set('deploy_path', '~/applications/zqwhxgdehy/public_html');

// Installer les dépendances et gérer le cache
task('deploy:vendors', function () {
    run('cd {{release_path}} && composer install --prefer-dist --no-dev --optimize-autoloader --ignore-platform-req=ext-amqp');
    run('cd {{release_path}} && php bin/console cache:clear || echo "Cache clear failed, possibly missing AMQP, continue..."');
});

// Hooks
after('deploy:failed', 'deploy:unlock');
