<?php

namespace App\Providers;

use Storage;
use League\Flysystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Sftp\SftpAdapter;

class SftpServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('sftp', function ($app, $config) {
            return new Filesystem(new SftpAdapter([
              'host' => $config['host'],
              'port' => $config['port'],
              'username' => $config['username'],
              'password' => $config['password'],
              'privateKey' => $config['privateKey'],
              'root' => $config['root'],
              'timeout' => $config['timeout'],
            ]));
          });
    }
}
