<?php


namespace ArpaBlue\FieldList;


/**
 * Class FieldList
 * @package ArpaBlue\FFTest\Collections\fieldlist
 * It is an object to manage parameters, no mater the white spaces of if the name is capitalyzed
 */
class FieldList
{
    private $_Fields;

    /**
     * FieldList constructor.
     */
    public function __construct(){
        $this->_Fields = array();
    }
    ////////////////////////// STATIC METHODS ///////////////////////////////
    /**
     * It verify the target parameter is a FieldList class implementation.
     * @param $target any It is the method to verify that is a instance of FieldElement.
     * @return bool It is true the the target object is an instance of FieldElement
     */
    public static function isThisClass( $target ){
        return ClassTools::isThisClass("FieldElement", $target);
    }

    ////////////////////////// Override method /////////////////////////////

    public function __toString()
    {
        return $this->toJSON();
    }
    ///////////////////////// Local methods //////////////////////////////////
    /**
     * It return the contain of the list in a JSON format. If the list is empty them return a {} in the fields
     * attribute.
     * @return string It is the element of te list.
     */
    public function toJSON(){
        $res = "{";
        $flag = false;
        foreach ($this->_Fields as $key => $field) {
            if( $flag ){
                $res = $res . "," ;
            }
            $res = $res . $field->toJSON() ;
            $flag = true;
        }
        $res = $res . "}";
        return $res;
    }
    public function getArrayOfFields(){
        return $this->_Fields;
    }
    /**
     * It set a value to a key in the list, if the key not exists then the element is didn't
     * add to the list.
     * @param $key string It i sthe key used to identify the value.
     * @param $value any It is the value assigned to the key.
     * @return bool It is true if the value has been assigned.
     */
    public function set( $key, $value ){
        if( empty( $key ) ){ return false; }
        $key = StringTools::setOnFormat( $key );
        if( !$this->exists( $key ) ){ return false; }
        $this->_Fields[ $key ]->setValue( $value );
        return true;
    }

    /**
     * It return an array with the names of the values as the key and the values of the fields.
     * @return array It is the arrays of fields.
     */
    public function toArray(){
        $res = array();
        foreach( $this->_Fields as $key => $value )
        {
            $res[ $value->getName() ] = $value->getValue();
        }
        return $res;
    }
    /**
     * It set a value to a key in the list, if the key not exists then the element is
     * added to the list.
     * @param $key string It is the key used to identify the value.
     * @param $value any It is the value assigned to the key.
     * @return bool It is true if the value has been added, teh value is false if the value has been assigned
     * and any new element has been created.
     */
    public function put( $key, $value ){
        if( empty( $key ) ){ return; }
        if( $this->exists( $key ) ){
            $key = StringTools::setOnFormat( $key );
            $this->_Fields[ $key->getKey() ] = $value;
            return false;
        }
        $element = new FieldElement( $key, $value );
        $this->_Fields[ $element->getKey() ] = $element;
        return true;
    }

    /**
     * It return the quantity of elements in the list.
     * @return int It is the quntity of elements of the list.
     */
    public function size(){
        return count( $this->_Fields);
    }

    /**
     * It verify if a key exists in the list.
     * @param $key string It is the key to search in the list.
     * @return bool It is true if the key exists in the list.
     */
    public function exists( $key ){
        if( $key === null){ return false; }
        $key = StringTools::setOnFormat( $key );
        return in_array( $key, $this->_Fields );
    }

    /**
     * It return the value assigned value to a key, if the key not exist then return the null value.
     * @param $key string It is the key to get the assigned value.
     * @return any It is the key that belong ot the key.
     */
    public function get( $key ){
        if( empty( $key ) ){ return null; }
        if( !$this->exists( $key ) ){
            return null;
        }
        return $this->_Fields[ $key ]->getValue();
    }

    /**
     * It remove all elements of the list.
     */
    public function removeAll(){
        $this->_Fields = Array();
    }

    /**
     * It remove a element with the key specified from  the list.
     * @param $key string It is th element to be removed.
     */
    public function remove( $key ){
        if( $key === null ){ return; }
        if( !$this->exists( $key ) ){ return; }
        unset( $this->_Fields[ $key ] );
    }
    /**
     * It copy all elements from another list, the list of the current list are removed.
     */
    public function copy( $fieldList ){
        if( !FieldList::isThisClass( $fieldList )){
            return false;
        }
        $this->removeAll();
        $fields = $fieldList->getArrayOfFields();
        foreach( $fields as $key => $value ){
            $this->_Fields[ $key ] = $value->clone();
        }
        return true;
    }

    /**
     * It return a clone with all data of the current list,
     * the elements are clones too.
     * @return FieldList It is the clone of the current list.
     */
    public function cloneMe(){
        $res = new FieldList();
        $res->copy( $this );
        return res;
    }

    /**
     * It compare the current list have the same number of fields, the same names and values for each field.
     * @param $target FieldList It is the list to be compared.
     * @return bool It is true if both list have the same fields.
     */
    public function equals( $target ){
        if( !FieldList::isThisClass( $target ) ){
            echo "\nFalse ---> 1";
            return false;
        }
        if( $this->size() !== $target->size() ){ return false; }
        $fields = $this->_Fields;
        $f = null;
        foreach( $fields as $key => $field ){
            echo "\n ---> " . $key;
            echo "\n         -> " . $field->getValue();
            echo "\n         -> " . $target->get( $key );

            if( $field->getValue() !== $target->get( $key ) ){
                echo "\nFalse ---> 2";
                return false;
            }
        }
        echo "\nTrue ---> 3";
        return true;
    }

    /**
     * It compare the fields of the current object with the fields in the target objects,
     * it verified the fields exist and the value are the same, if the target have more fields
     * then these are not used in the comparison process.
     * @param $target FieldsList It is the list to compare the current list.
     * @return bool it is blue then the fields of the current list exist and they are the same than
     * the target list.
     */
    public function compare( $target ){
        if( !FieldList::isThisClass( $target ) ){
            return false;
        }
        $fields = $this->_Fields;
        $f = null;
        foreach( $fields as $key => $field ){
            $f = $target->get( $key );
            if( $field->getValue() !== $f->getValue() ){
                return false;
            }
        }
        return true;
    }

    /**
     * It verify the fields of the current list exists in the target list, the values
     * are not evaluated.
     * @param $target FieldList It is the list to verify the fields exist in this list.
     * @return bool It is true all fields in the current list exist  in the target list.
     */
    public function fieldsExistIn( $target ){
        if( !FieldList::isThisClass( $target ) ){
            return false;
        }
        $fields = $this->_Fields;
        foreach( $fields as $key => $field ){
            if( $field->exists( $field ) ){
                return false;
            }
        }
        return true;
    }
}