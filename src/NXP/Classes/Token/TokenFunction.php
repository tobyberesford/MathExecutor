<?php
/**
 * This file is part of the MathExecutor package
 *
 * (c) Alexander Kiryukhin
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace NXP\Classes\Token;

/**
 * @author Alexander Kiryukhin <alexander@symdev.org>
 */
class TokenFunction extends AbstractContainerToken implements InterfaceFunction
{
    /**
     * @return string
     */
    public static function getRegex()
    {
        return '[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*';
    }

    /**
     * @param array $stack
     * @return $this
     */
    public function execute(&$stack)
    {
        $args = array();
        list($places, $function) = $this->value;
        for ($i = 0; $i < $places; $i++) {
            //allow less than reqd num of arguments
        	if (!(empty($stack))) {
            	array_push($args, array_pop($stack)->getValue());
            }
        }
        //put args back in order
        $result = call_user_func_array($function, $args);

        return new TokenNumber($result);
    }
}
