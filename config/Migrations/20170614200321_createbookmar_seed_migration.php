<?php

use Phinx\Migration\AbstractMigration;

class CreatebookmarSeedMigration extends AbstractMigration
{

    public function up()
    {
        $faker = \Faker\Factory::create();
        $populator = new Faker\ORM\CakePHP\populator($faker);
        $populator->addEntity('bookmarks',200, [
            'title' => function() use ($faker){return $faker->sentence($nbwords=3,$variableNbwords = true);},
            'description' => function() use ($faker){return $faker->paragraph($nbsentence=3,$variableNbsentences = true);},
             'url' => function() use ($faker){return $faker->url;},
             'created'=>function() use ($faker){return $faker->datetimeBetween($startData = 'now', $endDate='now');},
            'modified'=>function() use ($faker){return $faker->datetimeBetween($startData = 'now', $endDate='now');},
            'user_id' => function(){
                return rand(1,107);
            }

            


            ]);
        $populator->execute();
    }
}
