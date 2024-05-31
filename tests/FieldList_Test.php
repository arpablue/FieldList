<?php

use ArpaBlue\FieldList\FieldList;
use ArpaBlue\FieldList\Test_Case;
use function ArpaBlue\FieldList\write;

class FieldList_Test extends Test_Case
{

    /**
     * It verify that it is possible get an element from a specify field.
     */
    public function test_FieldList_get_Element(){

        $exp = "Brooks";
        $field = "lastname";
        $list = new FieldList();

        $list->put("name","Alan");
        $list->put($field, $exp );
        $list->put("email","alan.brooks@test.com");
        echo "\n-----------\n";
        $current = $list->get( $field );

        $flag = $exp === $current;
        if( !$flag ){
            echo "\nList: ".$list;
            echo "\nField: ".$field;
            echo "\n...Exp: ".$exp;
            echo "\n...Cur: ".$current."\n";
        }
        $this->assertTrue( $flag, "the get field are not returning the correct value." );
        //$this->assertEquals($exp,$current,'The current for ' . $field . ' field is ' . $current );
    }

    /**
     * It verify that it is possible new elements to the list.
     */
    public function test_FieldList_addElements(){

        $exp = "{{\"name\":\"Alan\"},{\"lastname\":\"Brooks\"},{\"email\":\"alan.brooks@test.com\"}}";

        $list = new FieldList();

        $list->put("name","Alan");
        $list->put("lastname","Brooks");
        $list->put("email","alan.brooks@test.com");
        $current = $list->toJSON();

        $this->assertEquals($exp,$current,'The json structure are not equals.');
    }

    /**
     * It verify the PUT method can modify the value of a field that exists in the list and it not add a new element.
     */
    public function test_FieldList_PUT_modify_a_value(){
        $exp = "{{\"name\":\"Alan\"},{\"lastname\":\"Woods\"},{\"email\":\"alan.brooks@test.com\"}}";

        $list = new FieldList();

        $list->put("name","Alan");
        $list->put("lastname","Brooks");
        $list->put("email","alan.brooks@test.com");

        $list->put("lastname","Woods");

        $current = $list->toJSON();
        $flag = $exp === $current;
        if( !$flag ){
            write("Exp: " . $exp );
            write("Cur: " . $current );
        }
        $this->assertTrue( $flag, "The PUT method doesn't modify the specified field." );
    }

    /**
     * It use the SET method to modify a field in the list and it is not possible add a new element.
     */
    public function test_FieldList_SET_modify_a_value(){
        $exp = "{{\"name\":\"Alan\"},{\"lastname\":\"Woods\"},{\"email\":\"alan.brooks@test.com\"}}";

        $list = new FieldList();

        $list->put("name","Alan");
        $list->put("lastname","Brooks");
        $list->put("email","alan.brooks@test.com");

        $list->put("lastname","Woods");

        $current = $list->toJSON();
        $flag = $exp === $current;
        if( !$flag ){
            write("Exp: " . $exp );
            write("Cur: " . $current );
        }
        $this->assertTrue( $flag, "The SET method doesn't modify the specified field." );
    }

    /**
     * It verify the SET method not add a new element when a field not exist in the list.
     */
    public function test_FieldList_SET_it_is_not_possible_add_a_new_element(){
        $exp = "{{\"name\":\"Alan\"},{\"lastname\":\"Brooks\"},{\"email\":\"alan.brooks@test.com\"}}";

        $list = new FieldList();

        $list->put("name","Alan");
        $list->put("lastname","Brooks");
        $list->put("email","alan.brooks@test.com");

        $list->set("sex","Male");

        $current = $list->toJSON();
        $flag = $exp === $current;
        if( !$flag ){
            write("Exp: " . $exp );
            write("Cur: " . $current );
        }
        $this->assertTrue( $flag, "The SET add a new element to the list, when it should not add a new element." );
    }
    /**
     * It verify the clone generate has the same data of the original object.
     */
    public function test_FieldList_CloneData(){
        $exp = new FieldList();

        $exp->put("name","Alan");
        $exp->put("lastname","Brooks");
        $exp->put("email","alan.brooks@test.com");

        $current = $exp->cloneMe();
        $this->assertTrue( $exp->equalTo( $current ),'The json structure are not equals.');

    }
    /**
     * It verify the clone generate has the same data of the original object.
     */
    public function test_FieldList_CopyData(){
        $exp = new FieldList();

        $exp->put("name","Alan");
        $exp->put("lastname","Brooks");
        $exp->put("email","alan.brooks@test.com");

        $current = new FieldList();
        $current->copyAll( $exp );
        $this->assertTrue( $exp->equalTo( $current ),'The json structure are not equals.');
    }
    /**
     * It verify the clone generate has the same data of the original object.
     */
    public function test_FieldList_CopyAllData(){
        $exp = new FieldList();

        $exp->put("name","Alan");
        $exp->put("lastname","Brooks");
        $exp->put("email","alan.brooks@test.com");

        $current = new FieldList();
        $current->copyAll( $exp );
        $this->assertTrue( $exp->equalTo( $current ),'The json structure are not equals.');
    }

