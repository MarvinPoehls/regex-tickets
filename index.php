<?php

require "Config.php";

$content = getContent();
if (!$content) {
    if (login(Config::USERNAME, Config::PASSWORD)) {
        $content = getContent();
    } else {
        exit("Error: Content couldn't be loaded");
    }
}

preg_match_all(Config::PATTERN, $content, $matches);

include "view.php";

function getRequestParameter($key, $default = null) {
    if (isset($_REQUEST[$key])) {
        $value = trim($_REQUEST[$key]);

        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
    return $default;
}

function getContent(): string|bool
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, Config::URL);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($curl, CURLOPT_COOKIEFILE, 'cookie.txt');
    curl_setopt($curl, CURLOPT_POST, true);
    $content = curl_exec($curl);
    $contentUrl = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);

    if ($contentUrl == 'https://tickets.fatchip.de/view_all_bug_page.php') {
        return $content;
    }
    return false;
}

function login($username, $password): bool
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, Config::LOGIN_URL);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($curl, CURLOPT_COOKIEFILE, 'cookie.txt');
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query([
        'username' => $username,
        'password' => $password,
        'return' => '/view_all_bug_page.php'
    ]));
    curl_exec($curl);

    return curl_getinfo($curl, CURLINFO_EFFECTIVE_URL) == 'https://tickets.fatchip.de/view_all_bug_page.php';
}
