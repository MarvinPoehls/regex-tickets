<?php

const URL = "https://tickets.fatchip.de/login.php";
const PATTERN = '/<tr bgcolor="([^"]*)"[^>]*><td>.*?<\/td><td>.*?<\/td><td>.*?<\/td><td><a href="([^"]*)"[^>]*>([^<]*)<\/a><\/td><td[^>]*>[^\[]*\[<a[^>]*>([^<]*)<\/a>].*?<\/td><td[^>]*>.*?<\/td><td[^>]*><span[^>]*>([^<]*)<\/span>(?:[^<]*<a[^>]*>([^<]*)<\/a>.)?<\/td><td[^>]*>.*?<\/td><td[^>]*>([^<]*)/';
$username = getRequestParameter("username");
$password = getRequestParameter("password");

$content = login($username, $password);

if (!$content) {
    $error = (isset($username) && isset($password)) ? '?error=Die+Anmeldedaten+sind+falsch.' : '';

    header('location:https://marvin.demoshop.rocks/tasks/regex/tickets/login.php'.$error);
}

preg_match_all(PATTERN, $content, $matches);

include "view.php";

function getRequestParameter($key, $default = null) {
    if (isset($_REQUEST[$key])) {
        $value = trim($_REQUEST[$key]);

        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
    return $default;
}

function login($username, $password): string|bool
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, URL);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt ($curl, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($curl, CURLOPT_HEADER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query([
        'username' => $username,
        'password' => $password,
        'return' => '/view_all_bug_page.php'
    ]));
    $content = curl_exec($curl);
    $contentUrl = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);

    if ($contentUrl == 'https://tickets.fatchip.de/view_all_bug_page.php') {
        return $content;
    }
    return false;
}

function getContent($url): bool|string
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    return curl_exec($curl);
}