    /**
     * It verify the fields of the list B exists and they have the same values in the List A.
     */
    public function test_FieldList_compareData(){
        $a = new FieldList();

        $a->put("name","Alan");
        $a->put("lastname","Brooks");
        $a->put("email","alan.brooks@test.com");
        $a->put("sex","male");
        $a->put("phone","2223336666");
        $a->put("age","21");

        $b = new FieldList();

        $b->put("lastname","Brooks");
        $b->put("email","alan.brooks@test.com");
        $b->put("sex","male");

        $flag = $b->compareTo( $a );

        if( !$flag ){
            write(" List A: " . $a );
            write( "List B: " . $b );

        }
        $this->assertTrue( $flag, "The fields of the List B are don't exist or are not equals in the List A, when they hould be equal.");
    }
    /**
     * It verify the fields of the list B exists in the List A, but the values can be different.
     */
    public function test_FieldList_fieldsData(){
        $a = new FieldList();

        $a->put("name","Alan");
        $a->put("lastname","Brooks");
        $a->put("email","alan.brooks@test.com");
        $a->put("sex","male");
        $a->put("phone","2223336666");
        $a->put("age","21");

        $b = new FieldList();

        $b->put("lastname","Brown");
        $b->put("email","bea.brown@try.com");
        $b->put("sex","female");

        $flag = $b->fieldsExistIn( $a );

        if( !$flag ){
            write(" List A: " . $a );
            write( "List B: " . $b );

        }
        $this->assertTrue( $flag, "The fields of the List B are don't exist in the List A, when they should be exist.");
    }
    /**
     * I verify the methods removeAll() remove all elements from the list.
     */
    public function test_FindList_It_is_possible_remove_all_elements(){
        $exp = "{{\"name\":\"Alan\"},{\"lastname\":\"Brooks\"},{\"email\":\"alan.brooks@test.com\"},{\"phone\":\"3334445555\"},{\"age\":21}}";

        $list = new FieldList();

        $list->put("name","Alan");
        $list->put("lastname","Brooks");
        $list->put("email","alan.brooks@test.com");
        $list->put("phone","3334445555");
        $list->put("age",21);

        $cur = $list->toJSON();
        $flag = $exp === $cur;
        if( !$flag ){
            write("Exp: " . $exp );
            write("Cur: " . $cur );
            write("FAIL: the current contain of the list is not the expected." );
        }
        $this->assertTrue( $flag,'The current contain of the list is not the expected.the current contain of the list is not the expected.');

        $list->removeAll();
        $cur = $list->toJSON();
        $flag = $cur === "{}";
        if( !$flag ){
            write("Exp: {}");
            write("Cur: " . $cur );
            write("FAIL: Not all elements has been removed." );
        }


    }
    /**
     * I verify the remove() method can remove the elements specified from the list.
     */
    public function test_FindList_It_is_possible_remove_elements(){
        $exp = "{{\"name\":\"Alan\"},{\"lastname\":\"Brooks\"},{\"email\":\"alan.brooks@test.com\"},{\"phone\":\"3334445555\"},{\"age\":21}}";

        $list = new FieldList();

        $list->put("name","Alan");
        $list->put("lastname","Brooks");
        $list->put("email","alan.brooks@test.com");
        $list->put("phone","3334445555");
        $list->put("age",21);

        $oList = $list->cloneMe();
        $cur = $list->toJSON();
        $flag = $exp === $cur;
        if( !$flag ){
            write("Exp: " . $exp );
            write("Cur: " . $cur );
            write("FAIL: The current contain of the list is not the expected." );
        }
        $this->assertTrue( $flag,'The current contain of the list is not the expected.the current contain of the list is not the expected.');

        $list->remove("lastname");
        $list->remove("phone");
        $cur = $list->toJSON();
        $exp = "{{\"name\":\"Alan\"},{\"email\":\"alan.brooks@test.com\"},{\"age\":21}}";
        $flag = $cur === $exp;
        if( !$flag ){
            write("List: " . $oList );
            write("Exp: " . $exp );
            write("Cur: " . $cur );
            write("FAIL: Not all elements has been removed." );
        }
    }
    /**
     * I verify the remove() method can remove the elements specified from the list.
     */
    public function test_FindList_It_is_possible_remove_elements_with_differents_name(){
        $exp = "{{\"name\":\"Alan\"},{\"lastname\":\"Brooks\"},{\"email\":\"alan.brooks@test.com\"},{\"phone\":\"3334445555\"},{\"age\":21}}";

        $list = new FieldList();

        $list->put("name","Alan");
        $list->put("lastname","Brooks");
        $list->put("email","alan.brooks@test.com");
        $list->put("phone","3334445555");
        $list->put("age",21);

        $cur = $list->toJSON();
        $flag = $exp === $cur;
        if( !$flag ){
            write("Exp: " . $exp );
            write("Cur: " . $cur );
            write("FAIL: the current contain of the list is not the expected." );
        }
        $this->assertTrue( $flag,'The current contain of the list is not the expected.the current contain of the list is not the expected.');

        $list->remove(" LastName");
        $list->remove("  PHONE  ");
        $cur = $list->toJSON();
        $exp = "{{\"name\":\"Alan\"},{\"email\":\"alan.brooks@test.com\"},{\"age\":21}}";
        $flag = $cur === $exp;
        if( !$flag ){
            write("Exp: " . $exp );
            write("Cur: " . $cur );
            write("FAIL: Not all elements has been removed." );
        }
    }

