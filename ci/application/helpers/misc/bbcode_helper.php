<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

    /**
     * CodeIgniter BBCode Helpers.
     *
     * @category Helpers
     *
     * @author  Philip Sturgeon
     * @changes  MpaK http://mrak7.com
     *
     * @link  http://codeigniter.com/wiki/BBCode_Helper/
     */

    // ------------------------------------------------------------------------

    /**
     * parse_bbcode.
     *
     * Converts BBCode style tags into basic HTML
     *
     * @param string unparsed string
     * @param int max image width
     *
     * @return string
     */
    function parse_bbcode($str = '', $max_images = 0)
    {
        // Max image size eh? Better shrink that pic!
    if ($max_images > 0):
       $str_max = 'style=90c9dd5c5a6af4ca5a62c0fac27a75403da1f915quot;max-width:'.$max_images.'px; width: [removed]this.width > '.$max_images.' ? '.$max_images.': true);90c9dd5c5a6af4ca5a62c0fac27a75403da1f915quot;';
        endif;

        $str = nl2br($str);

        $find = array(
      "'\[b\](.*?)\[/b\]'is",
      "'\[i\](.*?)\[/i\]'is",
      "'\[u\](.*?)\[/u\]'is",
      "'\[s\](.*?)\[/s\]'is",
      "'\[youtube\](.*?)\[/youtube\]'is",
      "'\[font=(.*?)\](.*?)\[/font\]'is",
      "'\[color=(.*?)\](.*?)\[/color\]'is",
      "'\[ul\](.*?)\[/ul\]'is",
      "'\[li\](.*?)\[/li\]'is",
      "'\[img\](.*?)\[/img\]'i",
      "'\[url\](.*?)\[/url\]'i",
      "'\[url=(.*?)\](.*?)\[/url\]'i",
      "'\[link\](.*?)\[/link\]'i",
      "'\[link=(.*?)\](.*?)\[/link\]'i",
    );

        $replace = array(
      '<strong>\1</strong>',
      '<em>\1</em>',
      '<u>\1</u>',
      '<s>\1</s>',
      '<center><iframe width="560" height="315" src="http://www.youtube.com/embed/\1" frameborder="0" allowfullscreen></iframe></center>',
      '<span style="font-family:\1;">\2</span>',
      '<span style="color:\1;">\2</span>',
      '<ul>\1</ul>',
      '<li>\1</li>',
      '<img src="\1" alt="" />',
      '<a href="\1">\1</a>',
      '<a href="\1">\2</a>',
      '<a href="\1">\1</a>',
      '<a href="\1">\2</a>',
    );

        return preg_replace($find, $replace, $str);
    }
