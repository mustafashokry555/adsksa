<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ImportDoctors implements ToModel, WithStartRow, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function startRow(): int
    {
        return 2; // Start importing data from the second row (index 2)
    }

    public function model(array $row)
    {
        return new User([
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => bcrypt($row['password']),
            'address' => $row['address'],
            'user_type' => $row['user_type'],
            'country' => $row['country'],
            'pricing' => $row['pricing'],
            'zip_code' => $row['zip_code'],
            'state' => $row['state'],
            'gender' => $row['gender'],
            'mobile' => $row['mobile'],
            'date_of_birth' => $row['date_of_birth'],
            'age' => $row['age'],
            'hospital_id' => Auth::id(),
        ]);
    }
}
