<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Exception;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user {--bash}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new user for the app';

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
     * @return int
     */
    public function handle()
    {
        if ($this->option('bash')) {
            $this->createFromBash();
        } else {
            $this->createFromCommandLine();
        }
    }
    
    /**
     * If the command is called from a bash script and needs the user 
     * to be created for sure
     */
    public function createFromBash()
    {
        $name = $this->ask('Insert name');
        $email = $this->ask('Insert email');
        
        while (User::where('email', $email)->count() > 0) {
            $this->error('User with that email already exists');
            $email = $this->ask('Insert email');
        }
        
        $password = $this->secret('Insert password');
        $confirm = $this->secret('Confirm password');
        
        while ($password !== $confirm) {
            $this->error('Passwords do not match');
            $password = $this->secret('Insert password');
            $confirm = $this->secret('Confirm password');
        }
        
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);

        $this->info('User created successfully');
    }
    
    /**
     * If creating the user is not a must
     */
    public function createFromCommandLine() 
    {
        $name = $this->ask('Insert name');
        $email = $this->ask('Insert email');
        $password = $this->secret('Insert password');
        $confirm = $this->secret('Confirm password');
        
        if (User::where('email', $email)->count() > 0) {
            $this->error('User with that email already exists');
        } elseif ($password !== $confirm) {
            $this->error('Passwords do not match');
        } else {
            try {
                User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make($password)
                ]);
                
                $this->info('User created successfully');
            } catch (Exception $exception) {
                $this->error('Could not create user');
            }
        }
    }
}
