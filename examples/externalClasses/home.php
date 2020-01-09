<?php

class Home
{
    public static function index($req, $res)
    {
        return $res->render(__DIR__ . '/views/home.php', array('ip' => $req->getRemoteAddress()));
    }

    public static function dashboard($req, $res)
    {
        return $res->render(__DIR__ . '/views/dashboard.php');
    }
}
