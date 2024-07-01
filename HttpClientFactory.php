<?php
class HttpClientFactory
{
    public static function create()
    {
        return new HttpClient();
    }
}
