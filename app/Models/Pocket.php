<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pocket extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    /**
     * create new entry in pockets table
     *
     * @param array $data
     */
    public function createPocket($data)
    {
        return $this->create([
            'title' => $data['title']
        ]);
    }
}
