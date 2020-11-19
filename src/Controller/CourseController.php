<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Course;

/**
 * @Route("/courses", name="course_")
 */
class CourseController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"}, name="index")
     */
    public function index(): Response{
      $courses = $this->getDoctrine()->getRepository(Course::class)->findAll();
      return $this->json([
        'data' => $courses
      ]);
    }

    /**
     * @Route("/{couseId}", name="show", methods={"GET"})
     */
    public function show($couseId){
      $course = $this->getDoctrine()->getRepository(Course::class)->find($couseId);
      return $this->json([
        'data' => $course
      ]);
    }

    /**
     * @Route("/", name="create", methods={"POST"})
     */
    public function create(Request $request){
      $data = $request->request->all();

      $course = new Course();
      $course->setName($data['name']);
      $course->setDescription($data['description']);
      $course->setSlug($data['slug']);
      $course->setCreateAt(new \DateTime('now', new \DateTimezone('Europe/London')));
      $course->setUpdatedAt(new \DateTime('now', new \DateTimezone('Europe/London')));

      $doctrine = $this->getDoctrine()->getManager();

      $doctrine->persist($course);
      $doctrine->flush();

      return $this->json([
        'data' => 'Curso criado com sucesso.'
      ]);
    }

    /**
     * @Route("/{couseId}", name="update", methods={"PUT", "PATCH"})
     */
    public function update($couseId, Request $request)
    {
      $data = $request->request->all();

      $doctrine = $this->getDoctrine();

      $course = $doctrine->getRepository(Course::class)->find($couseId);
      if($request->request->has('name')){
        $course->setName($data['name']);
      }
      if($request->request->has('description')){
        $course->setDescription($data['description']);
      }
      
      $course->setUpdatedAt(new \DateTime('now', new \DateTimezone('Europe/London')));

      $manager = $doctrine->getManager();

      $manager->flush();

      return $this->json([
        'data' => 'Curso atualizado com sucesso.'
      ]);
      
    }

    /**
     * @Route("/{couseId}", name="delete", methods={"DELETE"})
     */
    public function delete($couseId)
    {

      $doctrine = $this->getDoctrine();

      $course = $doctrine->getRepository(Course::class)->find($couseId);

      $manager = $doctrine->getManager();

      $manager->remove($course);
      $manager->flush();

      return $this->json([
        'data' => 'Curso removido com sucesso.'
      ]);
      
    }
}
