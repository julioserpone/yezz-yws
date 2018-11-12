<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Model::unguard();

        $this->call(MenuRoutesTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(ProvincesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(ColorsTableSeeder::class);
        $this->call(RoutesTableSeeder::class);
        $this->call(WorkshopsTableSeeder::class);
        $this->call(CouriersTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(FamiliesTableSeeder::class);
        $this->call(ChainsTableSeeder::class);
        $this->call(ProductsTypeTableSeeder::class);
        $this->call(ScalesTableSeeder::class);
        $this->call(TechnologiesTableSeeder::class);
        $this->call(ActionsTableSeeder::class);
        $this->call(DiagnosticsTableSeeder::class);
        $this->call(FailuresTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ClientsTableSeeder::class);
        $this->call(AttributesTableSeeder::class);
        $this->call(CountryAttributesTableSeeder::class);
        $this->call(EmailTemplatesTableSeeder::class);
        $this->call(ReportGroupItemSeeder::class);

        Model::reguard();
    }
}
