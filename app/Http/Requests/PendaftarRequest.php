<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class PendaftarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    
    public function rules(): array
    {
         return [
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'instansi' => 'required|string|max:255',
            'mulai_magang' => 'required|date',
            'selesai_magang' => 'required|date|after_or_equal:mulai_magang',
            'divisi' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'cv' => 'required|mimes:pdf|max:2048',
            'portofolio' => 'nullable|mimes:pdf,docx,pptx|max:4096',
        ];
    }

    public function messages(): array 
    {
        return [
            
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',
            
            'instansi.required' => 'Instansi wajib diisi.',
            'instansi.string' => 'Instansi harus berupa teks.',
            'instansi.max' => 'Instansi maksimal 255 karakter.',

            'mulai_magang.required' => 'Tanggal mulai magang wajib diisi.',
            'mulai_magang.date' => 'Tanggal mulai magang tidak valid.',
            
            'selesai_magang.required' => 'Tanggal selesai magang wajib diisi.',
            'selesai_magang.date' => 'Tanggal selesai magang tidak valid.',
            'selesai_magang.after_or_equal' => 'Tanggal selesai magang harus setelah atau sama dengan tanggal mulai magang.',
            
            'divisi.required' => 'Divisi wajib diisi.',
            'divisi.string' => 'Divisi harus berupa teks.',
            'divisi.max' => 'Divisi maksimal 255 karakter.',
            
            'foto.required' => 'Foto wajib diunggah.',
            'foto.image' => 'File foto harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat: jpeg, png, jpg.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
            
            'cv.required' => 'CV wajib diunggah.',
            'cv.mimes' => 'CV harus berformat PDF.',
            'cv.max' => 'Ukuran CV maksimal 2MB.',
            
            'portofolio.mimes' => 'Portofolio harus berformat: pdf, docx, pptx.',
            'portofolio.max' => 'Ukuran portofolio maksimal 4MB.',
        ];
    }

     public function attributes(): array
    {
        return [
            'nama' => 'nama lengkap',
            'email' => 'alamat email',
            'jenis_kelamin' => 'jenis kelamin',
            'instansi' => 'nama instansi',
            'divisi' => 'divisi yang dipilih',
            'foto' => 'foto profil',
            'cv' => 'curriculum vitae',
            'portofolio' => 'file portofolio',
        ];
    }
}