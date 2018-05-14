<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Menu;
use App\Permission;
use DB;

class MenuCtrl extends Controller
{

    public function index()
    {
        return view('menu.tree');
    }

    public function tree()
    {
        $menuParent = Menu::whereNull('parent')
            ->orderBy('order_no')
            ->get();
        return response()->json($this->buildMenu($menuParent));
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
            // build children of current item
            $childrenData = $value->children()->get();
            if(!$childrenData->isEmpty()) {
                $children = $this->buildMenu($childrenData);
                $item['folder'] = true;
                $item['children'] = $children;
                $item['expanded'] = true;
            }
            // build item
            $op[] = $item;
        }
        return $op;
    }

    public function create($type, $id)
    {
        $params = [];
        if($type==='create') {
            if($id==='0') {
                $urut = Menu::whereNull('parent')->count();
                $params['parent'] = 0;
                $params['order_no'] = $urut;
            } else {
                $parent = Menu::find($id);
                $urut = $parent->children()->count()+1;
                $params['parent'] = $parent->slug;
                $params['order_no'] = $urut;
            }
        } else {
            $params['data'] = Menu::find($id);
        }
        return view('menu.create', $params);
    }

    public function store(Request $req)
    {
        return DB::transaction(function() use($req) {
            try {
                // storing menu
                $menu = empty($req->id) ? new Menu : Menu::find($req->id);
                $menu->name = $req->name;
                $menu->slug = $req->slug;
                $menu->icon = $req->icon;
                $menu->parent = $req->parent==='0' ? NULL : $req->parent;
                $menu->is_active = $req->is_active ? 1 : 0;
                $menu->order_no = $req->order_no;
                $menu->save();
                // storing permissions
                $existingPerm = $menu->perms()->get()->pluck('name');
                $newPerm = collect($req->permissions)->diff($existingPerm->all());
                $toDeletePerm = $existingPerm->diff($req->permissions);
                Permission::whereIn('name', $toDeletePerm)
                    ->delete();
                $perms = [];
                foreach ($newPerm as $p) {
                    $perm = new Permission;
                    $perm->name = $p;
                    $perm->description = title_case(str_replace('_', ' ', $p));
                    $perm->save();
                    $perms[] = $perm->id;
                    // attach to menu
                    $menu->attachPermission($perm);
                }
                return redirect('menus')->with('success', 'Menu data saved!');
            } catch(\Exception $e) {
                DB::rollback();
                return back()->with('error', 'Error while saving data! '. $e->getMessage())->withInput();
            }
        });
    }

}
