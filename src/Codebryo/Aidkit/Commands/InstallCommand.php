<?php namespace Codebryo\Aidkit\Commands;

use Illuminate\Console\Command;
use \File;

class InstallCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'aidkit:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get started using Aidkit';

    protected static $templatePath;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        static::$templatePath = __DIR__.'/../../../../templates';
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
    	if(File::exists(app_path().'/views_admin'))
    		return $this->error('Aidkit seems to be installed allready!');

    	$this->createFolders();
    	$this->createViews();
    	$this->createRoutes();
        return $this->info('Aidkit Installation complete!');
    }

    protected function createFolders()
    {
    	// Create the admin_views Folder
		File::makeDirectory(app_path().'/views_admin');
		File::makeDirectory(app_path().'/views_admin/layout');
		File::makeDirectory(app_path().'/views_admin/layout/partials');

		$this->info('/views_admin Folder created');

		File::makeDirectory(app_path().'/controllers/Admin');

		$this->info('/controllers/Admin Folder created');
    }

    protected function createViews()
    {
    	$templatePath = static::$templatePath;
    	File::put(app_path().'/views_admin/layout/layout.blade.php',File::get($templatePath.'/views/layout.txt'));
    	File::put(app_path().'/views_admin/layout/login.blade.php',File::get($templatePath.'/views/login.txt'));
    	File::put(app_path().'/views_admin/layout/partials/navigation.blade.php',File::get($templatePath.'/views/partials/navigation.txt'));
    	File::put(app_path().'/views_admin/layout/partials/profile.blade.php',File::get($templatePath.'/views/partials/profile.txt'));

    	$this->info('/views_admin Folder created');
    }

    protected function createRoutes()
    {
    	$templatePath = static::$templatePath;
    	File::put(app_path().'/routes_aidkit.php',File::get($templatePath.'/routes.txt'));

    	$this->info('/routes_aidkit created');
    }
}