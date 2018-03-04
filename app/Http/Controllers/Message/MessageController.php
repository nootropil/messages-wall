<?php

namespace App\Http\Controllers\Message;

use App\Domain\Repositories\Message\MessageReadRepository;
use App\Domain\Services\Message\MessageServiceInterface;
use App\User;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{

    /**
     * @var MessageServiceInterface
     */
    private $service;

    /**
     * @var MessageReadRepository
     */
    private $readRepository;

    /**
     * MessageController constructor.
     * @param MessageServiceInterface $service
     * @param MessageReadRepository $readRepository
     */
    public function __construct(MessageServiceInterface $service, MessageReadRepository $readRepository)
    {
        $this->service = $service;
        $this->readRepository = $readRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $messages = $this->readRepository->fetchAllAsArrayWithUsername();

        return view('message.index', ['messages' => $messages]);
    }

}
