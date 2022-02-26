<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $members = DB::table('members')->paginate(5);

        $members = DB::table('members as m')
            ->leftJoin('member_role as mr', 'm.role_id', '=', 'mr.id')
            ->select('m.id', 'm.name as name', 'm.age', 'mr.name as role')
            ->paginate(5);
        
        return view('member.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roleName = DB::table('member_role')->get();
        return view('member.create', compact('roleName'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required",
            'age'  => "required",
            'role_id'  => "required|in:1, 2, 3"
        ]);

        // $id = $request->get('role_id');       
        // dd($id) ;
        $member = new Member([
            'name'  => $request->get('name'),
            'age'   => $request->get('age'),
            'role_id'   => $request->get('role_id'),
        ]);

        $member->save();

        return redirect('/member')->with('success', 'member is added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // DB::table();
        $member = DB::table('members as m')
            ->leftJoin('member_role as mr', 'm.role_id', '=', 'mr.id')
            ->select('m.id', 'm.name as name', 'm.age', 'mr.name as role')
            ->where('m.id', $id)
            ->first();
            // $member = Member::find($id);
        
        return View('member.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $member = DB::table('members as m')
            ->leftJoin('member_role as mr', 'm.role_id', '=', 'mr.id')
            ->select('m.id', 'm.name as name', 'm.age', 'mr.name as role')
            ->where('m.id', $id)
            ->first();
  
        return View('member.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => "required",
            'age'  => 'required'
        ]);

        DB::table('members')
            ->where('id', $id)
            ->update([
                'name'  => $request->name,
                'age'   => $request->get('age')
            ]);

        return redirect('/member')->with('success', 'member is edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        DB::table('members')
            ->where('id', $id)
            ->delete();

        return redirect('/member')->with('success', 'member is deleted');
    }
}
