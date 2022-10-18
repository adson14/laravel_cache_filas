<?php

namespace App\Services;

use App\Repositories\CourseRepository;

class CourseService{

    protected $repository;

    public function __construct(CourseRepository $courseRepository){
        $this->repository = $courseRepository;
    }

    public function getCourses()
    {
        return $this->repository->getAllCourses();
    }

    public function getCourse(string $identify)
    {
        return $this->repository->getCourseByUuid($identify);
    }

    public function createCourse(array $data){
        return $this->repository->createCourse($data);
    }

    public function updateCourse(string $identify, array $data){
        return $this->repository->updateCourseByUuid($identify,$data);
    }

    public function deleteCourse(string $identify){
        return $this->repository->deleteCourseByUuid($identify);
    }
}