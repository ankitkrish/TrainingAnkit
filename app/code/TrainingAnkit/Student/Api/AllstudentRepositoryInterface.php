<?php
namespace TrainingAnkit\Student\Api;
/**
 * Interface AllstudentRepositoryInterface
 * @package TrainingAnkit\Student\Api
 */
interface AllstudentRepositoryInterface
{

	public function save(\TrainingAnkit\Student\Api\Data\AllstudentInterface $blog);

    /**
     * @param $studentId
     * @return mixed
     */
    public function getById($studentId);

    /**
     * @param Data\AllstudentInterface student
     * @return mixed
     */
    public function delete(\TrainingAnkit\Student\Api\Data\AllstudentInterface $student);

    /**
     * @param $studentId
     * @return mixed
     */
    public function deleteById($studentId);
}
