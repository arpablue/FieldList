<?php
namespace ArpaBlue\FieldList;

class FieldElement
{
    /**
     * @var string It is the name of the filed.
     */
    private $_Name;
    /**
     * @var string|null It is the key to identify the field.
     */
    private $_Key;
    /**
     * @var any It is the value assigned to the current field.
     */
    private $_Value;

    /**
     * FieldElement constructor.
     * It can be assigne the name and the avluefor the new fied.
     * @param null $name string It is the name of the field.
     * @param null $value any It is the value asigned to the field.
     */
    public function __construct($name = null, $value = null ){
        $this->setName($name);
        $this->setValue($value);
    }
    ///////////////////////////// STATIC METHODS //////////////////////////
    ///////////////////////////// OVERRIDE METHODS ////////////////////////
    /**
     * It return the data of the current field in a string using the JSON format.
     * @return string|null It is the data of the current field.
     */
    public function __toString(){
        return $this->toJSON();
    }
    ///////////////////////////// LOCAL METHODS ///////////////////////////
    /**
     * It return the dat of the current object in a JSON format, if the name is empty or null
     * then the method return a null string.
     * @return string|null It is the data of the object in JSON format.
     */
    public function toJSON(){
        $name = $this->getName();
        if( $name == null ){ return null; }
        $res = "{\"" . $name . "\":";
        $value = $this->getValue();
        if( $value === null ){
            $res = $res . "null}";
            return $res;
        }
        if( gettype( $value ) == 'string'){
            $res = $res . "\"" . $value . "\"}";
            return $res;

        }
        $res = $res . $value."}";
        return $res;
    }
    /**
     * It specify the key used to identify the current field. If the key cannot be generated then
     * a null value is assigned as key.
     * @param $text string It is the text used to generate the key.
     * @return bool It is true the key has been generate without problems.
     */
    protected function setKey( $text ){
        if( !StringTools::isValid( $text ) ){
            $this->_Key = null;
            return false;
        }
        $this->_Key = StringTools::setOnFormat( $text );
        return true;
    }
    /**
     * It specify the name of the current field.
     * @param $name string It is the name of the field.
     */
    public function setName( $name ){
        $this->_Name = $name;
        $this->setKey( $name );
    }
    /**
     * It set the value assigned to the current field.
     * @param $value any It is the value assigned to the current field.
     */
    public function setValue( $value ){
        $this->_Value = $value;
    }
    /**
     * It return the name of the field.
     * @return string It is the name of th field.
     */
    public function getName(){ return $this->_Name; }
    /**
     * It return the value assigned to the current field.
     * @return any It is the value assigned to the field.
     */
    public function getValue() { return $this->_Value; }
    /**
     * It return the key that identify to the field. It is updated each time the name of the field change it.
     * @return string|null It is the key of the field.
     */
    public function getKey(){ return $this->_Key; }
    /**
     * It cçverify if the name is the same of the field.
     * @param $fieldName string It is the name of the field.
     * @return bool it is true the fçcurrent field is the same name of the field.
     */
    public function isThis( $fieldName ){

        if( ( $fieldName == null ) && ( $this->getKey() == null )) { return true; }
        if( $fieldName == null) { return false; }
        if( $this->getKey() == null) { return false; }
        return ($this->getKey() == StringTools::setOnFormat( $fieldName ));
    }
    /**
     * It verify the current element is the same than another element, has the same name and the same value.
     * @param $fieldElement FieldElement It is the another element to compare.
     * @return bool It is true then both element are equal.
     */
    public function equalTo($fieldElement ){
        if( !FieldElement::isThisClass( $fieldElement ) ) {
            return false;
        }
        if($this->getKey() !== $fieldElement->getKey() ) {
            return false;
        }
        return ( $this->getValue() === $fieldElement->getvalue() );
    }
    /**
     * It verify the target parameter is a FieldList class implementation.
     * @param $target any It is the method to verify that is a instance of FieldElement.
     * @return bool It is true the the target object is an instance of FieldElement
     */
    public static function isThisClass( $target ){
        return ClassTools::isThisClass("FieldElement", $target);
    }
    /**
     * It verify if bot objects has the same name, the value can be different.
     * @param $fieldElement FieldElement It is the another object to compare the names.
     * @return bool It is true both objects has the same name.
     */
    public function compareTo( $fieldElement )
    {
        if (!FieldElement::isThisClass($fieldElement)) {
            return false;
        }
        return ($this->getKey() === $fieldElement->getKey());
    }
    /**
     * It copy the data of the target element, it replace the current values
     * by the target objects, if the target object is null or is another element
     * then doesn't copy the data and return false.
     * @param $target FieldElement It is the object to copy the data.
     * @return bool It is true if the data has been copied.
     */
    public function copy( $target ){
        if (!FieldElement::isThisClass( $target )) {
            return false;
        }
        $this->_Name = $target->getName();
        $this->_Key = $target->getKey();
        $this->setValue( $target->getValue() );
        return true;
    }
    /**
     * It return a object different to the current object but with the same data
     * of the current object.
     * @return FieldElement It is the clone with the current data.
     */
    public function cloneMe(){
        $res = new FieldElement();
        $res->copy( $this );
        return $res;
    }
}
