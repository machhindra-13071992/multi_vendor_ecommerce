<?php

namespace Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
	protected function getPackageProviders($app)
	{
		return ['SteffjeNL\LaravelAzureBlobStorage\AzureBlobStorageServiceProvider'];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('filesystems.default', 'azure');
        $app['config']->set('filesystems.cloud', 'azure');
        $app['config']->set('filesystems.disks.azure', [
            'driver'    => 'azure',
            'name'      => 'MY_AZURE_STORAGE_NAME',
            'key'       => 'MY_AZURE_STORAGE_KEY',
            'container' => 'MY_AZURE_STORAGE_CONTAINER',
        ]);
    }
}
