<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'Product_name',
        'Gender',
        'Price',
        'Shipping',
        'Category',
        'Saved_img',
        'Img_src',
        'Img_alts',
        'size1',
        'size2',
        'size3',
        'size4',
        'size5',
        'Description',
        'highlight1',
        'highlight2',
        'highlight3',
        'rating',
    ];
}