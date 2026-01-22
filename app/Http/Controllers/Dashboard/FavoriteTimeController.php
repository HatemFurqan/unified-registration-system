<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\FavoriteTime;
use Illuminate\Http\Request;

class FavoriteTimeController extends Controller
{
    public function index()
    {
        $favorite_times = FavoriteTime::query()->get();
        return view('dashboard.favorite-times.index', ['favorite_times' => $favorite_times]);
    }

    public function create()
    {
        return view("dashboard.favorite-times.create");
    }

    public function store(Request $request)
    {
        $rule = [
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'section' => 'required|string',
        ];

        $messages = [
            'title_ar.required' => 'عنوان التوقيت باللغة العربية مطلوب',
            'title_ar.string' => 'يجب التأكد من إدخال عنوان التوقيت باللغة العربية بشكل صحيح',
            'title_en.required' => 'عنوان التوقيت باللغة الانجليزية مطلوب',
            'title_en.string' => 'يجب التأكد من إدخال عنوان التوقيت باللغة الانجليزية بشكل صحيح',
            'section.string' => 'يجب التأكد من إدخال القسم بشكل صحيح',
        ];

        $this->validate($request, $rule, $messages);

        FavoriteTime::create([
            'title' => ['ar' => $request->title_ar, 'en' => $request->title_en],
            'section' => $request->section,
        ]);

        session()->flash('success', 'تمت الاضافة بنجاح');
        return redirect(route('dashboard.favorite-times.index'));
    }

    public function edit(Request $request, $id)
    {
        $favorite_time = FavoriteTime::findOrFail($id);
        return view('dashboard.favorite-times.edit', ['favorite_time' => $favorite_time]);
    }

    public function update(Request $request, $id)
    {
        $favorite_time = FavoriteTime::findOrFail($id);

        $rule = [
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'section' => 'required|string',
        ];

        $messages = [
            'title_ar.required' => 'عنوان التوقيت باللغة العربية مطلوب',
            'title_ar.string' => 'يجب التأكد من إدخال عنوان التوقيت باللغة العربية بشكل صحيح',
            'title_en.required' => 'عنوان التوقيت باللغة الانجليزية مطلوب',
            'title_en.string' => 'يجب التأكد من إدخال عنوان التوقيت باللغة الانجليزية بشكل صحيح',
            'section.string' => 'يجب التأكد من إدخال القسم بشكل صحيح',
        ];

        $this->validate($request, $rule, $messages);

        $favorite_time->update([
            'title' => ['ar' => $request->title_ar, 'en' => $request->title_en],
            'section' => $request->section,
        ]);

        session()->flash('success', 'تم تحديث البيانات بنجاح');
        return redirect(route('dashboard.favorite-times.edit', $favorite_time->id));
    }

    public function destroy($id) {
        FavoriteTime::find($id)->delete();
        session()->flash('success', trans('تم الحذف بنجاح'));
        return redirect(route('dashboard.favorite-times.index'));
    }
}
