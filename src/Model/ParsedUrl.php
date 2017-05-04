<?php

namespace App\Model;

class ParsedUrl implements \JsonSerializable
{
    /**
     * @var array
     */
    protected $_attributes;

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->_attributes['domain'];
    }

    /**
     * @param string $domain
     * @return $this
     */
    public function setDomain($domain)
    {
        $this->_attributes['domain'] = $domain;
        return $this;
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->_attributes['extension'];
    }

    /**
     * @param string $extension
     * @return $this
     */
    public function setExtension($extension)
    {
        $this->_attributes['extension'] = $extension;
        return $this;
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->_attributes['file'];
    }

    /**
     * @param string $file
     * @return $this
     */
    public function setFile($file)
    {
        $this->_attributes['file'] = $file;
        return $this;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->_attributes['params'];
    }

    /**
     * @param array $params
     * @return $this
     */
    public function setParams(array $params)
    {
        $this->_attributes['params'] = $params;
        return $this;
    }

    /**
     * @param string $name
     * @param string $val
     * @return $this
     */
    public function addParam($name, $val)
    {
        $this->_attributes['params'][$name] = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getProtocol()
    {
        return $this->_attributes['protocol'];
    }

    /**
     * @param string $protocol
     * @return $this
     */
    public function setProtocol($protocol)
    {
        $this->_attributes['protocol'] = $protocol;
        return $this;
    }

    /**
     * @return array
     */
    public function getRoute()
    {
        return $this->_attributes['route'];
    }

    /**
     * @param array $route
     * @return $this
     */
    public function setRoute($route)
    {
        $this->_attributes['route'] = $route;
        return $this;
    }

    /**
     * @param string $routePart
     * @return $this
     */
    public function addRoutePart($routePart)
    {
        $this->_attributes['route'][] = $routePart;
        return $this;
    }

    /**
     * @return array
     */
    public function getSubdomain()
    {
        return $this->_attributes['subdomain'];
    }

    /**
     * @param array $subdomain
     * @return $this
     */
    public function setSubdomain($subdomain)
    {
        $this->_attributes['subdomain'] = $subdomain;
        return $this;
    }

    /**
     * @param string $subdomainPart
     * @return $this
     */
    public function addSubdomainPart($subdomainPart)
    {
        $this->_attributes['subdomain'][] = $subdomainPart;
        return $this;
    }

    /**
     * @return string
     */
    public function getTld()
    {
        return $this->_attributes['tld'];
    }

    /**
     * @param string $tld
     * @return $this
     */
    public function setTld($tld)
    {
        $this->_attributes['tld'] = $tld;
        return $this;
    }

    /**
     * @return string
     */
    public function getFullUrl()
    {
        return $this->_attributes['fullUrl'];
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setFullUrl($url)
    {
        $this->_attributes['fullUrl'] = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function jsonSerialize()
    {
        return json_encode($this->getAttributes(), JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->jsonSerialize();
    }

    public function getAttributes()
    {
        return $this->_attributes;
    }
}
