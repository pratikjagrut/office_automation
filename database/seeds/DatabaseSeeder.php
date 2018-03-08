<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Profile::class,10)->create();
        factory(App\User::class,10)->create();
        factory(App\CcRefund::class,10)->create();
        factory(App\CcExtension::class,10)->create();
        factory(App\CcDownArea::class,10)->create();
        factory(App\SalesIll::class,10)->create();
        factory(App\SalesP2p::class,10)->create();
        factory(App\SalesApprovalNote::class,10)->create();
        factory(App\Voip::class,10)->create();
        factory(App\DocumentApproval::class,10)->create();
        factory(App\HrManpower::class,10)->create();
        factory(App\HrStationery::class,10)->create();
        factory(App\CcFeasibleArea::class,10)->create();
        factory(App\Inventory::class,10)->create();
        
    }
    }
