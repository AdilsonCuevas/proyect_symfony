<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\UsuariosRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Usuarios;
use App\Form\UsuariosType;
use Doctrine\ORM\EntityManagerInterface;

final class UsuariosController extends AbstractController
{
    #[Route('/usuarios', name: 'app_usuarios')]
    public function index(UsuariosRepository $usuarioRepository): Response
    {
        $usuarios = $usuarioRepository->findAll();

        return $this->render('usuarios/index.html.twig', [
            'ListUsers' => $usuarios,
        ]);
    }

    #[Route('/usuarios/nuevo', name: 'app_usuario_nuevo', methods: ['POST'])]
    public function CreateUsers(Request $request, EntityManagerInterface $em)
    {
        $usuarios = new Usuarios();

        $form_user = $this->createForm(UsuariosType::class, $usuarios);
        $form_user->handleRequest($request);

        if ($form_user->isSubmitted() && $form_user->isValid()) {
            $usuarios->setPassword(password_hash($usuarios->getPassword(), PASSWORD_BCRYPT));
            $usuarios->setStatus(1);
            $em->persist($usuarios);
            $em->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('usuarios/user_create.html.twig', [
            'form_users' => $form_user->createView(),
        ]);
    }

    #[Route('/usuario/eliminar/{id}', name: 'app_usuario_eliminar', methods: ['DELETE'])]
    public function deleteUser(
        int $id,
        UsuariosRepository $usuarioRepository,
        EntityManagerInterface $em
    ) {
        $usuario = $usuarioRepository->find($id);

        if (!$usuario) {
            return $this->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Eliminar el usuario
        $em->remove($usuario);
        $em->flush();

        return $this->redirectToRoute('index');
    }

    #[Route('/usuario/actualizar/{id}', name: 'app_usuario_actualizar', methods: ['PUT'])]
    public function actualizarUser(
        int $id,
        Request $request,
        UsuariosRepository $usuarioRepository,
        EntityManagerInterface $em
    ) {
        // Buscar el usuario
        $usuario = $usuarioRepository->find($id);

        if (!$usuario) {
            return $this->json(['error' => 'Usuario no encontrado'], 404);
        }

        $form_user = $this->createForm(UsuariosType::class, $usuario);
        $form_user->handleRequest($request);

        if ($form_user->isSubmitted() && $form_user->isValid()) {
            $plainPassword = $form_user->get('password')->getData();
            if ($plainPassword) {
                $usuario->setPassword(password_hash($usuario->getPassword(), PASSWORD_BCRYPT));
            }
            $usuario->setStatus(1);
            $em->persist($usuario);
            $em->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('usuarios/user_update.html.twig', [
            'form_users' => $form_user->createView(),
        ]);
    }

    #[Route('/login', name: 'app_login')]
    public function renderLogin()
    {
        return $this->render('ath/index.html.twig');
    }
}
