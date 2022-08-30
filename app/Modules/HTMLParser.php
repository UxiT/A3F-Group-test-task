<?php

namespace App\Modules;

class HTMLParser
{
    protected string $url;

    protected string $pattern = '/<\w+\s?[^a-zA-Z0-9\.\;\&\?\-\+\*\^\:\%\#\@]/';

    public function parse()
    {
        $page = $this->getPage();
        $splitTags = $this->parseTags($page);
        print_r($this->countTags($splitTags));
    }

    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    private function getPage(): bool|string
    {
        $curl = curl_init($this->url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        return curl_exec($curl);
    }

    private function parseTags(string $page)
    {
        $matches = [];
        preg_match_all($this->pattern, $page, $matches);
        return $matches[0];
    }

    private function countTags(array $splitTags): array
    {
        $tags = [];
        foreach ($splitTags as $tag)
        {
            $tag = trim($tag, "<> ");
            if (in_array($tag, array_keys($tags))) {
                $tags[$tag] += 1;
            } else {
                $tags[$tag] = 1;
            }
        }

        return $tags;
    }
}