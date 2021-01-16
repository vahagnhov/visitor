<?php

class VisitorInfo
{
    /**
     * Get visitor IP address
     *
     * @return array $ipAddress
     */
    public function getIPAddress()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ipAddress = $_SERVER['REMOTE_ADDR'];
        }
        return $ipAddress ? $ipAddress : null;
    }

    /**
     * Get Page Url
     *
     * @return array $ipAddress
     */
    public function getPageUrl()
    {
        $pageUrl = null;
        if (!empty($_SERVER['HTTP_REFERER'])) {
            $pageUrl = $_SERVER['HTTP_REFERER'];
        }
        return $pageUrl;
    }

    /**
     * Get User Agent
     *
     * @return array $ipAddress
     */
    public function getUserAgent()
    {
        $userAgent = null;
        if (!empty($_SERVER['HTTP_USER_AGENT'])) {
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
        }
        return $userAgent;
    }

    /**
     * Get Image
     * @return string $image
     */
    public function getImage()
    {
        $image = 'image1.jpg';
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';
        $path = str_replace($protocol . "" . $_SERVER['HTTP_HOST'] . "/", "", $this->getPageUrl());
        if ($path == 'index2.html') {
            $image = 'image2.jpg';
        }
        return $image;
    }


}