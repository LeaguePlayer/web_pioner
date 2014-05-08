<?php
/**
 * Created by JetBrains PhpStorm.
 * User: megakuzmitch
 * Date: 07.05.14
 * Time: 16:54
 */

mb_internal_encoding("UTF-8");

/**
 * @param $text
 * @return string
 */
function mb_ucfirst($text) {
	return mb_strtoupper(mb_substr($text, 0, 1)) . mb_substr($text, 1);
}