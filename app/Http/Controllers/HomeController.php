<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Resources\ApiException;
use App\Http\Resources\CoursesCollection;
use App\Utilities\CustomLogger\LogMsg;

class HomeController extends Controller
{
    /**
     * Show Landing Page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('welcome');
    }

    public function redirect()
    {
        return redirect()->route('redirect');
    }

    /**
     * @return ApiException|CoursesCollection
     */
    public function courses()
    {
        try {
            $course = Course::paginate(9);
        } catch (\Exception $exception) {
            $exception->errorCode = (app()->make(LogMsg::class))
                ->error(__METHOD__, $exception, 'reporting');
            return new ApiException($exception);
        }

        return new CoursesCollection($course);
    }

    /**
     * @return ApiException|\App\Http\Resources\Course
     */
    public function create()
    {
        try {
            $create = Course::create(request()->all());
        } catch (\Exception $exception) {
            $exception->errorCode = (app()->make(LogMsg::class))
                ->error(__METHOD__, $exception, 'reporting');
            return new ApiException($exception);
        }

        return new \App\Http\Resources\Course($create);
    }

    /**
     * @param Course $course
     * @return ApiException|\App\Http\Resources\Course
     */
    public function edit(Course $course)
    {
        try {
            $updated = tap($course)->update(request()->all());
        } catch (\Exception $exception) {
            $exception->errorCode = (app()->make(LogMsg::class))
                ->error(__METHOD__, $exception, 'reporting');
            return new ApiException($exception);
        }

        return new \App\Http\Resources\Course($updated);
    }
}
