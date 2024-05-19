<?php

define('t_books','books');

function vasset($file){
    return route('admin.file',['filename'=>urlencode($file)]);
}

function isGet(){
    return request()->getMethod()=='GET';
}

function submissionStatues() {
    return [
        0=>'Pending',
        1=>'On Review',
        2=>'Accepted',
        3=>'Rejected',
        4=>'On Hold',
    ];
}

function submissionStatusColors() {
    return [
        0=>'text-warning',
        1=>'text-primary',
        2=>'text-success',
        3=>'text-danger',
        4=>'text-secondary',
    ];
}

