<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SocialTokenManagementCreateRequest;
use App\Http\Requests\SocialTokenManagementUpdateRequest;
use App\Repositories\Interfaces\SocialTokenManagementRepository;
use App\Validators\SocialTokenManagementValidator;

/**
 * Class SocialTokenManagementsController.
 *
 * @package namespace App\Http\Controllers;
 */
class SocialTokenManagementsController extends Controller
{
    /**
     * @var SocialTokenManagementRepository
     */
    protected $repository;

    /**
     * @var SocialTokenManagementValidator
     */
    protected $validator;

    /**
     * SocialTokenManagementsController constructor.
     *
     * @param SocialTokenManagementRepository $repository
     * @param SocialTokenManagementValidator $validator
     */
    public function __construct(SocialTokenManagementRepository $repository, SocialTokenManagementValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $socialTokenManagements = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $socialTokenManagements,
            ]);
        }

        return view('socialTokenManagements.index', compact('socialTokenManagements'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SocialTokenManagementCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(SocialTokenManagementCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $socialTokenManagement = $this->repository->create($request->all());

            $response = [
                'message' => 'SocialTokenManagement created.',
                'data'    => $socialTokenManagement->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $socialTokenManagement = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $socialTokenManagement,
            ]);
        }

        return view('socialTokenManagements.show', compact('socialTokenManagement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $socialTokenManagement = $this->repository->find($id);

        return view('socialTokenManagements.edit', compact('socialTokenManagement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SocialTokenManagementUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(SocialTokenManagementUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $socialTokenManagement = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'SocialTokenManagement updated.',
                'data'    => $socialTokenManagement->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'SocialTokenManagement deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'SocialTokenManagement deleted.');
    }
}
