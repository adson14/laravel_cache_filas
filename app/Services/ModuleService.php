<?php

namespace App\Services;

use App\Repositories\CourseRepository;

class ModuleService{

    protected $repository;
    protected $courseRepository;

    public function __construct(ModuleRepository $moduleRepository, CourseRepository $courseRepository){
        $this->courseRepository = $moduleRepository;
    }

    public function getModulesByCourse(string $course)
    {
        $course = $this->courseRepository->getCourseByUuid();
        return  $this->repository->getModuleCourse($course);
    }

   
    public function createModule(array $data){
        return $this->repository->createModule($data);
    }

    public function getModuleByCourse($course, string $identify){
        $course = $this->courseRepository->getCourseByUuid($course);
        return  $this->repository->getModuleByCourse($course->id,$identify);
    }

    public function updateModule(string $identify,array $data){
        return $this->repository->updateModuleByUuid($identify, $data);
    }

    public function deleteModule(string $identify){
        return $this->repository->DeleteModuleByUuid($identify);
    }

}