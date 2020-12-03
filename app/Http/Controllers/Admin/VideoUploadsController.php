<?php

namespace CodeFlix\Http\Controllers\Admin;

use CodeFlix\Forms\VideoUploadForm;
use CodeFlix\Models\Video;
use CodeFlix\Repositories\VideoRepository;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;

class VideoUploadsController extends Controller
{
    /**
     * @var VideoRepository
     */
    private $repository;

    /**
     * VideoUploadsController constructor.
     * @param VideoRepository $repository
     */
    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Video $video)
    {
        $form = \FormBuilder::create(VideoUploadForm::class,[
            'url' => route('admin.videos.uploads.store', ['video' => $video->id]),
            'method' => 'POST',
            'model' => $video
        ]);

        return view('admin.videos.upload', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $id)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(VideoUploadForm::class);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        if($request->file('thumb')){
            $this->repository->uploadThumb($id, $request->file('thumb')); //l5-repository
        }
        if($request->file('file')){
            $this->repository->uploadFile($id, $request->file('file')); //l5-repository
        }
        $request->session()->flash('message', 'Upload(s) realizado(s) com Sucesso!');

        return redirect()->route('admin.videos.uploads.create', ['video' => $id]);
    }
}
