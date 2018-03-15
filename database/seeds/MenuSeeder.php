<?php

use Illuminate\Database\Seeder;
use App\Repositories\Models\Menu;
use App\Repositories\Models\RecursiveRelation;
use Illuminate\Support\Facades\Artisan;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Truncating Menu, RecursiveRelation tables');
        $this->truncateTables();
 
        $config = config('seeder.menu.structure');
        $maps = config('seeder.menu.maps');

        $parentMenu = Null;

        $this->createMenus($config, $parentMenu, $maps);
    }

    private function createMenus($config, $parentMenu, $maps)
    {
    	foreach($config as $key => $modules) {
    		if ( isset($modules['next'])) {
    			$menu = Menu::create([
        			'name' => $maps[$key],
        			'route' => '#',
                    'icon' => $modules['icon'],
                    'permission' => $modules['permission'],
        			'route_prefix' => $modules['route_prefix'],
        		]);
    			$this->createMenus($modules['next'], $menu, $maps);
    		} else {
    			/*进行保存*/
        		$menu = Menu::create([
        			'name' => $maps[$key],
        			'route' => $modules['route'],
                    'icon' => $modules['icon'],
                    'permission' => $modules['permission'],
        			'route_prefix' => $modules['route_prefix'],
        		]);
    		}

        	if($parentMenu) {
        		$menu->parentMenu()->attach($parentMenu);
    		}
        }

        Artisan::call('cache:clear');
    }

    private function truncateTables()
    {
    	Schema::disableForeignKeyConstraints();
        DB::table('recursive_relations')->truncate();
        Menu::truncate();
        Schema::enableForeignKeyConstraints();
    }
}
