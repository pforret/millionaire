<?php

namespace App\Console\Commands;

use App\Models\Currency;
use App\Models\Rate;
use Illuminate\Console\Command;
use Intervention\Image\ImageManager;


class ImageCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'million:images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create images for each currency';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $manager = new ImageManager(['driver' => 'gd']);
        $currencies = Rate::last_rates();
        foreach($currencies as $currency){
            $code = $currency->code;
            $image = $manager->make('public/images/background3.jpg')->resize(800, 400);
            $budget = number_format(1000000 / $currency->rate,0,","," ");
            $image->text("To be a\n$currency->name\nmillionaire,\nyou need $budget €", 400, 200, function($font) {
                $font->file('storage/fonts/Nunito-Bold.ttf');
                $font->size(60);
                $font->color('#FFFFFF');
                $font->align('center');
                $font->valign('center');
            });
            $image->text(date("Y-m-d"), 32, 16, function($font) {
                $font->file('storage/fonts/Nunito-Light.ttf');
                $font->size(16);
                $font->color('#FFFFFF');
                $font->valign('top');
            });
            $image->save("storage/app/public/$code.jpg");

        }

        return 0;
    }
}
