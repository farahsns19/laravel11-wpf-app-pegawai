<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\Employee;

class SalariesController extends Controller
{
    public function index()
    {
        $salaries = Salary::with('employee')->latest()->paginate(5);
        return view('salaries.index', compact('salaries'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('salaries.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id', // nama di form
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2000|max:2100',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'nullable|numeric',
            'potongan' => 'nullable|numeric',
        ]);

        // Hitung total gaji
        $total_gaji = $request->gaji_pokok + ($request->tunjangan ?? 0) - ($request->potongan ?? 0);

        // Simpan ke database
        Salary::create([
            'karyawan_id' => $request->employee_id, // sesuaikan dengan database
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan' => $request->tunjangan ?? 0,
            'potongan' => $request->potongan ?? 0,
            'total_gaji' => $total_gaji,
        ]);

        return redirect()->route('salaries.index')->with('success', 'Gaji berhasil ditambahkan.');
    }

    public function show($id)
    {
        $salary = Salary::with('employee')->findOrFail($id);
        return view('salaries.show', compact('salary'));
    }

    public function edit($id)
    {
        $salary = Salary::findOrFail($id);
        $employees = Employee::all();
        return view('salaries.edit', compact('salary', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id', // nama di form
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2000|max:2100',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'nullable|numeric',
            'potongan' => 'nullable|numeric',
        ]);

        $salary = Salary::findOrFail($id);

        $total_gaji = $request->gaji_pokok + ($request->tunjangan ?? 0) - ($request->potongan ?? 0);

        $salary->update([
            'karyawan_id' => $request->employee_id,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan' => $request->tunjangan ?? 0,
            'potongan' => $request->potongan ?? 0,
            'total_gaji' => $total_gaji,
        ]);

        return redirect()->route('salaries.index')->with('success', 'Gaji berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Salary::destroy($id);
        return redirect()->route('salaries.index')->with('success', 'Gaji berhasil dihapus.');
    }
}
