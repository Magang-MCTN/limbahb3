<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\LimbahMasuk;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\ValidationException;

class LimbahMasukImport implements ToModel, WithHeadingRow, WithValidation
{
    protected $id_periode_laporan;
    protected $importResponse = [];
    protected $rules = [];

    public function __construct($id_periode_laporan)
    {
        $this->id_periode_laporan = $id_periode_laporan;
    }

    public function model(array $row)
    {
        Log::info('Processing row: ' . json_encode($row));
        try {
            $importedData = new LimbahMasuk([
                'id_jenis_limbah' => $row['Jenis Limbah'],
                'tanggal_masuk' => $row['Tanggal Masuk'],
                'maksimal_penyimpanan' => $row['Maksimal Penyimpanan'],
                'sumber_limbahB3' => $row['Sumber Limbah'],
                'jumlah_limbah' => $row['Jumlah'],
                'satuan_limbah' => $row['Satuan Limbah'],
                'bentuk_limbahB3' => $row['Bentuk Limbah'],
                'berat_satuan' => $row['Berat/Satuan'],
                'berat' => $row['Berat '],
                'id_periode_laporan' => $this->id_periode_laporan,
                'id_status' => 1,
                'id_user' => auth()->user()->id,
            ]);

            // Validasi data dengan aturan yang diberikan
            $this->validateRow($row, $importedData);

            return $importedData;
        } catch (\Exception $e) {
            // Tangkap pesan kesalahan dan tambahkan ke dalam array importResponse
            $this->importResponse[] = ['success' => false, 'message' => 'Terjadi kesalahan pada baris ' . $this->getRowCount() . ': ' . $e->getMessage()];
            return null; // Kembalikan null karena data sudah diolah di dalam metode ini
        }
    }

    public function rules(): array
    {
        return [
            'id_jenis_limbah' => 'required|exists:jenis_limbahs,id_jenis_limbah',
            'satuan_limbah' => 'required|string',
            'tanggal_masuk' => 'required|date',
            'maksimal_penyimpanan' => 'required|numeric',
            'sumber_limbahB3' => 'required|string',
            'bentuk_limbahB3' => 'required|in:liquid,solid',
            'jumlah_limbah' => 'required|numeric',
            'berat_satuan' => 'required|numeric',
            'id_periode_laporan' => 'required|numeric',
            'berat' => 'required|numeric',
        ];
    }

    public function getImportResponse()
    {
        return $this->importResponse;
    }

    protected function validateRow(array $row, LimbahMasuk $importedData)
    {
        // Validasi data dengan aturan yang diberikan
        $validator = \Validator::make($row, $this->rules());

        // Jika validasi gagal, lemparkan ValidationException
        if ($validator->fails()) {
            throw new ValidationException($validator, $validator->errors());
        }
    }

    protected function getRowCount()
    {
        return $this->getExcelRowNumber() + 1; // Tambahkan 1 karena index dimulai dari 0
    }

    protected function getExcelRowNumber()
    {
        return $this->getTotalRows() - $this->getRemainingRows();
    }

    protected function getTotalRows()
    {
        return $this->getReader()->getDelegate()->getTotalRows();
    }

    protected function getRemainingRows()
    {
        return $this->getReader()->getDelegate()->getCalculatedRows();
    }

    protected function getReader()
    {
        return $this->getImporter()->getReader();
    }

    protected function getImporter()
    {
        return $this->getDelegate()->getImporter();
    }

    protected function getDelegate()
    {
        return $this->getConcernable();
    }

    protected function getConcernable()
    {
        return $this->getWith();
    }

    protected function getWith()
    {
        return $this->getNewInstance(WithConcerns::class);
    }

    protected function getNewInstance($class)
    {
        return new $class();
    }
}
