<?php
use ArpaBlue\FieldList\Test_Case;
use ArpaBlue\FieldList\FieldElement;
use function ArpaBlue\FieldList\write;

class FieldElement_Test extends Test_Case
{
    /**
     * It verify the basic methods return the correct values.
     */
    public function test_FieldElement_verify_the_basic_methods(){
        $value = "Brooks";
        $name = "LastName";
        $key = "lastname";
        $json = "{\"LastName\":\"Brooks\"}";
        $target = new FieldElement($name,$value);

        $this->assertEquals( $name, $target->getName());
        $this->assertEquals( $value, $target->getValue());
        $this->assertEquals( $key, $target->getKey());
        $this->assertEquals( $json, $target->toJSON());

    }
    /**
     * It verify the JSON structure of the FieldElement is the correct for a int value.
     */
    public function test_FindElement_to_Json_for_int_value(){
        $target = new FieldElement();
        $target->setName('test' );
        $target->setValue( 14 );
        $exp = "{\"test\":14}";
        $current = $target->toJSON();
        $this->assertEquals( $exp, $current, "The JSON structures are not equals.");
    }

    /**
     * It verify the clone method ( cloneMe() ) is working correctly.
     */
    public function test_FindElement_CloneMe_should_be_create_a_new_object_with_the_same_data(){
        $exp = new FieldElement();
        $exp->setName('test' );
        $exp->setValue( 14 );

        $cur = $exp->cloneMe();

        $flag = $exp->equalTo( $cur );
        if( !$flag ){
            write( "exp: " . $exp );
            write( "cur: " . $cur );
        }
        $this->assertTrue( $flag, "The clone doesn't have the same data that of the original.");

    }
    /**
     * It verify the copy method ( copy() ) is working correctly.
     */
    public function test_FindElement_Copy_should_be_create_a_new_object_with_the_same_data(){
        $exp = new FieldElement();
        $exp->setName('test' );
        $exp->setValue( 14 );

        $cur = new FieldElement();
        $cur->copy( $exp );

        $flag = $exp->equalTo( $cur );
        if( !$flag ){
            write( "exp: " . $exp );
            write( "cur: " . $cur );
        }
        $this->assertTrue( $flag, "The copy doesn't have the same data that of the original.");

    }
    /**/
}