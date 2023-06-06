<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $fillable = [
        'title',
        'category_id',
        'user_id',
        'banner',
        'content',
    ];

    protected $casts = [
        'created_at' => 'datetime:d M Y',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function getDate()
    {
        return Carbon::parse($this->updated_at)->format('d M Y');
    }

    public function getBanner()
    {
        return asset('storage/banner_article/'.$this->banner);
    }

    public function firstSentence()
    {
        $content = $this->content;
        return strlen($content) > 150 ? substr($content,0,150)."..." : $content;
    }

    public function firstPhrase()
    {
        $content = $this->content;
        return strlen($content) > 20 ? substr($content,0,20)."..." : $content;
    }

    public function shortTitle()
    {
        $title = $this->title;
        return strlen($title) > 18 ? substr($title,0,18)."..." : $title;
    }
}
