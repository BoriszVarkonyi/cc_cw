<?php

class objSorter
{
var $property;
var $sorted;

    function ObjSorter($objects_array,$property=null)
        {
            $sample    = $objects_array[0];
            $vars    = get_object_vars($sample);

        if (isset($property))
            {
            if (isset($sample->$property))
// make sure requested property is correct for the object
                {
                $this->property = $property;
                usort($objects_array, array($this,'_compare'));
                }
            else
                {
                $this->sorted    = false;
                return;
                }
            }
        else
            {
                list($property,$var)     = each($sample);
                $this->property         = $property;
                usort($objects_array, array($this,'_compare'));
            }

        $this->sorted    = ($objects_array);
        }

    function _compare($apple, $orange)
        {
        $property    = $this->property;
        if ($apple->$property == $orange->$property) return 0;
        return ($apple->$property < $orange->$property) ? -1 : 1;
        }
} // end class

?>