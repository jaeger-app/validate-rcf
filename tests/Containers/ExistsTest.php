<?php
/**
 * Jaeger
 *
 * @copyright	Copyright (c) 2015-2016, mithra62
 * @link		http://jaeger-app.com
 * @version		1.0
 * @filesource 	./tests/Buckets/ReadableTest.php
 */
namespace JaegerApp\tests\Buckets;

use JaegerApp\Validate;
use JaegerApp\Validate\Rules\Rcf\Containers\Exists;

/**
 * Jaeger - Valiate object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Valiate object
 *
 * @package Jaeger\Tests
 * @author Eric Lamb <eric@mithra62.com>
 */
class ExistsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Tests the name of the rule
     */
    public function testName()
    {
        $dir = new Exists();
        $this->assertEquals($dir->getName(), 'rcf_container_exists');
    }

    /**
     * Tests that a file can be determined false
     */
    public function testRuleFail()
    {
        $val = new Validate();
        $creds = $this->getRcfCreds();
        $creds['rcf_container'] = 'ffdsafdsafdsafd';
        $val->rule('rcf_container_exists', 'connection_field', $creds)->val(array(
            'connection_field' => __FILE__
        ));
        $this->assertTrue($val->hasErrors());
    }

    /**
     * Tests that a directory can be determined true
     */
    public function testRuleSuccess()
    {
        $val = new Validate();
        $val->rule('rcf_container_exists', 'connection_field', $this->getRcfCreds())
            ->val(array(
            'connection_field' => 'Foo'
        ));
        $this->assertFALSE($val->hasErrors());
    }
    
    /**
     * The Google Cloud Storage Test Credentials
     */
    protected function getRcfCreds()
    {
        return include __DIR__. '/../data/rcfcreds.config.php';
    }
}