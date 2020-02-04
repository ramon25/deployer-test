<?php
namespace Deployer;
require 'vendor/ongoing/deployer-base/symfony4.php';

// Project name
set('application', 'symfony-test');
// Project repository
set('repository', 'git@github.com:ramon25/deployer-test.git');

// Hosts
host('production')
    ->stage('prod')
    ->hostname('167.71.62.124')
    ->user('root')
    ->set('deploy_path', '/var/www/html')
    ->set('branch', function () {
        return input()->getOption('branch') ?: 'production';
    });

host('production2')
    ->stage('prod')
    ->hostname('167.172.183.75')
    ->user('root')
    ->set('deploy_path', '/var/www/html')
    ->set('branch', function () {
        return input()->getOption('branch') ?: 'production';
    });

host('staging')
    ->stage('staging')
    ->hostname('167.172.182.96')
    ->user('root')
    ->set('deploy_path', '/var/www/html')
    ->set('branch', function () {
        return input()->getOption('branch') ?: 'master';
    });

task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:vendors',
    'deploy:build:assets',
    'deploy:writable',
    'deploy:cache:clear',
    'deploy:schema_update',
    'deploy:cache:warmup',
    'deploy:symlink',
    'deploy:unlock',
    'deploy:tag',
    'cleanup',
]);
