<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pocket;

class Content extends Model
{
    use HasFactory;

    protected $fillable = ['pocket_id', 'url'];

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
        return $this->create([
            'pocket_id' => $pocketId,
            'url' => $data['url']
        ]);
    }
}
