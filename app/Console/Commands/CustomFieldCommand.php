<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Rebilly\Client;
use Rebilly\Http\Exception\NotFoundException;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class CustomFieldCommand
 * @package App\Console\Commands
 *
 * Run the command to create custom field
 * ```
 * php artisan customField customers DOB string
 * ```
 */
class CustomFieldCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'customField';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "A command that checks and creates custom fields if not exist";
    /** @var Client */
    protected $client;

    /**
     * @return Client
     */
    protected function client()
    {
        if ($this->client === null) {
            $this->client = new Client([
                'apiKey' => getenv('REBILLY_API_KEY'),
                'baseUrl' => getenv('REBILLY_API_HOST'),
            ]);
        }

        return $this->client;
    }

    protected function getArguments()
    {
        return [
            ['resource', InputArgument::REQUIRED, 'customers'],
            ['name', InputArgument::REQUIRED, 'company'],
            ['type', InputArgument::REQUIRED, 'string'],
        ];
    }

    public function handle()
    {
        $resource = $this->argument('resource');
        $name = $this->argument('name');
        $type = $this->argument('type');

        try {
            $this->client()->customFields()->load($resource, $name);

            $this->info('Custom field\'s already exist');
        } catch (NotFoundException $e) {
            $this->client()->customFields()->create($resource, $name, [
                'type' => $type,
            ]);
        }
    }
}
