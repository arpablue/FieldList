# FieldList class

It is a component to manage keys and values using uncase sensitivity, identifying each field with unique keys using the name of the field. This helps to get a value no matter if the key is called, capitalized or not. This object allows you to compare with another list. It is possible to use the SET method only to modify an element or the PUT method to modify an element or add this element if it doesn’t exist in the list.

## Install FieldList

To install the library it is possible to execute the following command using composer.

*composer require ArpaBlue\FieldList*

## Initialize an FieldList

To initialize the object is necessary add the reference to the library.

*use **ArpaBlue\FieldList\FieldList**;*

To initialize the FieldList is similar to any other objects.

*$**fieldList** = **new** **FieldList**();*

## Add elements

To add elements to the list is necessary use the PUT method.

*$list = **new** **FieldList**();*

*$list->**put**("name","Alan");*

*$list->**put**("lastname","Brooks");*

*$list->**put**("email","alan.brooks@test.com");*

*$list->**put**("phone","2223336666");*

*$list->**put**("age","21");*

## Modify an element

To modify an element we can use two methods.

### PUT method

The PUT method can modify a value of a value in the list.

*$**list** = **new** **FieldList**();*

*$**list**->**put**("name","Alan");*

*$**list**->**put**("lastname","Brooks");*

*$**list**->**put**("email","alan.brooks@test.com");*

*echo "\nContains: " . $list; // output -> Contains: {{"name":"Alan"},{"lastname":"Brooks"},{"email":"alan.brooks@test.com"}}*

*$**list**->**put**("lastname","Woods");*

*echo "\nContains: " . $**list**; // output -> Contains: {{"name":"Alan"},{"lastname":"Woods"},{"email":"alan.brooks@test.com"}}*

*But if the element doesn’t exist then it is added to the list.*

*$**list**->**put**("phone",2223336666);*

*echo "\nContains: " . $**list**; // output -> Contains: {{"name":"Alan"},{"lastname":"Woods"},{"email":"alan.brooks@test.com"},{"phone":2223336666}}*

### SET method

*The SET method can modify a value of an element in the list, if the element does not exists in the list then it is not added to the list.*

*use **ArpaBlue\FieldList\FieldList**;*

*$**list** = **new FieldList**();*

*$**list**->**put**("name","Alan");*

*$**list**->**put**("lastname","Brooks");*

*$**list**->**put**("email","alan.brooks@test.com");*

*echo "\nContains: " . $**list**; <span style="color:gray">// output -> Contains: {{"name":"Alan"},{"lastname":"Brooks"},{"email":"alan.brooks@test.com"}}</span>*

*$**list**->**set**("lastname","silverman");*

*echo "\nContains: " . $**list**; <span style="color:gray">// output -> Contains: {{"name":"Alan"},{"lastname":"silverman"},{"email":"alan.brooks@test.com"},{"phone":2223336666}}</span>*

*But if the element doesn’t exist in the list then it isn’t added to the list.*

*$**list**->**set**("country","England");*

*echo "\nContains: " . $**list**; <span style="color:gray">// output -> Contains: {{"name":"Alan"},{"lastname":"silverman"},{"email":"alan.brooks@test.com"},{"phone":2223336666}}</span>*

## Class methods

### ToJSON

This method returns the structure of the list as a string with JSON format, this method is used to convert the current list into a string.

*$**list** = **new** **FieldList**();*

*$**list**->**put**("name","Alan");*

*$**list**->**put**("lastname","Brooks");*

*$**list**->**put**("email","alan.brooks@test.com");*

*echo "\nLlist: " . $**list**; <span style="color:gray">// output -> List: {{"name":"Alan"},{"lastname":"Brooks"},{"email":"alan.brooks@test.com"}}</spsan>*

### Remove elements

The class contains 2 methods to remove elements.

#### Remove element

It removes an element specified for the name or key of the field, it is necessary to specify the name or key of the field.

*$list = new **FieldList**();*

*$list->**put**("name","Alan");*

*$list->**put**("lastname","Brooks");*

*$list->**put**("email","alan.brooks@test.com");*

*$list->**put**("phone","3334445555");*

*$list->**put**("age",21);*

*$**list**->**removeAll**();*

*echo "\nList: " . $**list**; <span style="color:gray">// Output -> List: {}</span>*

#### Remove all elements

It removes all elements of the list.

*$**list** = new **FieldList**();*

*$**list**->**put**("name","Alan");*

