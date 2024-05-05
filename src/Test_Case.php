<?php
namespace ArpaBlue\FieldList;

use PHPUnit\Framework\TestCase;

function write( $text ){
    echo($text . "\n");
}

/**
 * Class Test_Case
 * @package ArpaBlue\FieldList
 * It contains the methods to execute the test cases.
 */
class Test_Case extends TestCase
{
    /**
     * It is called before the execution of each test case.
     */
    protected function setUp(): void {
        parent::setUp();
        write("\n====================================");
        write("TEST CASE: ". $this->name() );
        write("--------------- Steps --------------");
    }

    /**
     * It is called after the execution of the test case.
     */
    protected function tearDown(): void {
        parent::tearDown();
        write("====================================");
    }
}
