<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Book;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\BookRepository;

class BookController extends AbstractController
{
    /**
     * @Route("/library", name="library")
     */
    public function library(): Response
    {
        return $this->render('book/library.html.twig', [
        ]);
    }


    /**
     * @Route("/library/create", name="create_book", methods={"GET","HEAD"})
     */
    public function createBook(): Response
    {
        return $this->render('book/create_book.html.twig', [
        ]);
    }

    /**
     * @Route("/library/create", name="create_book_process", methods={"POST"})
     */
    public function createBookProcess(
        ManagerRegistry $doctrine,
        Request $request,
    ): Response {
        $entityManager = $doctrine->getManager();

        $book = new Book();
        $title = $request->request->get('title');
        $isbn = $request->request->get('ISBN');
        $url = $request->request->get('url');
        $forfattare = $request->request->get('forfattare');

        $book->setTitle($title);
        $book->setISBN($isbn);
        $book->setImage($url);
        $book->setForfattare($forfattare);

        $entityManager->persist($book);
        $entityManager->flush();

        return $this->redirectToRoute('library');
    }

    /**
     * @Route("/library/read", name="read_book", methods={"GET"})
     */
    public function readBook(
        BookRepository $bookRepository
    ): Response {
        $books = $bookRepository->findAll();
        // $JSON = $this->json($books);
        $data = [
            'title'=>'read_books',
            'books'=> $books

        ];
        return $this->render('book/read_book.html.twig', $data);
    }

    /**
     * @Route("/library/show/{id}", name="view_single_book")
     */
    public function showBookById(
        BookRepository $bookRepository,
        int $id
    ): Response {
        $book = $bookRepository->find($id);
        $data = [
            'title'=>'view_books',
            'book'=> $book
        ];

        return $this->render('book/view_book.html.twig', $data);
    }
    /**
     * @Route("/library/delete/{id}", name="book_delete_by_id")
     */
    public function deleteBookById(
        ManagerRegistry $doctrine,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($id);

        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute('read_book');
    }

    /**
     * @Route("/library/update/{id}", name="book_update", methods={"GET"})
     */
    public function updateBook(
        ManagerRegistry $doctrine,
        int $id,
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($id);

        $data = [
            'book' => $book
        ];

        // $book->setValue($value);
        // $entityManager->flush();

        return $this->render('book/edit_book.html.twig', $data);
    }
    /**
     * @Route("/library/update/{id}", name="update_book_process", methods={"POST"})
     */
    public function updateBookProcess(
        ManagerRegistry $doctrine,
        Request $request,
        int $id,
    ): Response {
        $entityManager = $doctrine->getManager();

        $book = $entityManager->getRepository(Book::class)->find($id);
        $title = $request->request->get('title');
        $isbn = $request->request->get('ISBN');
        $url = $request->request->get('url');
        $forfattare = $request->request->get('forfattare');

        $book->setTitle($title);
        $book->setISBN($isbn);
        $book->setImage($url);
        $book->setForfattare($forfattare);

        // $entityManager->persist($book);
        $entityManager->flush();

        return $this->redirectToRoute('read_book');
    }
}