    /**
     * It verify that is posñsible copy the values from another lilst event hte null values.
     */
    public function test_FindElement_It_verify_that_is_possible_copy_values_including_the_null_values(){
        $exp = "{{\"lastname\":\"Brooks\"},{\"email\":\"alan.brooks@test.com\"},{\"city\":null}}";

        $list = new FieldList();

        $list->put("name","Alan");
        $list->put("lastname","Brooks");
        $list->put("email","alan.brooks@test.com");
        $list->put("age",21);
        $list->put("phone","3332225555");
        $list->put("country","Paris");
        $list->put("language","French");

        $anotherList = new FieldList();

        $anotherList->put("lastname","none");
        $anotherList->put("email","none");
        $anotherList->put("city","Arizona");

        $anotherList->copyNullToo( $list );
        $cur = $anotherList->toJSON();

        $flag = $exp === $cur;
        if( !$flag ){
            write( "The values copied are not the expected.");
            write("Exp: " . $exp );
            write("Cur: " . $cur );
        }
        $this->assertTrue( $flag, "The values copied are not the expected." );
    }

    /**
     * It verify the values are copied from another list, the empty value are not took, any null value in the another
     * list not modified of the current list.
     */
    public function test_FindElement_It_verify_that_is_possible_copy_values(){
        $exp = "{{\"lastname\":\"Brooks\"},{\"email\":\"alan.brooks@test.com\"},{\"city\":\"Arizona\"}}";

        $list = new FieldList();

        $list->put("name","Alan");
        $list->put("lastname","Brooks");
        $list->put("email","alan.brooks@test.com");
        $list->put("age",21);
        $list->put("phone","3332225555");
        $list->put("country","Paris");
        $list->put("language","French");

        $anotherList = new FieldList();

        $anotherList->put("lastname","none");
        $anotherList->put("email","none");
        $anotherList->put("city","Arizona");

        $anotherList->copy( $list );
        $cur = $anotherList->toJSON();

        $flag = $exp === $cur;
        if( !$flag ){
            write( "The values copied are not the expected.");
            write("Exp: " . $exp );
            write("Cur: " . $cur );
        }
        $this->assertTrue( $flag, "The values copied are not the expected." );
    }

    /**
     * It verify that it is possible remove all elements from the list.
     */
    public function test_FieldList_It_is_possible_remove_all_elements(){
        $exp = "{}";

        $list = new FieldList();

        $list->put("name","Alan");
        $list->put("lastname","Brooks");
        $list->put("email","alan.brooks@test.com");
        $list->put("age",21);
        $list->put("phone","3332225555");
        $list->put("country","Paris");
        $list->put("language","French");

        $list->removeAll();

        $cur = $list->toJSON();

        $flag = $exp === $cur;
        if( !$flag ){
            write("Not all elements has been removed.");
            write("Exp: ");
            write("Cur: ");
        }
        $this->assertTrue( $flag, "Not all elements has been removed." );
    }

