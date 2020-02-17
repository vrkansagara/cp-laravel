<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalenderCreateRequest;
use App\Http\Requests\CalenderUpdateRequest;
use App\Repositories\Interfaces\CalenderRepository;
use App\Validators\CalenderValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class CalendersController.
 *
 * @package namespace App\Http\Controllers;
 */
class CalendersController extends Controller
{
    /**
     * @var CalenderRepository
     */
    protected $repository;

    /**
     * @var CalenderValidator
     */
    protected $validator;

    /**
     * CalendersController constructor.
     *
     * @param CalenderRepository $repository
     * @param CalenderValidator $validator
     */
    public function __construct(CalenderRepository $repository, CalenderValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $calenders = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $calenders,
            ]);
        }

        return view('calenders.index', compact('calenders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CalenderCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CalenderCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $calender = $this->repository->create($request->all());

            $response = [
                'message' => 'Calender created.',
                'data' => $calender->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error' => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $calender = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $calender,
            ]);
        }

        return view('calenders.show', compact('calender'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $calender = $this->repository->find($id);

        return view('calenders.edit', compact('calender'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CalenderUpdateRequest $request
     * @param string $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CalenderUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $calender = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Calender updated.',
                'data' => $calender->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error' => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Calender deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Calender deleted.');
    }
}
