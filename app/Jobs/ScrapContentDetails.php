<?php

namespace App\Jobs;

use App\Models\Content;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Goutte\Client;

class ScrapContentDetails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $content;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Content $content)
    {
        $this->content = $content;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new Client();
        $webPageDetails = $client->request('GET', $this->content->url);

        $data = [
            'title' => $this->getWebsiteTitle($webPageDetails),
            'excerpt' => $this->getWebsiteExcerpt($webPageDetails),
            'image_url' => $this->getWebsiteOgImage($webPageDetails)
        ];

        $this->content->updateContentAfterScraping($data);
    }

    /**
     * scrap the page title
     *
     * @param Crawler $page
     * 
     * @return string|null $title
     */
    private function getWebsiteTitle($page)
    {
        $title = null;

        if (($h1 = $page->filter('h1')) && $h1->count() > 0) {
            $title = $h1->text();
        } elseif (($h2 = $page->filter('h2')) && $h2->count() > 0) {
            $title = $h2->text();
        } elseif (($titleTag = $page->filter('title')) && $titleTag->count() > 0) {
            $title = $titleTag->text();
        }

        return $title;
    }

    /**
     * Get website excerpt
     *
     * @param Crawler $page
     * 
     * @return string|null $excerpt
     */
    private function getWebsiteExcerpt($page)
    {
        $excerpt = null;

        if (($desc = $page->filterXpath('//meta[@name="description"]')) && $desc->count() > 0) {
            $excerpt = $desc->attr('content');
        } elseif (($ogDesc = $page->filterXpath('//meta[@property="og:description"]')) && $ogDesc->count() > 0) {
            $excerpt = $ogDesc->attr('content');
        } elseif (($twitterDesc = $page->filterXpath('//meta[@property="twitter:description"]')) && $twitterDesc->count() > 0) {
            $excerpt = $twitterDesc->attr('content');
        } elseif (($paragraph = $page->filter('p')) && $paragraph->count() > 0) {
            $excerpt = $paragraph->text();
        }

        return $excerpt;
    }

    /**
     * get og image url
     *
     * @param Crawler $page
     * 
     * @return string|null
     */
    private function getWebsiteOgImage($page)
    {
        return (($ogImage = $page->filterXpath('//meta[@property="og:image"]')) && $ogImage->count() > 0) ?
            $ogImage->attr('content') : null;
    }
}
