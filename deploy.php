<?php
namespace Deployer;

require 'recipe/symfony.php';

// ============================================================================
// CONFIGURATION
// ============================================================================
set('repository', 'git@github.com:ramikess/Clean-Architecture.git');

add('shared_files', []);
add('shared_dirs', []);
set('writable_dirs', ['var']);

// ============================================================================
// HOST
// ============================================================================
host('178.128.41.81')
    ->set('remote_user', 'master_cfmyeckyfg')
    ->set('deploy_path', '~/applications/zqwhxgdehy/public_html');

// ============================================================================
// TASKS PERSONNALISÉES
// ============================================================================

// Installation des dépendances


task('deploy:copy_env', function () {
    // Crée shared/.env s'il n'existe pas
    run('if [ ! -f {{deploy_path}}/shared/.env ]; then touch {{deploy_path}}/shared/.env; fi');

    // Copie .env.prod vers shared/.env
    run('cp {{release_path}}/.env.prod {{deploy_path}}/shared/.env;');

    // Copie .env.prod vers shared/.env.local)
    run('cp {{release_path}}/.env.prod {{deploy_path}}/shared/.env.local');

    // Crée le lien symbolique de shared/.env vers la release
    run('ln -s {{deploy_path}}/shared/.env {{release_path}}/.env');
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

    'deploy:copy_env',
    'deploy:cache_safe',
    'deploy:cache_warmup',
    'deploy:publish',
]);

// ============================================================================
// HOOKS
// ============================================================================
after('deploy:failed', 'deploy:unlock');
