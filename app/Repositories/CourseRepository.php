<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository{

    protected $entity;

    public function __construct(Course $course){
        $this->entity = $course;
    }


    public function getAllCourses()
    {
       return $this->entity->get();
    }

    public function getCourseByUuid($identify){
        return $this->entity->where('uuid', $identify)->firstOrFail();
    }

    public function createCourse(array $data){
        return $this->entity->create($data);
    }

    public function  updateCourseByUuid(string $identify, array $data){
        $course = $this->getCourseByUuid($identify);
        return $course->update($data);
    }

    public function deleteCourseByUuid(string $identify){
        $course = $this->getCourseByUuid($identify);
        return $course->delete();
    }
}