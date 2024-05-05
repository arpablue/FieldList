<?php

use ArpaBlue\FieldList\FieldList;
use ArpaBlue\FieldList\Test_Case;
use function ArpaBlue\FieldList\write;

class FieldList_Test extends Test_Case
{
    public function testFieldList_addElements(){

        $exp = "{{\"name\":\"name\",\"value\":\"Alan\"},{\"name\":\"lastname\",\"value\":\"Brooks\"},{\"name\":\"email\",\"value\":\"alan.brooks@test.com\"}}";

        $list = new FieldList();

        $list->put("name","Alan");
        $list->put("lastname","Brooks");
        $list->put("email","alan.brooks@test.com");
        $current = $list->toJSON();
        $this->assertEquals($exp,$current,'The json structure are not equals.');
    }

    /**
     * It verify the clone generate has the same data of the original object.
     */
    public function testFieldList_CloneData(){
        $exp = new FieldList();

        $exp->put("name","Alan");
        $exp->put("lastname","Brooks");
        $exp->put("email","alan.brooks@test.com");

        $current = $exp->clone();
        $this->assertTrue( $exp->equals( $current ),'The json structure are not equals.');

    }
}