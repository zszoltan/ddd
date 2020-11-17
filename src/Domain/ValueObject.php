<?php



abstract class ValueObject
{
    public function equals(ValueObject $object)
    {
        if ($object == $this) {
            return true;
        }
        if (get_class($object) != get_class($this)) {
            return false;
        }
        $vars = get_object_vars($this);
        foreach ($vars as $v) {
            if (!property_exists($object, $v))
                return FALSE;
            if (is_object($this->{$v})) {
                if ($this->{$v} instanceof ValueObject) {
                    if (!$this->{$v}->equals($object->{$v})) {
                        return FALSE;
                    }
                }
            }
            if ($object->{$v} !== $this->{$v})
                return FALSE;
        }
        return TRUE;
    }
}
