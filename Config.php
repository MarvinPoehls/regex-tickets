<?php

class Config
{
    const USERNAME = "";
    const PASSWORD = "";

    const LOGIN_URL = "https://tickets.fatchip.de/login.php";
    const URL = "https://tickets.fatchip.de/view_all_bug_page.php";
    const PATTERN = '/<tr bgcolor="([^"]*)"[^>]*><td>.*?<\/td><td>.*?<\/td><td>.*?<\/td><td><a href="([^"]*)"[^>]*>([^<]*)<\/a><\/td><td[^>]*>[^\[]*\[<a[^>]*>([^<]*)<\/a>].*?<\/td><td[^>]*>.*?<\/td><td[^>]*><span[^>]*>([^<]*)<\/span>(?:[^<]*<a[^>]*>([^<]*)<\/a>.)?<\/td><td[^>]*>.*?<\/td><td[^>]*>([^<]*)/';
}