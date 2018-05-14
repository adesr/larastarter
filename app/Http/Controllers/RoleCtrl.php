<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Role;
use App\Menu;
use Entrust;
use Datatables;
use DB;

class RoleCtrl extends Controller
{
    public function index()
   {
       return view('role.dt');
   }

   public function dt()
   {
       $data = Role::all();
       return Datatables::of($data)
           ->addColumn('action', function($data) {
               $html = Entrust::can('role_update') ? '<a href="'. url('roles/create/'.$data->id) .'" class="text-primary row-edit" data-toggle="tooltip" title="Edit Role"><span class="glyphicon glyphicon-wrench"></span></a>' : '';
               $html .= Entrust::can('role_delete') ? '&nbsp;&nbsp;<a href="javascript:" data-url="'. url('roles/delete/'.$data->id) .'" class="text-danger row-delete" data-toggle="tooltip" title="Delete Role"><span class="glyphicon glyphicon-trash"></span></a>' : '';
               return $html;
           })
           ->make(TRUE);
   }

   public function create($id = FALSE)
   {
       $params = [];
       if($id!==FALSE) {
           $role = Role::find($id);
           $params['data'] = $role;
           $params['menus'] = $role->menus()->get();
           $params['perms'] = $role->perms()->get();
       }
       return view('role.create', $params);
   }

   public function tree()
   {
       return response()->json(
           $this->buildMenu(
               Menu::whereNull('parent')->get()
           )
       );
   }

   private function buildMenu($data)
   {
       $op = [];
       foreach ($data as $value) {
           // array build of current item
           $item = [
               'title'=>$value->name,
               'key'=>$value->id,
           ];
           // build permissions
           $perms = $value->perms()->get();
           if($perms->isNotEmpty()) {
               $item['perms'] = $perms->pluck('description', 'id')->all();
           }
           // build children of current item
           $childrenData = $value->children()->get();
           if($childrenData->isNotEmpty()) {
               $children = $this->buildMenu($childrenData);
               $item['folder'] = true;
               $item['expanded'] = true;
               $item['children'] = $children;
           }
           // build item
           $op[] = $item;
       }
       return $op;
   }

   public function store(Request $req)
   {
       return DB::transaction(function() use($req) {
           try {
               // save role
               $role = empty($req->id) ? new Role : Role::find($req->id);
               $role->name = $req->name;
               $role->description = $req->description;
               $role->save();
               // attach menus
               $role->syncMenus($req->menus);
               // attach permissions
               $role->syncPermissions($req->perms);
               return redirect('roles')->with('success', 'Roles data saved!');
           } catch(\Exception $e) {
               DB::rollback();
               return back()->with('error', 'Error while saving data! '. $e->getMessage())->withInput();
           }
       });
   }

   public function destroy($id)
   {
       Role::find($id)->delete();
       return redirect('roles')->with('success', 'Role data deleted!');
   }
}
