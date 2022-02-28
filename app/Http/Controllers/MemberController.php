<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpKernel\Event\RequestEvent;

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
        return view('member.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // to get all the member role
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
            'name'      => "required",
            'age'       => "required",
            'role_id'   => "required|in:1, 2, 3"
        ]);

        // $id = $request->get('role_id');       
        // dd($id) ;
        $member = new Member([
            'name'          => $request->get('name'),
            'age'           => $request->get('age'),
            'role_id'       => $request->role_id,
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
       /*  $member = Member::find($id)
            ->leftJoin('member_role as mr', 'm.role_id', '=', 'mr.id')
            ->select('m.id', 'm.name as name', 'm.age', 'mr.name as role')
            ->where('m.id', $id)
            ->first(); */

        $roleName = DB::table('member_role')->get();

        $member = $this->getMemberById($id);
  
        return View('member.edit', compact('member', 'roleName'));
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
            'age'  => 'required',
            'role_id'   => "required|in:1, 2, 3"
        ]);

        DB::table('members')
            ->where('id', $id)
            ->update([
                'name'      => $request->name,
                'age'       => $request->get('age'),
                'role_id'   => $request->role_id
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

    public function getMemberById($id)
    {
        return DB::table('members as m')
            ->leftJoin('member_role as mr', 'm.role_id', '=', 'mr.id')
            ->select('m.id', 'm.name as name', 'm.age', 'mr.name as role')
            ->where('m.id', $id)
            ->first();
    }

    public function getMemberDataTable(Request $request)
    {
        $members = DB::table('members as m')
            ->leftJoin('member_role as mr', 'm.role_id', '=', 'mr.id')
            ->select('m.id', 'm.name as name', 'm.age', 'mr.name as role')
            ->get();
        /* 
        <a href="{{ route('member.edit', $member->id) }}">Edit</a></td>
            <td><a href="{{ route('member.show', $member->id) }}">Show</a></td>
            <td><form action="{{ route('member.destroy', $member->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn1">Delete</button>
                </form>
    */
        if($request->ajax())
        {
            return datatables()->of($members)
                ->addColumn('action', function($member){
                    $result = '<a class="btn btn-primary" href="' .  route('member.edit', $member->id) . '">Edit</a>';
                    $result = $result . '<a class="btn btn-primary" href="' .  route('member.show', $member->id) . '">Show</a>';
                    return $result;
                })
                ->rawColumns(['action'])
                ->make(true);
        }   
    }
}
