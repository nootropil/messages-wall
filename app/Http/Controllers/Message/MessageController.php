<?php

namespace App\Http\Controllers\Message;

use App\Application\Helpers\DataFilter;
use App\Domain\Repositories\Message\MessageReadRepository;
use App\Domain\Services\Message\MessageServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMessageRequest;
use Illuminate\Support\Facades\Auth;

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

    /**
     * @param CreateMessageRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(CreateMessageRequest $request)
    {
        $this->service->create(
            [
                'body' => DataFilter::deepTrimString($request->input('body')),
                'userId' => Auth::user()->getAuthIdentifier(),
            ]
        );

        return redirect('/');
    }

}
