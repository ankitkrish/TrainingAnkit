<?php
namespace TrainingAnkit\Student\Api\Data;

/**
 * Interface AllstudentInterface
 * @package TrainingAnkit\Student\Api\Data
 */
interface AllstudentInterface
{
    const STUDENT_ID 	= 'student_id';
    const NAME 			= 'name';
    const GENDER 			= 'gender';
    const QUALIFICATION 	= 'qualification';

    
	public function getId();

	public function getName();

    public function getGender();

    public function getQualification();

    public function setId($id);
	
	public function setName($name);

    public function setGender($gender);

    public function setQualification($qualification);


}
