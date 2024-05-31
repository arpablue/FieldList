<?php
use ArpaBlue\FieldList\FieldList;
use ArpaBlue\FieldList\Test_Case;
use function ArpaBlue\FieldList\write;
class FieldElement_Neg_Test extends Test_Case
{
    /**
     * It verify that it is possible get a element from a specify field.
     */
    public function testFieldList_get_Element_for_a_element_that_not_exists(){

        $exp = "Brooks";
        $field = "lastname";
        $list = new FieldList();

        $list->put("name","Alan");
        $list->put($field, $exp );
        $list->put("email","alan.brooks@test.com");

        $current = $list->get( "amaru" );

        $flag = null === $current;
        $this->assertTrue( $flag, "It return an element when should return NULL value" );
    }
    /**
     * It verify that it is possible new elements to the list.
     */
    public function testFieldList_addElements(){

        $exp = "{{\"name\":\"Alan\"},{\"lastname\":\"Brooks\"}}";

        $list = new FieldList();

        $list->put("name","Alan");
        $list->put("lastname","Brooks");
        $list->put(null,"value 1");
        $list->put("","value 2");
        $list->put("       ","value 3");

        $current = $list->toJSON();
        $flag = $exp === $current;
        if( !$flag )
        {
            write( "Expected: " . $exp ) ;
            write( "Current: " . $current ) ;
        }
        $this->assertTrue( $flag, 'No valid field names has been added.');
    }

    /**
     * The compare data should be fail if one of the fields has a different value.
     */
    public function testFieldList_compareData(){
        $a = new FieldList();

        $a->put("name","Alan");
        $a->put("lastname","Brooks");
        $a->put("email","alan.brooks@test.com");
        $a->put("sex","male");
        $a->put("phone","2223336666");
        $a->put("age","21");

        $b = new FieldList();

        $b->put("lastname","Brooks");
        $b->put("email","alan.brooks@try.com");
        $b->put("sex","male");

        $flag = $b->compareTo( $a );

        if( $flag ){
            write(" List A: " . $a );
            write( "List B: " . $b );

        }
        $this->assertTrue( !$flag, "The compare method said the list are equals when have different values.");
    }
    /**
     * The compare data should be fail if one of the fields has a different value.
     */
    public function testFieldList_compareData_different_fields(){
        $a = new FieldList();

        $a->put("name","Alan");
        $a->put("lastname","Brooks");
        $a->put("email","alan.brooks@test.com");
        $a->put("sex","male");
        $a->put("phone","2223336666");
        $a->put("age","21");

        $b = new FieldList();

        $b->put("lastname","Brooks");
        $b->put("email2","alan.brooks@try.com");
        $b->put("sex","male");

        $flag = $b->compareTo( $a );

        if( $flag ){
            write(" List A: " . $a );
            write( "List B: " . $b );

        }
        $this->assertTrue( !$flag, "The compare method said the list are equals when have different values.");
    }
    /**
     * It verify the fields of the list B exists in the List A, but the values can be different.
     */
    public function testFieldList_fieldsData_without_a_field(){
        $a = new FieldList();

        $a->put("name","Alan");
        $a->put("lastname","Brooks");
        $a->put("sex","male");
        $a->put("phone","2223336666");
        $a->put("age","21");

        $b = new FieldList();

        $b->put("lastname","Brown");
        $b->put("email","bea.brown@try.com");
        $b->put("sex","female");

        $flag = $b->fieldsExistIn( $a );

        if( $flag ){
            write(" List A: " . $a );
            write( "List B: " . $b );

        }
        $this->assertTrue( !$flag, "The compare method said the list are equals when have different values.");
    }
    /**/

}