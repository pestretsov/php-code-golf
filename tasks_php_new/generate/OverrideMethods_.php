<?php

class Base
{
    public function getName()
    {
        return "Base";
    }

    public function getParentClass()
    {
        return null;
    }
}

class Child extends Base
{
    public function getName()
    {
        return parent::getName(); // TODO: Change the autogenerated stub
    }

    public function getParentClass()
    {
        return parent::getParentClass(); // TODO: Change the autogenerated stub
    }

}