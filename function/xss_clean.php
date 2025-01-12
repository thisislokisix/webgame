<?php
function xss_clean($str, $charset = 'UTF-8')
{
    /*
    * Remove Null Characters
    *
    * This prevents sandwiching null characters
    * between ascii characters, like Java\0script.
    *
    */
    $str = preg_replace('/\0+/', '', $str);
    $str = preg_replace('/(\\\\0)+/', '', $str);

    /*
    * Validate standard character entities
    *
    * Add a semicolon if missing.  We do this to enable
    * the conversion of entities to ASCII later.
    *
    */
    $str = preg_replace('#(&\#*\w+)[\x00-\x20]+;#u', "\\1;", $str);

    /*
    * Validate UTF16 two byte encoding (x00)
    *
    * Just as above, adds a semicolon if missing.
    *
    */
    $str = preg_replace('#(&\#x*)([0-9A-F]+);*#iu', "\\1\\2;", $str);

    /*
    * URL Decode
    *
    * Just in case stuff like this is submitted:
    *
    * <a href="http://%77%77%77%2E%67%6F%6F%67%6C%65%2E%63%6F%6D">Google</a>
    *
    * Note: Normally urldecode() would be easier but it removes plus signs
    *
    */
    $str = preg_replace("/%u0([a-z0-9]{3})/i", "\\1;", $str);
    $str = preg_replace("/%([a-z0-9]{2})/i", "\\1;", $str);

    /*
    * Convert character entities to ASCII
    *
    * This permits our tests below to work reliably.
    * We only convert entities that are within tags since
    * these are the ones that will pose security problems.
    *
    */
    if (preg_match_all("/<(.+?)>/si", $str, $matches)) {
        for ($i = 0; $i < count($matches['0']); $i++) {
            $str = str_replace($matches['1'][$i],
                $this->_html_entity_decode($matches['1'][$i], $charset),
                $str);
        }
    }

    /*
    * Not Allowed Under Any Conditions
    */
    $bad = array(
        'document.cookie' => '[removed]',
        'document.write' => '[removed]',
        'window.location' => '[removed]',
        "javascript\s*:" => '[removed]',
        "Redirect\s+302" => '[removed]',
        '<!--' => '<!--',
        '-->' => '-->'
    );

    foreach ($bad as $key => $val) {
        $str = preg_replace("#" . $key . "#i", $val, $str);
    }

    /*
    * Convert all tabs to spaces
    *
    * This prevents strings like this: ja    vascript
    * Note: we deal with spaces between characters later.
    *
    */
    $str = preg_replace("#\t+#", " ", $str);

    /*
    * Makes PHP tags safe
    *
    *  Note: XML tags are inadvertently replaced too:
    *
    *    *
    * But it doesn't seem to pose a problem.
    *
    */
    $str = str_replace(array(''), array(''), $str);

    /*
    * Compact any exploded words
    *
    * This corrects words like:  j a v a s c r i p t
    * These words are compacted back to their correct state.
    *
    */
    $words = array('javascript', 'vbscript', 'script', 'applet', 'alert', 'document', 'write', 'cookie', 'window');
    foreach ($words as $word) {
        $temp = '';
        for ($i = 0; $i < strlen($word); $i++) {
            $temp .= substr($word, $i, 1) . "\s*";
        }

        $temp = substr($temp, 0, -3);
        $str = preg_replace('#' . $temp . '#s', $word, $str);
        $str = preg_replace('#' . ucfirst($temp) . '#s', ucfirst($word), $str);
    }

    /*
    * Remove disallowed Javascript in links or img tags
    */
    $str = preg_replace("#<a.+?href=.*?(alert\(|alert&\#40;|javascript\:|window\.|document\.|\.cookie|<script|<xss).*?\>.*?</a>#si", "", $str);
    $str = preg_replace("#<img.+?src=.*?(alert\(|alert&\#40;|javascript\:|window\.|document\.|\.cookie|<script|<xss).*?\>#si", "", $str);
    $str = preg_replace("#<(script|xss).*?\>#si", "", $str);

    /*
    * Remove JavaScript Event Handlers
    *
    * Note: This code is a little blunt.  It removes
    * the event handler and anything up to the closing >,
    * but it's unlikely to be a problem.
    *
    */
    $str = preg_replace('#(<[^>]+.*?)(onblur|onchange|onclick|onfocus|onload|onmouseover|onmouseup|onmousedown|onselect|onsubmit|onunload|onkeypress|onkeydown|onkeyup|onresize)[^>]*>#iU', "\\1>", $str);

    /*
    * Sanitize naughty HTML elements
    *
    * If a tag containing any of the words in the list
    * below is found, the tag gets converted to entities.
    *
    * So this: <blink>
        * Becomes: <blink>
        *
        */
    $str = preg_replace('#<(/*\s*)(alert|applet|basefont|base|behavior|bgsound|blink|body|embed|expression|form|frameset|frame|head|html|ilayer|iframe|input|layer|link|meta|object|plaintext|style|script|textarea|title|xml|xss)([^>]*)>#is', "<\\1\\2\\3>", $str);

    /*
     * Sanitize naughty scripting elements
     *
     * Similar to above, only instead of looking for
     * tags it looks for PHP and JavaScript commands
     * that are disallowed.  Rather than removing the
     * code, it simply converts the parenthesis to entities
     * rendering the code un-executable.
     *
     * For example:    eval('some code')
     * Becomes:        eval('some code')
     *
     */
    $str = preg_replace('#(alert|cmd|passthru|eval|exec|system|fopen|fsockopen|file|file_get_contents|readfile|unlink)(\s*)\((.*?)\)#si', "\\1\\2(\\3)", $str);

    /*
     * Final clean up
     *
     * This adds a bit of extra precaution in case
     * something got through the above filters
     *
     */
    $bad = array
    (
        'document.cookie' => '[removed]',
        'document.write' => '[removed]',
        'window.location' => '[removed]',
        "javascript\s*:" => '[removed]',
        "Redirect\s+302" => '[removed]',
        '<!--' => '<!--',
        '-->' => '-->'
    );

    foreach ($bad as $key => $val) {
        $str = preg_replace("#" . $key . "#i", $val, $str);
    }

    return $str;
}

function escapeSC($string)
{
    return preg_replace('/[^a-z0-9_@\.]+/i', '', $string);
}

function hasSC($array)
{
    foreach ($array as $string) {
        if (strcmp($string, escapeSC($string)) != 0) {
            return true;
        }
    }
    return false;
}