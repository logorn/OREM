<?php

namespace Rizeway\OREM\Mapping\Field;

class MappingFieldDefault extends MappingField implements MappingFieldInterface
{
    /**
     * @param mixed $value
     * @return mixed
     */
    public function serializeField($value)
    {
        return $value;
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    public function unserializeField($value)
    {
        return $value;
    }
}