    /**
     * It verify the toArray() method return an array with the values of the fields and the names of the fields as the
     * keys.
     */
    public function test_FieldList_It_is_possible_get_an_array_of_the_list_of_elements(){
        $exp = "{\"name\":\"Alan\",\"lastname\":\"Brooks\",\"email\":\"alan.brooks@test.com\",\"age\":21,\"phone\":\"3332225555\",\"country\":\"Paris\",\"language\":\"French\"}";

        $list = new FieldList();

        $list->put("name","Alan");
        $list->put("lastname","Brooks");
        $list->put("email","alan.brooks@test.com");
        $list->put("age",21);
        $list->put("phone","3332225555");
        $list->put("country","Paris");
        $list->put("language","French");

        $arrayList = $list->toArray();

        $cur = json_encode( $arrayList );

        $flag = $cur === $exp;
        if( !$flag ){
            write("ERROR: The array returned by the toArray() is not the same than expected.");
            write("Exp: ".$exp);
            write("Cur: ".$cur);
        }
        $this->assertTrue( $flag ,"The toArray() method not return the expected result.");
    }

    /**
     * It verify that it is possible get a value using a position of the list.
     */
    public function test_FieldList_It_is_possible_get_an_value_using_a_position_in_the_list()
    {
        $exp = "3332225555";
        $list = new FieldList();

        $list->put("name","Alan"); // position: 0
        $list->put("lastname","Brooks"); // position: 1
        $list->put("email","alan.brooks@test.com"); // position: 2
        $list->put("age",21); // position: 3
        $list->put("phone",$exp); // position: 4
        $list->put("country","Paris"); // position: 5
        $list->put("language","French"); // position: 6

        $cur = $list->getValueByIndex( 4 );

        $flag = $exp === $cur;

        if( !$flag )
        {
            write("The expected pthone number is different to the current phone number.");
            write("Exp: " .$exp );
            write("Cur: ".$cur );

        }
        $this->assertTrue( $flag, "The getValueByIndex() method does not return the expected phone number [".$exp."], current phone number is [".$cur."]");
    }

    /**
     * It verify that both list are equals with the smae number of fields, fields and values.
     */
    public function test_FieldList_Is_possible_verify_that_two_list_are_equals()
    {
        $list = new FieldList();

        $list->put("name","Alan");
        $list->put("lastname","Brooks");
        $list->put("email","alan.brooks@test.com");
        $list->put("age",21);
        $list->put("phone","3332225555");
        $list->put("country","Paris");
        $list->put("language","French");

        $list2 = new FieldList();

        $list2->put("name","Alan");
        $list2->put("lastname","Brooks");
        $list2->put("email","alan.brooks@test.com");
        $list2->put("age",21);
        $list2->put("phone","3332225555");
        $list2->put("country","Paris");
        $list2->put("language","French");

        $flag = $list2->equalTo( $list );
        if( !$flag )
        {
            writen("FAIL: The list are different when should be equals." );
            write("List A: ".$list);
            write("List B: ".$list2);
        }
        $this->assertTrue( $flag, "The list are different when should be equals." );

    }

    /**
     * It is possible compare 2 list, the fields of the second list exists with the same values in the
     * first list.
     */
    public function test_FieldList_Verify_that_is_possible_compare_two_fields()
    {
        $list = new FieldList();

        $list->put("name","Alan");
        $list->put("lastname","Brooks");
        $list->put("email","alan.brooks@test.com");
        $list->put("age",21);
        $list->put("phone","3332225555");
        $list->put("country","Paris");
        $list->put("language","French");

        $list2 = new FieldList();

        $list2->put("name","Alan");
        $list2->put("lastname","Brooks");
        $list2->put("email","alan.brooks@test.com");

        $flag = $list2->compareTo( $list );
        if( !$flag )
        {
            writen("FAIL: The list are different when should be equals." );
            write("List A: ".$list);
            write("List B: ".$list2);
        }
        $this->assertTrue( $flag, "The list are different when should be equals." );
    }
    public function test_FieldList_It_is_possible_get_the_names_of_the_fields()
    {
        $exp = "[\"name\",\"lastname\",\"email\",\"age\",\"phone\",\"country\",\"language\"]";
        $list = new FieldList();

        $list->put("name","Alan");
        $list->put("lastname","Brooks");
        $list->put("email","alan.brooks@test.com");
        $list->put("age",21);
        $list->put("phone","3332225555");
        $list->put("country","Paris");
        $list->put("language","French");

        $fields = $list->getNames();

        $cur = json_encode( $fields );
        $flag = $exp == $cur;
        if( !$flag ){
            write("FAIL: The current array is not equals to the expected.");
            write("Exp: " .$exp);
            write("Cur: ".$cur);
        }
        $this->assertTrue( $flag, "The current array is not equals to the expected.");

    }
    /**/
}
