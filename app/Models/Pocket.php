<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Content;

class Pocket extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    /**
     * Initialize content table relationship
     */
    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    /**
     * create new entry in pockets table
     *
     * @param array $data
     * 
     * @return object
     */
    public function createPocket($data)
    {
        return $this->create([
            'title' => $data['title']
        ]);
    }
}
