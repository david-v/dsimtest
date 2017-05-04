<?php

namespace App\Controller;

use App\Service\UrlParser;

class ParseUrlController extends BaseController
{
    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function parseUrl()
    {
        /** @var \App\Model\ParsedUrl $parsedUrlModel */
        /** @var \App\Service\UrlParser $parserService */
        $uri = $this->getRequest()->getUri();
        $parserService = UrlParser::getInstance();
        $parsedUrlModel = $parserService->parseUrlFromUri($uri);
        $response = $this->getResponse();
        $response->withStatus(200);
        return $this->getRenderer()->render(
            $response,
            'index.phtml',
            ['parsedUrl' => $parsedUrlModel]
        );
    }
}