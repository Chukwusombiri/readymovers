<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemap for google site crawlers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Sitemap::create()
        ->add(Url::create('/')->setLastModificationDate(Carbon::yesterday())->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)->setPriority(0.1))
            ->add(Url::create('/our-services')->setLastModificationDate(Carbon::yesterday())->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)->setPriority(0.1))
            ->add(Url::create('/about-' . config('app.name'))->setLastModificationDate(Carbon::yesterday())->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)->setPriority(0.1))
            ->add(Url::create('/tracking-shipment')->setLastModificationDate(Carbon::yesterday())->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)->setPriority(0.1))
            ->add(Url::create('/get-an-instant-quote/delivery-items-details')->setLastModificationDate(Carbon::yesterday())->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)->setPriority(0.1))
            ->add(Url::create('/get-an-instant-quote/delivery-details')->setLastModificationDate(Carbon::yesterday())->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)->setPriority(0.1))
            ->add(Url::create('/get-an-instant-quote/delivery/personal-details')->setLastModificationDate(Carbon::yesterday())->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)->setPriority(0.1))
            ->add(Url::create('/show-booking-quote-details')->setLastModificationDate(Carbon::yesterday())->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)->setPriority(0.1))
            ->add(Url::create('/contact-us')->setLastModificationDate(Carbon::yesterday())->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)->setPriority(0.1))            
            ->add(Url::create('/confirm-modify-pick-up')->setLastModificationDate(Carbon::yesterday())->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)->setPriority(0.1))            
            ->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully.');
    }
}
