<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/base",name="base.")
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * @Route("/user/{name}",name="user")
     * @return Response
     */
    public function user(Request $request,$name){
        
        $form=$this->createFormBuilder()
        ->add("name")
        ->add("password", PasswordType::class)
        ->getForm()
        ->createView();


        $em=$this->getDoctrine()->getManager();
        
        // $posts=$em->getRepository(Post::class)->findAll();
        // foreach($posts as $post){
        //     $em->remove($post);
        // }

        $post=new Post();
        $post->setTitle("New Post");
        $post->setInfo("desc");
        //* create sql
        $em->persist($post);
        $em->flush();

        return $this->render('home/user.html.twig', [
            'user_form' => $form,
            "user"=>$name
        ]);
    }
     /**
     * @Route("/post/{id?}",name="post")
     * @return Response
     */
    public function post(PostRepository $postRepository,Request $request,$id=null){
        // Or using Dependency injection
        // $em=$this->getDoctrine()->getManager();
        // $post=$em->getRepository(Post::class)->findOneBy([
        //     "id"=>$id
        // ]);
        $posts=$postRepository->findByExampleField();
        $post=new Post();
        $form=$this->createForm(PostType::class,$post,[
            "action"=>$this->generateUrl("base.post"),
            "method"=>"POST"
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            
            $files=$request->files->get("post")["file"];
            $upload=$this->getParameter("uploads_dir");
            foreach($files as $file){
                $file_name=md5(uniqid()).'.'. $file->guessExtension();
                $file->move(    
                    $upload,$file_name
                );
            }
          
            
           

            $em=$this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
        }
        return $this->render('home/post.html.twig', [
            'user_form' => $form->createView(),
        ]);
    }
}
