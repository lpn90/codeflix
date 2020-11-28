<?php

namespace CodeFlix\Http\Controllers\Admin;

use CodeFlix\Forms\VideoRelationsForm;
use CodeFlix\Models\Video;
use CodeFlix\Repositories\VideoRepository;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;

class VideoRelationsController extends Controller
{
    /**
     * @var VideoRepository
     */
    private $repository;

    /**
     * VideoRelationsController constructor.
     * @param VideoRepository $repository
     */
    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param Video $video
     * @return \Illuminate\Http\Response
     */
    public function create(Video $video)
    {
        $form = \FormBuilder::create(VideoRelationsForm::class,[
            'url' => route('admin.videos.relations.store', ['video' => $video->id]),
            'method' => 'POST',
            'model' => $video
        ]);

        return view('admin.videos.relations', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(VideoRelationsForm::class);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        $this->repository->update($data, $id);
        $request->session()->flash('message', 'Vídeo alterado com Sucesso!');

        return redirect()->route('admin.videos.relations.create', ['video' => $id]);
    }
}
