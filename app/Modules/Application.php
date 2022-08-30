<?php

namespace App\Modules;

class Application
{
    public function run(string $url): void
    {
        $parser = new HTMLParser();
        $parser->setUrl($url);
        $parser->parse();
    }
}