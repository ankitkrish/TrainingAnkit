<?php
namespace TrainingAnkit\Loginip\Api;

interface AllcustomerRepositoryInterface
{

    public function save(\TrainingAnkit\Loginip\Api\Data\AllcustomerInterface $loginip);

    /**
     * @param $customerId
     * @return mixed
     */
    public function getById($customerId);

    /**
     * @param Data\AllcustomerInterface customer
     * @return mixed
     */
    public function delete(\TrainingAnkit\Loginip\Api\Data\AllcustomerInterface $customer);

    /**
     * @param $customerId
     * @return mixed
     */
    public function deleteById($customerId);
}
