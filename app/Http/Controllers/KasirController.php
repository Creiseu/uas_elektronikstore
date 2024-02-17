<?php

namespace App\Http\Controllers;
use App\Models\Kasir;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class KasirController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function home(): View
    {
        //render view with kasir
        return view('kasir.home');
    }
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get kasir
        $kasir = Kasir::latest()->paginate(5);

        //render view with kasir
        return view('kasir.index', compact('kasir'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('kasir.create');
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
            'gambar'     => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'kategori'     => 'required',
        ]);

        //upload image
        $gambar = $request->file('gambar');
        $gambar->storeAs('public/kasir', $gambar->hashName());

        //create kasir
        Kasir::create([
            'nama_barang'     => $request->nama_barang,
            'kategori'     => $request->kategori,
            'stok'     => $request->stok,
            'harga'     => $request->harga,
            'gambar'     => $gambar->hashName(),
        ]);

        //redirect to index
        return redirect()->route('kasir.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get kasir by ID
        $kasir = Kasir::findOrFail($id);

        //render view with kasir
        return view('kasir.show', compact('kasir'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get kasir by ID
        $kasir = Kasir::findOrFail($id);

        //render view with kasir
        return view('kasir.edit', compact('kasir'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'gambar'     => 'image|mimes:jpeg,jpg,png|max:2048',
            'kategori'     => 'required',
        ]);

        //get kasir by ID
        $kasir = Kasir::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/kasir', $image->hashName());

            //delete old image
            Storage::delete('public/kasir/'.$kasir->gambar);

            //update kasir with new image
            $kasir->update([
                'nama_barang' => $request->nama_barang,
                'kategori' => $request->kategori,
                'stok' => $request->stok,
                'harga' => $request->harga,
                'gambar'  => $image->hashName(),
            ]);

        } else {

            //update kasir without image
            $kasir->update([
                'nama_barang' => $request->nama_barang,
                'kategori' => $request->kategori,
                'stok' => $request->stok,
                'harga' => $request->harga,
            ]);
        }

        //redirect to index
        return redirect()->route('kasir.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $kasir
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get kasir by ID
        $kasir = Kasir::findOrFail($id);

        //delete image
        Storage::delete('public/kasir/'. $kasir->gambar);

        //delete kasir
        $kasir->delete();

        //redirect to index
        return redirect()->route('kasir.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function search(Request $request, $search = null)
    {
        $search = $request->input('search');

        $kasir = Kasir::where('nama_barang', 'like', "%$search%")
            ->orWhere('kategori', 'like', "%$search%")
            ->orWhere('stok', 'like', "%$search%")
            ->orWhere('harga', 'like', "%$search%")
            ->paginate(10);

        return view('kasir.index', compact('kasir'));
    }
}
