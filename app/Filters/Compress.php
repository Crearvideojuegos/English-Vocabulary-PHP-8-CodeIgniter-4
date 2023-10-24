<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Compress implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

        $buffer = $request->getBody();

        while (ob_get_level() > 0)
        {
            ob_end_flush();
        }
    
        ob_start(function ($buffer) {
            $search = array(
                '/\n/',      // replace end of line by a <del>space</del> nothing , if you want space make it down ' ' instead of ''
                '/\>[^\S ]+/s',    // strip whitespaces after tags, except space
                '/[^\S ]+\</s',    // strip whitespaces before tags, except space
                '/(\s)+/s',    // shorten multiple whitespace sequences
                '/<!--(.|\s)*?-->/' //remove HTML comments
            );
    
            $replace = array(
                '',
                '>',
                '<',
                '\\1',
                ''
            );
    
            $buffer = preg_replace($search, $replace, $buffer);
            return $buffer;
        });

    }
}