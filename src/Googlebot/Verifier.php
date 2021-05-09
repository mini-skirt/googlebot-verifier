<?php
namespace MiniSkirt\Googlebot;

/**
* @see https://developers.google.com/search/docs/advanced/crawling/verifying-googlebot
*/
class Verifier
{
    const GOOGLE_DOMAIN             = '.google.com.';
    const GOOGLEBOT_DOMAIN          = '.googlebot.com.';
    const GOOGLEBOT_USER_AGENT_NAME = 'Googlebot';
    const GOOGLEBOT_USER_AGENT_URL  = 'http://www.google.com/bot.html';

    public static function verifyUserAgent(string $userAgent): bool
    {
        return (
            str_contains($userAgent, static::GOOGLEBOT_USER_AGENT_NAME) and
            str_contains($userAgent, static::GOOGLEBOT_USER_AGENT_URL)
        );
    }

    public static function verifyDNS(string $ipAddress): bool
    {
        $lookup = static::performReverseDNSLookup($ipAddress);
        if (
            (! str_ends_with($lookup, static::GOOGLE_DOMAIN)) and
            (! str_ends_with($lookup, static::GOOGLEBOT_DOMAIN))
        ) return false;

        return (
            static::getIPv4AddressOfHost($lookup) === $ipAddress
        );
    }

    public static function verify(string $ipAddress, string $userAgent = null): bool
    {
        if (is_null($userAgent)) return static::verifyDNS($ipAddress);

        return (
            static::verifyDNS($ipAddress) and
            static::verifyUserAgent($userAgent)
        );
    }

    public static function performReverseDNSLookup(string $ipAddress): string
    {
        $lookup = gethostbyaddr($ipAddress);
        return rtrim($lookup, '.') . '.';
    }

    public static function getIPv4AddressOfHost(string $host): string
    {
        return gethostbyname($host);
    }
}