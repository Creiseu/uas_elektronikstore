<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class KategoriController extends Controller
{
    public function index(): View{
        $kategori = Kategori::latest()->paginate(5);
        return view('kasir.kategori.index', compact('kategori'));
    }
    public function search(Request $request, $search = null)
    {
        $search = $request->input('search');

        $kategori = Kategori::where('kategori', 'like', "%$search%");
        return view('kasir.kategori.index', compact('kategori'));
    }

    public function create(): View
    {
        return view('kasir.kategori.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'kategori'     => 'required',
        ]);

        //create kasir
        Kategori::create([
            'kategori'     => $request->kategori,
        ]);

        //redirect to index
        return redirect()->route('kasir.kategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
}
