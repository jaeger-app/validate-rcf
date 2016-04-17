<?php
/**
 * Jaeger
 *
 * @copyright	Copyright (c) 2015-2016, mithra62
 * @link		http://jaeger-app.com
 * @version		1.0
 * @filesource 	./Validate/Rules/Rcf/Containers/Exists.php
 */
namespace JaegerApp\Validate\Rules\Rcf\Containers;

use JaegerApp\Remote\Rcf as m62Rcf;
use JaegerApp\Validate\AbstractRule;

/**
 * Jaeger - S3 Bucket Existance Validation Rule
 *
 * Validates that a given bucket name exists in S3
 *
 * @package Validate\Rules\S3\Buckets
 * @author Eric Lamb <eric@mithra62.com>
 */
class Exists extends AbstractRule
{

    /**
     * The Rule shortname
     * 
     * @var string
     */
    protected $name = 'rcf_container_exists';

    /**
     * The error template
     * 
     * @var string
     */
    protected $error_message = 'Your container doesn\'t appear to exist...';

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
            if (empty($params['rcf_username']) || empty($params['rcf_api']) || empty($params['rcf_container'])) {
                return false;
            }
            
            return @m62Rcf::getRemoteClient($params);
        } catch (\Exception $e) {
            return false;
        }
    }
}


$rule = new Exists;
\JaegerApp\Validate::addrule($rule->getName(), array($rule, 'validate'), $rule->getErrorMessage());
