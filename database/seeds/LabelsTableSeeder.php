<?php

use Illuminate\Database\Seeder;
use App\Label;

class LabelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $label = new Label();
      $label->name = "Mobile phone";
      $label->save();

      $label = new Label();
      $label->name = "Office phone";
      $label->save();

      $label = new Label();
      $label->name = "Home phone";
      $label->save();
    }
}
