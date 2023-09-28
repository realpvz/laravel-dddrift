<?php

namespace Realpvz\DDDrift\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Realpvz\DDDrift\Generators\FileGenerator;
use Symfony\Component\Console\Input\InputArgument;

class MakeDomainCommand extends Command
{
    protected $name = 'make:domain';

    protected $description = 'Create new domain';

    public function handle()
    {
        $names = $this->argument('name');

        $directories = ['Infrastructure', 'Application', 'Domain'];

        $applicationDirectories = ['Providers', 'Routes', 'Services', 'Http'];

        $domainDirectories = ['DataTransferObjects', 'ValueObjects', 'Events', 'Jobs'];

        $filesystem = new Filesystem();

        foreach ($names as $name) {
            $filesystem->makeDirectory("src/$name");

            foreach ($directories as $directory) {
                $filesystem->makeDirectory("src/$name/$directory");

                if ($directory == 'Application') {
                    foreach ($applicationDirectories as $applicationDirectory) {
                        $filesystem->makeDirectory("src/$name/$directory/$applicationDirectory");
                    }
                } else if ($directory == 'Domain') {
                    foreach ($domainDirectories as $domainDirectory) {
                        $filesystem->makeDirectory("src/$name/$directory/$domainDirectory");
                    }
                }
            }
        }

        $this->info('Directories created.');
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::IS_ARRAY, 'Name of domains']
        ];
    }
}
