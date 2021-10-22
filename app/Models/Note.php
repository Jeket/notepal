<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\SlugOptions;

class Note extends Model
{
    use HasFactory;
    use HasSlug;

    protected $guarded = [];

    public function getNumberOfWordsAttribute(): int
    {
        return str_word_count($this->content ?? '');
    }

    public function getReadingTimeAttribute(): int
    {
        $wordCount = $this->number_of_words;
        $averageWordsPerMinute = 180;

        $readingTime = ceil($wordCount / $averageWordsPerMinute);

        return $readingTime < 1 ? 1 : $readingTime;
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
