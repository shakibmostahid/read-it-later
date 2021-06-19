<?php

namespace App\Models;

use App\Events\PocketContentSaved;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pocket;

class Content extends Model
{
    use HasFactory;

    protected $fillable = ['pocket_id', 'url', 'title', 'excerpt', 'image_url'];

    /**
     * Initialize pocket table relationship
     */
    public function pocket()
    {
        return $this->belongsTo(Pocket::class);
    }

    /**
     * creates content for an existing pocket
     *
     * @param array $data
     * @param int $pocketId
     * 
     * @return object
     */
    public function createPocketContent($data, $pocketId)
    {
        $url = (strncasecmp('http://', $data['url'], 7) && strncasecmp('https://', $data['url'], 8) ? 'https://' : '') . $data['url'];
        $content = $this->create([
            'pocket_id' => $pocketId,
            'url' => $url
        ]);

        PocketContentSaved::dispatch($content);

        return $content;
    }

    /**
     * update content after scraping the details
     *
     * @param array $data
     * 
     * @return object
     */
    public function updateContentAfterScraping(array $data)
    {
        return $this->update([
            'title' => $data['title'],
            'excerpt' => $data['excerpt'],
            'image_url' => $data['image_url']
        ]);
    }
}
