<?php

namespace App\Service;

use App\Common\SingletonTrait;
use App\Model\ParsedUrl;

class UrlParser
{
    use SingletonTrait;

    /**
     * @param string $fullUrlString
     * @return ParsedUrl
     * @TODO: This should really be split into separate methods
     */
    public function parseUrlFromString($fullUrlString)
    {
        // $fullUrlString = 'http://david.veli.la/foo/bar/myfile.tar.gz?x=1&y=2';
        // $fullUrlString = 'http://{host_name}/dsim/test/?v=4&p=4rc3g7c37x4n7g';
        // $fullUrlString = 'http://{host_name}/dsim/test.php?par=2&impar=3';
        $parsedUrl = new ParsedUrl();

        $parsedUrl->setFullUrl($fullUrlString);

        $parts1 = explode('://', $fullUrlString);
        $parsedUrl->setProtocol($parts1[0]);

        $parts2 = explode('/', $parts1[1]);

        $fullDomain = $parts2[0];

        $parts3 = explode('.', $fullDomain);
        $domainParts = array_reverse($parts3);
        $parsedUrl->setTld($domainParts[0]);
        if (array_key_exists(1, $domainParts)) {
            $parsedUrl->setDomain($domainParts[1]);
            if (count($domainParts) >= 3) {
                unset($parts3[count($parts3) - 1]); //last item: tld
                unset($parts3[count($parts3) - 1]); //previous: domain
                foreach ($parts3 as $subdomainPart) {
                    $parsedUrl->addSubdomainPart($subdomainPart);
                }
            }
        }

        $restOfUrl = str_replace($parts2[0], '', $parts1[1]);
        $parts4 = explode('?', $restOfUrl);

        if (count($parts4) > 1) {
            $query = $parts4[count($parts4) - 1];
            $paramParts = explode('&', $query);
            foreach ($paramParts as $paramPart) {
                $paramKeyVal = explode('=', $paramPart);
                $parsedUrl->addParam($paramKeyVal[0], $paramKeyVal[1]);
            }
        }

        $fullRoute = $parts4[0];
        $routeParts = explode('/', $fullRoute);
        $lastRoutePart = $routeParts[count($routeParts) - 1];
        $parts5 = explode('.', $lastRoutePart);
        $file = $parts5[0];
        if (strlen($file) > 0) {
            $parsedUrl->setFile($file);
        }
        if (count($parts5) > 1) {
            unset($parts5[0]);
            $extension = implode('.', $parts5); //e.g: tar.gz
            $parsedUrl->setExtension($extension);
        }

        unset($routeParts[count($routeParts) - 1]);
        foreach ($routeParts as $routePart) {
            if (strlen($routePart) <= 0) {
                continue;
            }
            $parsedUrl->addRoutePart($routePart);
        }

        return $parsedUrl;
    }

    public function parseUrlFromUri(\Slim\Http\Uri $uri)
    {
        $string = $this->buildUrlStringFromUri($uri);
        return $this->parseUrlFromString($string);
    }

    public function buildUrlStringFromUri(\Slim\Http\Uri $uri)
    {
        //For the sake of this exercise, we ignore port, user, pass
        $protocol = $uri->getScheme() . '://';
        $host = $uri->getHost();
        $path = str_replace('//', '/', $uri->getPath() . $uri->getBasePath());
        $query = $uri->getQuery() ? ('?' . $uri->getQuery()) : '';

        return $protocol . $host . $path . $query;
    }
}