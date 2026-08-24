<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    function blog()
    {
        $blog = DB::table('blogs')->get();
        return view('blog', compact('blog'));
    }

    function delete($id)
    {
        DB::table('blogs')->where('id', $id)->delete();
        return redirect('blog');
    }

    function edit($id)
    {
        $blog = DB::table('blogs')->where('id', $id)->first();
        return view('edit', compact('blog'));
    }

    function update(Request $request, $id)
    {
        $request->validate(
            [
                'title' => 'required|max:50',
                'content' => 'required',
                'status' => 'required',
            ],
            [
                'title.required' => 'กรุณากรอกชื่อบทความ',
                'title.max' => 'ชื่อบทความต้องไม่เกิน 50 ตัวอักษร',
                'content.required' => 'กรุณากรอกเนื้อหาบทความ',
                'status.required' => 'กรุณากรอกสถานะบทความ',
            ],
        );

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
        ];


        DB::table('blogs')->where('id', $id)->update($data);

        return redirect('blog');
    }

    function about()
    {
        $data = [
            'name' => 'Atikan Khotmongkol',
            'city' => 'Ubon Ratchathani',
        ];

        return view('about', $data);
    }

    function insert(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|max:50',
                'content' => 'required',
                'status' => 'required',
            ],
            [
                'title.required' => 'กรุณากรอกชื่อบทความ',
                'title.max' => 'ชื่อบทความต้องไม่เกิน 50 ตัวอักษร',
                'content.required' => 'กรุณากรอกเนื้อหาบทความ',
                'status.required' => 'กรุณากรอกสถานะบทความ',
            ],
        );

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
        ];

        DB::table('blogs')->insert($data);

        return redirect('blog');
    }

    function form()
    {
        return view('form');
    }

    function changestatus(Request $request, $id)
    {
        $blog = DB::table('blogs')->where('id', $id)->first();

        if ($blog->status === 'active') {
            $status = 'inactive';
        } else {
            $status = 'active';
        }

        DB::table('blogs')
            ->where('id', $id)
            ->update(['status' => $status]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'status' => $status]);
        }

        return redirect('blog');
    }
}