*$**list**->**put**("lastname","Brooks");*
*$**list**->**put**("email","alan.brooks@test.com");*
*$**list**->**put**("phone","3334445555");*
*$**list**->**put**("age",21);*

*$**list**->**remove**("email");*

*echo "\**nList**: " . $**list**; <span style="color:gray">// Output -> List: {{"name":"Alan"},{"lastname":"Brooks"},{"phone":"3334445555"},{"age":21}}</span>*


### size()

It returns the quantity fields of the current list.

*$**list** = **new** **FieldList**();*

*$**list**->**put**("name","Alan");*

*$**list**->**put**("lastname","Brooks");*

*$**list**->**put**("email","alan.brooks@test.com");*

*$**list**->**put**("phone","3334445555");*

*$**list**->**put**("age",21);*

*echo "\nList length: " . $**list**->**size**(); <span style="color:gray">// output -> List length: 5</span>*


### getNames()

It return an array with the names of all the fields.

*list = **new** **FieldList**();*

*$**list**->**put**("name","Alan"); // position: 0*
*$**list**->**put**("lastname","Brooks"); // position: 1*
*$**list**->**put**("email","alan.brooks@test.com"); // position: 2*
*$**list**->**put**("age",21); // position: 3*
*$**list**->**put**("phone","3332225555"); // position: 4*
*$**list**->**put**("country","Paris"); // position: 5*
*$**list**->**put**("language","French"); // position: 6*

*$**names** = $**list**->**getNames**();*

*print_r( $**names** );*
*/* Ouput:*
*<span style="color:gray">Array*
    *(*
        *[0] => name*
        *[1] => lastname*
        *[2] => email*
        *[3] => age*
        *[4] => phone*
        *[5] => country*
        *[6] => language*
    *)*
**/</span>*

### exists()

It verify if the a field with the name specified exists.

*$**list** = **new FieldList**();*

*$**list**->**put**("name","Alan");*
*$**list**->**put**("lastname","Brooks");*
*$**list**->**put**("email","alan.brooks@test.com");*
*$**list**->**put**("age",21);*
*$**list**->**put**("phone","3332225555");*
*$**list**->**put**("country","Paris");*
*$**list**->**put**("language","French");*

*$**flag** = $**list**->**exists**("age"); <span style="color:gray">// It return true </span>*

*if( $**flag** ){*
	*echo "The field exists!!!";*
*}*

### cloneMe()

It returns another FieldList with the same values of the element of the current list, these are not the same elements.

*$**exp** = **new** **FieldList**();*

*$**exp**->**put**("name","Alan");*

*$**exp**->**put**("lastname","Brooks");*

*$**exp**->**put**("email","alan.brooks@test.com");*

*$current = $**exp**->**cloneMe**();*

*echo "\nClone list: " . $**exp**; <span style="color:gray">// output -> Clone list: {{"name":"Alan"},{"lastname":"Brooks"},{"email":"alan.brooks@test.com"}}</span>*

### copy()

This method copy the values of the fields from another list that exists in the current list, the values that have a null value in the another list are not modified or assigned to the fields of the current list.

*$**list** = **new** **FieldList**();*

*$**list**->**put**("name","Alan");*
*$**list**->**put**("lastname","Brooks");*
*$**list**->**put**("email","alan.brooks@test.com");*
*$**list**->**put**("age",21);*
*$**list**->**put**("phone","3332225555");*
*$**list**->**put**("country","Paris");*
*$**list**->**put**("language","French");*

*$**anotherList** = **new** **FieldList**();*

*$**anotherList**->**put**("lastname","none");*
*$**anotherList**->**put**("email","none");*
*$**anotherList**->**put**("city","Arizona");*

*$**anotherList**->**copy**( $**list** );*

*echo "Current list: " . **$anotherList**; <span style="color:gray">//  Output-> Current list: {{"lastname":"Brooks"},{"email":"alan.brooks@test.com"},{"city":"Arizona"}</span>}*

### copyNullToo()

It copy the values of the fields that exists in the current list and in the another list, this include the null values.

*$**list** = **new** **FieldList**();*

*$**list**->**put**("name","Alan");*
*$**list**->**put**("lastname","Brooks");*
*$**list**->**put**("email","alan.brooks@test.com");*
*$**list**->**put**("age",21);*
*$**list**->**put**("phone","3332225555");*
*$**list**->**put**("country","Paris");*
*$**list**->**put**("language","French");*

*$**anotherList** = **new** **FieldList**();*

