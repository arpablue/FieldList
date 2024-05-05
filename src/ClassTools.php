<?php


namespace ArpaBlue\FieldList;

/**
 * Class ClassTools
 * @package ArpaBlue\FieldList
 * This class contains the method to manage the methods to process the classes.
 */
class ClassTools
{
    /**
     * @param $className string It is the name of the instance of the class.
     * @param $target any It is the method to verify that is a instance of FieldElement.
     * @return bool It is true the the target object is an instance of FieldElement
     */
    public static function isThisClass( $className, $target ){
        if( $target == null){ return false; }
        if( $className == null ) { return false; }
        if( gettype( $target ) !== 'object' ){ return false; }
        return ( get_class( $target ) !== $className );

    }

}