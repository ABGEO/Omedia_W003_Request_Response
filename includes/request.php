<?php
function getHeaders()
{
    return array(
        'HOST' => $_SERVER['HTTP_HOST'],
        'USER_AGENT' => $_SERVER['HTTP_USER_AGENT'],
        'ACCEPT' => $_SERVER['HTTP_ACCEPT'],
        'ACCEPT_LANGUAGE' => $_SERVER['HTTP_ACCEPT_LANGUAGE'],
        'ACCEPT_ENCODING' => $_SERVER['HTTP_ACCEPT_ENCODING'],
        'COOKIE' => $_SERVER['HTTP_COOKIE']
    );
}

function getPath()
{
    return $_SERVER['PATH_INFO'];
}

function getScheme()
{
    return stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://';
}

function getPort()
{
    return $_SERVER['SERVER_PORT'];
}

function getQueryParams()
{
    $queryString = $_SERVER['QUERY_STRING'];
    $queryArray = explode('&', $queryString);

    $response = array();
    foreach ($queryArray as $query) {
        $query = explode('=', $query);
        $response[$query[0]] = $query[1];
    }


    return $response;
}

function get($key)
{
    $queryArray = getQueryParams();

    if (isset($queryArray[$key]))
        return $queryArray[$key];

    return "Value with key \"$key\" don't exists!";
}

function getData()
{
    $response = null;
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
        $response = $_GET;
    else if ($_SERVER['REQUEST_METHOD'] == 'POST')
        $response = $_POST;

    return $response;
}

function getClientIp()
{
    return $_SERVER['REMOTE_ADDR'];
}

function getCountry()
{
    $ipData = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . getClientIp()));
    $response = null;

    if ($ipData && $ipData->geoplugin_countryName != null)
        $response = $ipData->geoplugin_countryName;

    return $response;
}

function getMimeType()
{
    return explode(',', $_SERVER['HTTP_ACCEPT']);
}

function getBaseUrl()
{
    return getScheme() . $_SERVER['HTTP_HOST'];
}


