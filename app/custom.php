<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

define('t_books', 'books');

function vasset($file)
{
    // return route('admin.file',['filename'=>urlencode($file)]);
    return asset($file).'?v='.config('app.version');
}

function isGet()
{
    return request()->getMethod() == 'GET';
}

function submissionStatues()
{
    return [
        0 => 'Pending',
        1 => 'On Review',
        2 => 'Reviewed',
        3 => 'Accepted',
        4 => 'Rejected',
        5 => 'On Hold',
    ];
}

function submissionStatusMsg()
{
    return [
        0 => 'is Pending',
        1 => 'is On Review',
        2 => 'has been Reviewed',
        3 => 'has been Accepted',
        4 => 'has been Rejected',
        5 => 'has been put On Hold',
    ];
}

function submissionStatusColors()
{
    return [
        0 => 'text-warning',
        1 => 'text-primary',
        2 => 'text-primary',
        3 => 'text-success',
        4 => 'text-danger',
        5 => 'text-secondary',
    ];
}

function getGeneralLayout()
{
    return Cache::rememberForever('generallayouts', function () {
        return DB::table('generallayouts')->first();
    }) ?? ((object) [
        'copy_right_name' => '', 'short_desc' => '', 'long_Desc' => '', 'logo' => '', 'content' => '',
    ]);
}

function getArticleDetail($article_id)
{

}
