<?php
class Router
{
    static public function parse($url, $request)
    {
        $url = parse_url(trim($url));
        $explode_url = explode('/', $url['path']);
        if(!$explode_url[1] || !$explode_url[2]) {
            $request->controller = 'tasks';
            $request->action = 'index';
        } else {
            $request->controller = $explode_url[1];
            $request->action = $explode_url[2];
        }
        parse_str(isset($url['query']) ? $url['query'] : '', $output);
        $request->params = $output;
    }
}