*$**anotherList**->**put**("lastname","none");*
*$**anotherList**->**put**("email","none");*
*$**anotherList**->**put**("city","Arizona");*

*$**anotherList**->**copyNullToo**( $**list** );*

*echo "Current list: " . $**anotherList**; <span style="color:gray">// Output-> Current list: {{"lastname":"Brooks"},{"email":"alan.brooks@test.com"},{"city":null}}</span>*

### copyAll()

It removes all attributes of the current list and copies all fields of the target list.

*$**list** = **new** **FieldList**();*

*$**list**->**put**("name","Alan");*

*$**list**->**put**("lastname","Brooks");*

*$**list**->**put**("email","alan.brooks@test.com");*

*$**copyList** = **new** **FieldList**();*

*$**copyList**->**copy**( $list );*

*echo "\nCopy list: " . $**copyList**; <span style="color:gray">// output -> Copy list: {{"name":"Alan"},{"lastname":"Brooks"},{"email":"alan.brooks@test.com"}}</span>*

### compareTo()

It compares the fields of the current list with fields with the same name of the target list; other fields on the target list are discarded. If one field of the current list doesn’t exist in the target list or has a different value then the method returns false.

*$**list** = **new** **FieldList**();*

*$**list**->**put**("name","Alan");*

*$**list**->**put**("lastname","Brooks");*

*$**list**->**put**("email","alan.brooks@test.com");*

*$**list**->**put**("age",21);*

*$**list**->**put**("phone","3332225555");*

*$**anotherList** = new **FieldList**();*

*$**anotherList**->**put**("lastname","Brooks");*

*$**anotherList**->**put**("email","alan.brooks@test.com");*

*if( $**anotherList**->**compareTo**( $**list** ) )<span style="color:gray">{ // expected value is true</span>*

  *echo "\nThe fields exist and the values are the same.";*

*}else{*

  *echo "\nMaybe some fields not exists or the values are different.";*

*}*

### fieldsExistIn()

It verify the if the fields of the current list exist in the target list, the values and other fields are ignored in this process 

*$**list** = **new** **FieldList**();*

*$**list**->**put**("name","Alan");*

*$**list**->**put**("lastname","Brooks");*

*$**list**->**put**("email","alan.brooks@test.com");*

*$**list**->**put**("age",21);*

*$**list**->**put**("phone","3332225555");*

*$**anotherList** = new **FieldList**();*

*$**anotherList**->**put**("lastname","Brooks");*

*$**anotherList**->**put**("email","alan.brooks@test.com");*

*if( $**anotherList**->**fieldsExistIn**( $**list** ) ){ <span style="color:gray">// expected value is true</span>*

  *echo "\nThe fields exists in the list.";*

*}else{*

  *echo "\nMaybe some fields not exists in the list.";*

*}*

### getIndex()

It returns the value from a specific position in the list.

*$**list** = **new** **FieldList**();*

*$**list**->**put**("name","Alan");*

*$**list**->**put**("lastname","Brooks");*

*$**list**->**put**("email","alan.brooks@test.com");*

*$**list**->**put**("age",21);*

*$**list**->**put**("phone","3332225555");*

*for( $i = 0; $i < **$list->size()**; $i++ ){*

  *echo "\n..".$i.") ".**$list->getIndex($i)**; <span style="color:gray">// get the value of a specific index.</span>*

*}*

### getValueByIndex()

It return a value of the list using the position of the field , if a filed doesn't exists in the position specified then return null.

*$**list** = **new** **FieldList**();*

*$**list**->**put**("name","Alan"); <span style="color:gray">// position: 0</span>*
*$**list**->**put**("lastname","Brooks"); <span style="color:gray">// position: 1</span>*
*$**list**->**put**("email","alan.brooks@test.com"); <span style="color:gray">// position: 2</span>*
*$**list**->**put**("age",21); <span style="color:gray">// position: 3</span>*
*$**list**->**put**("phone","3332225555"); <span style="color:gray">// position: 4</span>*
*$**list**->**put**("country","Paris"); <span style="color:gray">// position: 5</span>*
*$**list**->**put**("language","French"); <span style="color:gray">// position: 6</span>*

*$**phone** = $**list**->**getValueByIndex**( 4 );*

*echo "\nPhone number: " . $**phone**; <span style="color:gray">// Output: Phone number: 3332225555</span>*

## License

This project is licensed under the [MIT License](LICENSE).

Last updated: Jun 1, 2024
