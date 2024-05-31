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
    public function __construct()
    {
        $this->_Fields = array();
    }
    ////////////////////////// STATIC METHODS ///////////////////////////////

    /**
     * It verify the target parameter is a FieldList class implementation.
     * @param $target any It is the method to verify that is a instance of FieldElement.
     * @return bool It is true the the target object is an instance of FieldElement
     */
    public static function isThisClass($target)
    {
        return ClassTools::isThisClass("FieldElement", $target);
    }

    ////////////////////////// Override method /////////////////////////////

    public function __toString()
    {
        return $this->toJSON();
    }
    ///////////////////////// Local methods //////////////////////////////////

    /**
     * It verify a string is not null or only white string.
     * @param $target string It is the string to be evaluate if is a valid .
     * @return bool It is true then the target is a valid string.
     */
    protected static function isValidName($target)
    {
        if (empty($target)) {
            return false;
        }
        $target = trim($target);
        if (strlen($target) < 1) {
            return false;
        }
        return true;
    }

    /**
     * It return the contain of the list in a JSON format. If the list is empty them return a {} in the fields
     * attribute.
     * @return string It is the element of te list.
     */
    public function toJSON()
    {
        $res = "{";
        $flag = false;
        foreach ($this->_Fields as $key => $field) {
            if ($flag) {
                $res = $res . ",";
            }
            $res = $res . $field->toJSON();
            $flag = true;
        }
        $res = $res . "}";

        return $res;
    }

    /**
     * It set a value to a key in the list, if the key not exists then the element is didn't
     * add to the list.
     * @param $name string It i sthe key used to identify the value.
     * @param $value any It is the value assigned to the key.
     * @return bool It is true if the value has been assigned.
     */
    public function set($name, $value)
    {
        if (!FieldList::isValidName($name)) {
            return false;
        }
        $name = StringTools::setOnFormat($name);

        if (!$this->exists($name)) {
            return false;
        }
        $field = $this->getField($name);
        $field->setValue($value);
        return true;
    }

    /**
     * It set a value to a key in the list, if the key not exists then the element is
     * added to the list.
     * @param $key string It is the key used to identify the value.
     * @param $value any It is the value assigned to the key.
     * @return bool It is true if the value has been added, teh value is false if the value has been assigned
     * and any new element has been created.
     */
    public function put($key, $value)
    {
        if (!FieldList::isValidName($key)) {
            return false;
        }
        if ($this->exists($key)) {
            $this->getField($key)->setValue($value);
            return false;
        }
        $element = new FieldElement($key, $value);
        $this->_Fields[] = $element;
        return true;
    }

    /**
     * It return an array with the names of the values as the key and the values of the fields.
     * @return array It is the arrays of fields.
     */
    public function toArray()
    {
        $res = array();
        foreach ($this->_Fields as $key => $value) {
            $res[$value->getName()] = $value->getValue();
        }
        return $res;
    }

    /**
     * It return the quantity of elements in the list.
     * @return int It is the quntity of elements of the list.
     */
    public function size()
    {
        if ($this->_Fields === null) {
            return 0;
        }
        return count($this->_Fields);
    }

    /**
     * It verify if a key exists in the list.
     * @param $name string It is the key to search in the list.
     * @return bool It is true if the key exists in the list.
     */
    public function exists($name)
    {
        $pos = $this->getIndex($name);
        return $pos >= 0;
    }

    /**
     * It return the index of field with a name if the field not exists then return -1.
     * @param $name string It is the name of the field.
     * @return int It is the position of the field in the list.
     */
    public function getIndex($name)
    {
        if ($name === null) {
            return false;
        }
        $index = -1;
        $name = StringTools::setOnFormat($name);
        foreach ($this->_Fields as $k => $field) {
            $index++;
            if ($field->isThis($name)) {
                return $index;
            }
        }
        return -1;
    }

    /**
     * It return a value using the position of the field int he list, if the field
     * doesn't exist in the position specified then  return null.
     * @param $index int It i sthe posñituçion of the field in the list.
     * @return any It is the value of the field in the position specified.
     */
    public function getValueByIndex($index)
    {
        $field = $this->getFieldByIndex($index);
        if ($field == null) {
            return null;
        }
        return $field->getValue();
    }

    /**
     * It return a field according to a position in the list, if in the position specified by the index not found a
     * field then a null value is returned.
     * @param $index int It is the position of the field in the list.
     * @return mixed|null
     */
    private function getFieldByIndex($index)
    {
        if ($index < 0) {
            return null;
        }
        if ($index >= $this->size()) {
            return null;
        }
        $counter = -1;
        foreach( $this->_Fields as $k => $field){
            $counter++;
            if( $counter == $index){
                return $field;
            }
        }
        return null;
    }

    /**
     * It return the value assigned value to a key, if the key not exist then return the null value.
     * @param $key string It is the key to get the assigned value.
     * @return any It is the key that belong ot the key.
     */
    public function get($name)
    {
        $field = $this->getField($name);
        if ($field == null) {
            return null;
        }
        return $field->getValue();
    }

    /**
     * It return the array of fileds of the list.
     * @return array It is the array if filed used in the list.
     */
    public function getArrayOfFields(){
        return $this->_Fields;
    }
    /**
     * It return the value assigned value to a key, if the key not exist then return the null value.
     * @param $name string It is the key to get the assigned value.
     * @return FieldElement It is the key that belong ot the key.
     */
    public function getField($name)
    {
        if (empty($name)) {
            echo "\nError (FieldList - GetField): The name of the field cannot be null or empty.";
            return null;
        }
        if (!$this->exists($name)) {
            return null;
        }
        foreach ($this->_Fields as $i => $field) {
            if ($field->isThis($name)) {
                return $field;
            }
        }
        return null;
    }

    /**
     * It remove all elements of the list.
     */
    public function removeAll()
    {
        $this->_Fields = array();
    }

    /**
     * It remove a element with the key specified from  the list.
     * @param $key string It is th element to be removed.
     */
    public function remove($name)
    {
        if( $name == null ){ return false; }
        $fields = $this->_Fields;
        foreach( $fields as $k => $field ){
            if( $field->isThis($name) ){
                unset( $this->_Fields[ $k] );
            }
        }
    }
    /**
     * It copy all elements from another list, the list of the current list are removed.
     */
    public function copyAll($fieldList)
    {
        if (!FieldList::isThisClass($fieldList)) {
            return false;
        }
        $this->removeAll();
        $fields = $fieldList->getArrayOfFields();
        foreach ($fields as $key => $field) {
            $this->_Fields[$key] = $field->cloneMe();
        }
        return true;
    }

    /**
     * It copy the values of the fields in the current list form another list, it doesn't add new fields,
     * if a value of the another list return a null value then the current value of that field is not modified.
     * @param $fieldList FieldList It is the where the values will be copied.
     * @return bool It is true then at less one field has een modified.
     */
    public function copy($fieldList)
    {
        if (!FieldList::isThisClass($fieldList)) {
            return false;
        }
        $fields = $this->_Fields;
        $value = null;
        $name = null;
        foreach ($fields as $key => $field) {
            $name = $field->getName();
            $value = $fieldList->get( $name );
            if( $value !== null) {
                $field->setValue( $value );
            }
        }
        return true;
    }
    /**
     * It copy the values of the fields in the current list form another list, if a field from the another list
     * reutrn a null then this value is assigned to the field in the current list.
     * @param $fieldList FieldList It is the where the values will be copied.
     * @return bool It is true then at less one field has een modified.
     */
    public function copyNullToo($fieldList)
    {
        if (!FieldList::isThisClass($fieldList)) {
            return false;
        }
        $fields = $this->_Fields;
        $value = null;
        $name = null;
        foreach ($fields as $key => $field) {
            $name = $field->getName();
            $value = $fieldList->get( $name );
            $field->setValue( $value );
        }
        return true;
    }
    /**
     * It return the keys associated to the fields.
     * @return array It is the the list of names of the current list of fields.
     */
    public function getNames()
    {
        $res = array();
        foreach ($this->_Fields as $k => $field) {
            $res[] = $field->getName();
        }
        return $res;
    }

    /**
     * It return a clone with all data of the current list,
     * the elements are clones too.
     * @return FieldList It is the clone of the current list.
     */
    public function cloneMe()
    {
        $res = new FieldList();
        $res->copyAll($this);
        return $res;
    }

    /**
     * It compare the current list have the same number of fields, the same names and values for each field.
     * @param $list FieldList It is the list to be compared.
     * @return bool It is true if both list have the same fields.
     */
    public function equalTo( $list )
    {
        if (!FieldList::isThisClass( $list )) {
            return false;
        }
        if ($this->size() !== $list->size()) {
            return false;
        }
        $fields = $this->_Fields;
        $f = null;
        foreach ($fields as $key => $field) {
            $target = $list->getField( $field->getName() );
            if( $target == null ){
                return false;
            }
            if( !$field->equalTo( $target ) ){
                return false;
            }
        }
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
    public function compareTo($target)
    {
        if (!FieldList::isThisClass( $target )) {
            return false;
        }
        $fields = $this->_Fields;
        $f = null;
        foreach ($fields as $key => $field) {
            $f = $target->get($field->getName());
            if( $f == null ){ return false;}
            if ( $field->getValue() !== $f ) {
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
    public function fieldsExistIn($target)
    {
        if (!FieldList::isThisClass( $target )) {
            return false;
        }
        $fields = $this->_Fields;
        foreach ($fields as $key => $field) {
            if ( !$target->exists( $field->getKey() ) ) {
                return false;
            }
        }
        return true;
    }
}