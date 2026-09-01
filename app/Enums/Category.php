<?php

namespace App\Enums;

enum Category: string
{
    // 可接受的文章分類
    case Tutorial = 'tutorial';

        // 可接受的新聞分類
    case News = 'news';
}
