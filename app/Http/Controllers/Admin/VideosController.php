<?php

namespace CodeFlix\Http\Controllers\Admin;

use CodeFlix\Forms\VideoForm;
use CodeFlix\Models\Video;
use CodeFlix\Repositories\VideoRepository;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\Form;

class VideosController extends Controller
{
    /**
     * @var VideoRepository
     */
    private $repository;

    /**
     * VideosController constructor.
     * @param VideoRepository $repository
     */
    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $videos = $this->repository->paginate();
        return view('admin.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $form = \FormBuilder::create(VideoForm::class,[
            'url' => route('admin.videos.store'),
            'method' => 'POST'
        ]);

        return view('admin.videos.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(VideoForm::class);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        $this->repository->create($data);
        $request->session()->flash('message', 'Vídeo criado com Sucesso!');

        return redirect()->route('admin.videos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CodeFlix\Models\Video  $video
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Video $video)
    {
        return view('admin.videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CodeFlix\Models\Video  $video
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Video $video)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(VideoForm::class, [
            'url' => route('admin.videos.update', ['video' => $video->id]),
            'method' => 'PUT',
            'model' => $video
        ]);

        return view('admin.videos.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(VideoForm::class);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        $this->repository->update($data, $id);
        $request->session()->flash('message', 'Vídeo alterado com Sucesso!');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->repository->delete($id);

        $request->session()->flash('message', 'Categoria excluída com Sucesso!');

        return redirect()->back('admin.videos.index');
    }
}
