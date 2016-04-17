<?php
/**
 * Jaeger
 *
 * @copyright	Copyright (c) 2015-2016, mithra62
 * @link		http://jaeger-app.com
 * @version		1.0
 * @filesource 	./Validate/Rules/Rcf/Connect.php
 */
namespace JaegerApp\Validate\Rules\Rcf;

use JaegerApp\Remote\Rcf as m62Rcf;
use JaegerApp\Validate\AbstractRule;

/**
 * Jaeger - Directory Validation Rule
 *
 * Validates that a given input is a directory
 *
 * @package Validate\Rules\Rcf
 * @author Eric Lamb <eric@mithra62.com>
 */
class Connect extends AbstractRule
{

    /**
     * The Rule shortname
     * 
     * @var string
     */
    protected $name = 'rcf_connect';

    /**
     * The error template
     * 
     * @var string
     */
    protected $error_message = 'Can\'t connect to {field}';

    /**
     * (non-PHPdoc)
     * 
     * @ignore
     *
     * @see \mithra62\Validate\RuleInterface::validate()
     */
    public function validate($field, $input, array $params = array())
    {
        try {
            if ($input == '' || empty($params['0'])) {
                return false;
            }
            $params = $params['0'];
            if (empty($params['rcf_username']) || empty($params['rcf_api'])) {
                return false;
            }
            
            return m62Rcf::getRemoteClient($params, false);
        } catch (\Exception $e) {
            return false;
        }
    }
}


$rule = new Connect;
\JaegerApp\Validate::addrule($rule->getName(), array($rule, 'validate'), $rule->getErrorMessage());
