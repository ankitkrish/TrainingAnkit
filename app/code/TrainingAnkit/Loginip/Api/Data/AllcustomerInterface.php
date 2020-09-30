<?php
namespace TrainingAnkit\Loginip\Api\Data;

interface AllcustomerInterface
{
    const CUSTOMER_ID     = 'customer_id';
    const NAME             = 'name';
    const ADDRESS             = 'address';

    public function getId();

    public function getName();

    public function getAddress();

    public function setId($id);
    
    public function setName($name);

    public function setAddress($address);
}
