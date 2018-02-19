<?php

namespace Bantenprov\GroupEgovernment\Console\Commands;

use Illuminate\Console\Command;

/**
 * The GroupEgovernmentCommand class.
 *
 * @package Bantenprov\GroupEgovernment
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class GroupEgovernmentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bantenprov:group-egoverment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Demo command for Bantenprov\GroupEgovernment package';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Welcome to command for Bantenprov\GroupEgovernment package');
    }
}
