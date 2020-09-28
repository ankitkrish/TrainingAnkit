<?php
namespace TrainingAnkit\Student\Api\Data;

interface AllstudentInterface
{
    const STUDENT_ID     = 'student_id';
    const NAME             = 'name';
    const GENDER             = 'gender';
    const QUALIFICATION     = 'qualification';
    const HOBBY     = 'hobby';
    const CITY     = 'city';
    const COLOR     = 'color';

    public function getId();

    public function getName();

    public function getGender();

    public function getHobby();

    public function getCity();
    public function getColor();

    public function getQualification();

    public function setId($id);

    public function setColor($color);

    public function setName($name);

    public function setGender($gender);

    public function setCity($city);

    public function setHobby($hobby);

    public function setQualification($qualification);
}
