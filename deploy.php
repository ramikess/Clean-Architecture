<?php
namespace Deployer;

require 'recipe/symfony.php';

// ============================================================================
// CONFIGURATION
// ============================================================================
set('repository', 'git@github.com:ramikess/Clean-Architecture.git');

add('shared_files', ['.env', '.env.local']);
add('shared_dirs', []);
set('writable_dirs', ['var']);

// ============================================================================
// HOST
// ============================================================================
// Production
host('production')
    ->setHostname('178.128.41.81')
    ->set('remote_user', 'master_cfmyeckyfg')
    ->set('deploy_path', '~/applications/zqwhxgdehy/public_html');

// ============================================================================
// TASKS PERSONNALISÉES
// ============================================================================

// Installation des dépendances
task('deploy:vendors', function () {
    run('cd {{release_path}} && composer install --prefer-dist --no-dev --optimize-autoloader --ignore-platform-req=ext-amqp');
});


// Cache clear sécurisé
task('deploy:cache_safe', function () {
    run('cd {{release_path}} && php bin/console cache:clear --no-warmup || echo "Cache clear warning, continue..."');
});

// Cache warmup
task('deploy:cache_warmup', function () {
    run('cd {{release_path}} && php bin/console cache:warmup || echo "Cache warmup warning, continue..."');
});

// ============================================================================
// MAIN DEPLOY
// ============================================================================
task('deploy', [
    'deploy:prepare',
    'deploy:vendors',
    'deploy:cache_safe',
    'deploy:cache_warmup',
    'deploy:publish',
]);

// ============================================================================
// HOOKS
// ============================================================================
after('deploy:failed', 'deploy:unlock');
